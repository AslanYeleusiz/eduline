<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SalaryCalculatorHistoryResource;
use App\Models\SalaryCalculator;
use App\Models\SalaryCalculatorHistory;
use App\Services\V1\SalaryCalculationService;
use Illuminate\Http\Request;
use PDF;

class SalaryCalculatorController extends Controller
{
    public function index(Request $request)
    {
        $salaryCalculators = SalaryCalculatorHistory::select('id', 'created_at')->get();
        return SalaryCalculatorHistoryResource::collection($salaryCalculators);
    }

    public function store(Request $request)
    {
        // int -- select --- 2019-2026 арасы
        //За период (год)

        $year = $request->input('year', now()->format('Y'));
        // int -- select ---- 12 months
        //За период (месяц)
        $month = $request->input('month', now()->format('m'));
        // string -- select Высшее (B2), Среднее специальное (B4)
        //Образование

        $education = $request->input('education', 'B2');
        // int -- select
        //Стаж (лет)
        $experienceYear = $request->input('experience_year', 0);
        // int -- select
        //Стаж (месяцев)
        $experienceMonth = $request->input('experience_month', 0);
        // int -- select
        //Стаж (дней)
        $experienceDay = $request->input('experience_day', 0);
        // bool -- checkbox
        //Работа в сельской местности
        $workInVillage = $request->input('work_in_village', false);
        ////select - int
        ////Количество ставок
        //// 0.25,0.5,0.75,1,1.25,1.5,1.75,2
        //// $stavka = $request->input('stavka', 1);

        //bool -- checkbox
        //Доплата за особые условия труда (10%)
        $specialWorkingConditions = $request->input('special_working_conditions', false);
        // int
        // select --  Нет, Зона экологической катастрофы, Зона экологического кризиса, Зона экологического предкризисного состояния
        // 0, ДО*50%, ДО*30%, ДО*20% қосымша қосылады
        //Доплата за работу в зоне экологического бедствия
        $workInEnvironmentalDisasterZone = $request->input('work_in_env_disaster_zone', 1);

        // int
        // select -- Нет, Зона черезвычайного радиационнного риска, Зона максимального радиационнного риска,
        //Зона повышенного радиационнного риска, Зона минимального радиационнного риска, Зона с льготным социально-экономическим статусом
        //Доплата за работу на территориях радиационного риска

        // 0, МРП*2, МРП*1,75, МРП*1,5, МРП*1,25, МРП*1 қосымша қосылады

        $workInRadiationRiskZone = $request->input('work_in_radiation_risk_zone', 1);

        // int -- select -- Нет, Частичное погружение, Полное погружение
        // 0, БДО*1. БДО*2 қосымша қосылады
        //Доплата за преподавание на английском языке
        $teachingInEnglish = $request->input('teaching_in_english', 1);
        // bool --- checkbox
        //  МРП*10 қосымша қосылады
        // Доплата за степень магистра по НПН

        $magisterDegree = $request->input('magister_degree', false);
        // bool --- checkbox
        // БДО*1 қосымша қосылады
        // Доплата за наставничество
        $mentoring = $request->input('mentoring', false);
        // int
        // select -- Нет, педагог-модератор, педагог-эксперт,  педагог-исследователь, педагог-мастер
        //0, ДО*50%, ДО*40%, ДО*35%, ДО*30% қосымша қосылады
        // Пед. Мастерство
        $pedSkill = $request->input('ped_skill', 1);

        // checkbox -- Классное руководство
        //Полный класс: 1-4 сынып үшін БДО*50%,
        //5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады
        $classGuide = $request->input('class_guide', false);
        // checkbox -- Классное руководство: Начальный класс?
        //Полный класс: 1-4 сынып үшін БДО*50%,
        // 5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады
        $classGuideElementaryGrade = $request->input('class_guide_elementary_grade', false);
        //int -- Наполняемость класса
        //Санын енгізеді. Класное руководство Иә болғанда ғана жазуға болады. Кері жағдайда неактивный болады.
        $classOccupancy = $request->input('class_occupancy', 0);
        // select -- За заведование кабинетом
        //Нет, Половина дня, Полный день
        //0, БДО*10%, БДО*20%  или за мастерской всегда БДО*20% қосымша қосылады

        $forManagingOffice = $request->input('for_managing_office', 1);

        // checkbox -- bool -- За заведование мастерской
        //  за мастерской всегда БДО*20% қосымша қосылады
        $forRunningWorkshop = $request->input('for_running_workshop', false);
        // int
        // select -- За проверку тетрадей
        // Нет, Учитель начальных классов, Учитель ЕМН, Учитель языка и литературы
        // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%
        $forCheckingNotebook = $request->input('for_checking_notebook', 1);
        //int ---  За проверку тетрадей в полных классах
        // Сағат санын жазады
        //(Тетрадь*Сағат саны) қосымша қосылады
        $forCheckingNotebooksFullClasses = $request->input('for_checking_notebooks_full_classes', 0);
        //int --- За проверку тетрадей в классах с числом менее 15 учащихся
        // Сағат санын жазады
        //(Тетрадь*Сағат саны/2) қосымша қосылады
        $forCheckingNotebooksClassesLessThan15Students = $request->input('for_checking_notebooks_half_classes', 0);

        // iint --- Учебная нагрузка по тарификации - Нагрузка
        // Сағат санын жазады
        //ДО анықтауға керек негізге параметр. ДО = БДО/16*сағат санына
        $trainingLoadBillingLoad = $request->input('training_load_billing_load', 0);
        // int --- Обучение на дому
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        $homeschooling = $request->input('homeschooling', 0);
        // int --- Часы работы с лицейcкими и гимназическими классами
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        $hoursWithLyceumGymnasiumClasses = $request->input('hours_with_lyceum_classes', 0);
        // int --- Часы углубленного изучения
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        $hoursInDepthStudy = $request->input('hours_in_depth_study', 0);
        // int --- Часы обновленного содержания
        // Сағат санын жазады (еш әсер бермейді)
        // ДО*30%  --- қосымша қосылады
        $hoursUpdatedContent = $request->input('hours_updated_content', 0);
        // int --- Часы по предметам профильного назначения
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        $hoursSpecializedSubjects = $request->input('hours_specialized_subjects',0);
        // int --- Часы замены в классах с числом менее 15 учащихся
        // Сағат санын жазады
        // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
        //44
         //38,1 classes_with_fewer_than_15_students
        $replacementHoursInClassesWithFewerThan15Students = $request->input('replace_hours_half_classes',0);
        // int --- Часы замены в полных классах
        // Сағат санын жазады
        // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
        // 76,2 коэфицент
        //45
        $replacementHourFullClasses = $request->input('replacement_hour_full_classes',0);
        // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
        // Сағат санын жазады
        // 38.1 коэфицент
        //46
        $replacementHoursNewProgramInClassesWithFewerThan15Students = $request->input('replace_hours_new_program_half_classes',0);
        // int --- Часы замены из них часы замены по новой программе в полных классах
        // Сағат санын жазады
        // 38.1 коэфицент
        $replacementHoursNewProgramInClassesWithFullClasses = $request->input('replace_hours_new_program_full_classes', 0);
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Сағат санын жазады
        $replacementHoursLyceumGymnasiumClassesWithFewerThan15Students = $request->input('replace_hours_lyceum_classes_half_classes', 0);
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
        //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
        // Сағат санын жазады
        $replacementHoursLyceumGymnasiumClassesFullClasses = $request->input('replace_hours_lyceum_classes_full_classes', 0);
        // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
        $replacementClassroomManagementFrom1stTo4thGradeClassesWithFewerThan15Students = $request->input('replace_classroom_management_elementary_grade_half_classes', 0);
        // int ---Замена классного руководства с 1 по 4 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $replacementClassroomManagementFromGrade1ToGrade4FullClasses = $request->input('replace_classroom_management_elementary_grade_full_classes', 0);

        // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
        $replacementClassroomManagementFrom5stTo10thGradeClassesWithFewerThan15Students = $request->input('replace_classroom_management_senior_grade_half_classes', 0);
        // int ---Замена классного руководства с 5 по 10 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $replacementClassroomManagementFromGrade5ToGrade10FullClasses = $request->input('replace_classroom_management_senior_grade_full_classes', 0);
        // checkbox --- Заявление об удержании профсоюзных взносов (1%)
        //Иә болса жалақы суммасынан ИТОГ*1% алынады.
        $applicationWithholdingUnionDues = $request->input('app_withholding_union_dues', false);
        // checkbox ---Заявление об удержании партийных взносов (297,5 тенге)
        //ПВ (статичный) жалақы суммасынан алынады
        $applicationWithholdingPartyContributions  = $request->input('app_withholding_party_contributions', false);
        // checkbox ---Работающий пенсионер
        //Итог*10% жалақы суммасынан алынады
        $workingPensioner  = $request->input('working_pensioner', false);
        // checkbox ---Освобожден от уплаты индивидуального подоходного налога
        //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
        $exemptFromPayingIndividualIncomeTax  = $request->input('exempt_from_paying_individual_income_tax', false);


        $category = $request->input('category', 4);

        $salaryCalculatorData = SalaryCalculator::latest()->first();
        if (empty($salaryCalculatorData)) {
            return 0;
        }
        $experience = round($experienceYear + $experienceMonth / 12 + $experienceDay / 365, 2);
        // dd(,floatval($experienceYear . '.' . $experienceMonth));
        // $experience = floatval($experienceYear . '.' . $experienceMonth);
        $coefficient = SalaryCalculationService::getCoefficent($education, $category, $experience, $year, $month);
        $mrp = $salaryCalculatorData->mrp;
        $bdo = $salaryCalculatorData->bdo;
        $pv = $salaryCalculatorData->pv;
        $snv = $salaryCalculatorData->snv;
        $dpop = $salaryCalculatorData->dpop;
        $zchbdo = $bdo / 16;
        $do1 = $bdo * $coefficient;
        // Увеличение ДО согласно поправочного коэффициента 75 %

        // $stavka = floatval($stavka);
        // $hours = in_array($stavka, SalaryCalculator::STAVKI) ? 18 * $stavka : 0;

        $do2 = $do1 * 0.75;
        $do = ($do1 + $do2) / 16 * $trainingLoadBillingLoad;
        // начислено по тарифу
        // $resultByTariff = $workInVillage == 'true' ? $do * 1.25 : $do;
        //---/
        $do = $workInVillage == 'true' ? $do * 1.25 : $do;
        $data = [
            'base' => [
                'bdo' => $bdo,
                'coefficient' => $coefficient,
                'do1' => $do1,
                'do2' => $do2,
                'do' => $do
                // 'result' => $do,
                // 'result_by_tariff' => $resultByTariff,
                // 'work_in_village' => $workInVillage == 'true',
                // 'sum_work_in_village' => $sumWorkInVillage,
            ],
            'additional_surcharges' => []
        ];
        $sumAdditionalSurcharges = 0;
        //ауылдық болса егер
        // $sumWorkInVillage = $workInVillage == 'true' ? $do * 0.25 : 0;
        if ($workInVillage == 'true') {
            $data['base']['sum_work_in_village'] = $do * 0.25;
        }

        // Доплата за особые условия труда (10%)
        if ($specialWorkingConditions == 'true') {
            // $do = $do * 1.1;
            $sumAdditionalSurcharges += $do * 0.1;
            $data['additional_surcharges']['sum_special_working_conditions'] = $do * 0.1;
        }
        //
        // Пед. Мастерство
        foreach (SalaryCalculator::PED_SKILLS as $pedSkillItem) {
            if ($pedSkill == $pedSkillItem['number']) {
                $sumAdditionalSurcharges += $do * floatval('0.' . $pedSkillItem['percent']);
                $data['additional_surcharges']['sum_ped_skill'] = $do * floatval('0.' . $pedSkillItem['percent']);
            }
        }

        //Доплата за работу в зоне экологического бедствия

        foreach (SalaryCalculator::WORK_IN_ENVIRONMENTAL_DISASTER_ZONES as $workInEnvironmentalDisasterZoneItem) {
            if ($workInEnvironmentalDisasterZoneItem['number'] == $workInEnvironmentalDisasterZone) {
                $sumAdditionalSurcharges += $do * floatval('0.' . $workInEnvironmentalDisasterZoneItem['percent']);
                $data['additional_surcharges']['sum_work_in_env_disaster_zone']
                    = $do * floatval('0.' . $workInEnvironmentalDisasterZoneItem['percent']);
            }
        }
        //Доплата за работу на территориях радиационного риска
        foreach (SalaryCalculator::WORK_IN_RADIATION_RISK_ZONES as $workInRadiationRiskZoneItem) {
            if ($workInRadiationRiskZoneItem['number'] == $workInRadiationRiskZone) {
                $sumAdditionalSurcharges += $mrp * $workInRadiationRiskZoneItem['mrp'];
                $data['additional_surcharges']['sum_work_in_radiation_risk_zone'] = $mrp * $workInRadiationRiskZoneItem['mrp'];
            }
        }

        //Доплата за преподавание на английском языке
        foreach (SalaryCalculator::TECHING_IN_ENGLISH_ITEMS as $teachingInEnglishItem) {
            if ($teachingInEnglish == $teachingInEnglishItem['number']) {
                $sumAdditionalSurcharges += $bdo * $teachingInEnglishItem['bdo'];
                $data['additional_surcharges']['sum_teaching_in_english'] = $bdo * $teachingInEnglishItem['bdo'];
            }
        }

        // Доплата за степень магистра по НПН
        if ($magisterDegree == 'true') {
            $sumAdditionalSurcharges += $mrp * 10;
            $data['additional_surcharges']['sum_teaching_in_english'] = $mrp * 10;
        }
        // Доплата за наставничество
        if ($mentoring == 'true') {
            $sumAdditionalSurcharges += $bdo * 1;
            $data['additional_surcharges']['sum_mentoring'] = $bdo * 1;
        }

        // checkbox -- Классное руководство
        //Полный класс: 1-4 сынып үшін БДО*50%,
        //5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады

        if($classGuide == 'true') {
            if($classGuideElementaryGrade == 'true') {
                if (intval( $classOccupancy) > 0  && intval( $classOccupancy) < 15) {
                    $sumAdditionalSurcharges += $bdo * 0.25;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.25;


                } else if (intval( $classOccupancy) >= 15) {
                    $sumAdditionalSurcharges += $bdo * 0.5;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.5;
                }
            } else {
                if (intval( $classOccupancy) > 0  && intval( $classOccupancy) < 15) {
                    $sumAdditionalSurcharges += $bdo * 0.3;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.3;

                } else if (intval( $classOccupancy) >= 15) {
                    $sumAdditionalSurcharges += $bdo * 0.6;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.6;
                }
            }
        }
        //За заведование кабинетом
        foreach (SalaryCalculator::FOR_MANAGING_OFFICE_ITEMS as $forManagingOfficeItem) {
            if ($forManagingOffice == $forManagingOfficeItem['number']) {
                $sumAdditionalSurcharges +=  $bdo * floatval('0.' . $forManagingOfficeItem['bdo_percent']);;
                $data['additional_surcharges']['sum_for_managing_office'] = $bdo * floatval('0.' . $forManagingOfficeItem['bdo_percent']);
            }
        }
        // За заведование мастерской
        if ($forRunningWorkshop == 'true') {
            $sumAdditionalSurcharges += $bdo * 0.20;
            $data['additional_surcharges']['sum_for_running_workshop'] = $bdo * 0.20;
        }

        // select -- За проверку тетрадей
        // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%

        if ($forCheckingNotebook != SalaryCalculator::FOR_CHECKING_NOTEBOOKS[0]['number']) {
            foreach (SalaryCalculator::FOR_CHECKING_NOTEBOOKS as $forCheckingNotebookItem) {
                if ($forCheckingNotebookItem['number'] == $forCheckingNotebook) {
                    $sumAdditionalSurcharges += $zchbdo * (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent']))  *  $forCheckingNotebooksFullClasses;
                    $data['additional_surcharges']['sum_for_checking_notebooks_full_classes'] =  $zchbdo * (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent']))  *  $forCheckingNotebooksFullClasses;
                    $sumAdditionalSurcharges +=  $zchbdo *  (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent'])) * ($forCheckingNotebooksClassesLessThan15Students / 2);
                    $data['additional_surcharges']['sum_for_checking_notebooks_classes_less_than_15_students'] = $zchbdo *  (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent'])) * ($forCheckingNotebooksClassesLessThan15Students / 2);
                }
            }
        }
        //Учебная нагрузка по тарификации - Нагрузка
        // $trainingLoadBillingLoad =

        // int --- Обучение на дому
        if ($homeschooling) {
            $sumAdditionalSurcharges += $zchbdo  * $homeschooling * 0.4;
            $data['additional_surcharges']['sum_shomeschooling'] = $zchbdo  * $homeschooling * 0.4;
        }

        // int --- Часы работы с лицейcкими и гимназическими классами
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        if ($hoursWithLyceumGymnasiumClasses) {
            $sumAdditionalSurcharges += $zchbdo * $hoursWithLyceumGymnasiumClasses * 0.2;
            $data['additional_surcharges']['sum_hours_with_lyceum_gymnasium_classes'] = $zchbdo * $hoursWithLyceumGymnasiumClasses * 0.2;
        }
        // int --- Часы углубленного изучения
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        if ($hoursInDepthStudy) {
            $sumAdditionalSurcharges += $zchbdo * $hoursInDepthStudy * 0.2;
            $data['additional_surcharges']['sum_hours_in_depth_study'] = $zchbdo * $hoursInDepthStudy * 0.2;
        }
        // int --- Часы обновленного содержания
        // Сағат санын жазады (еш әсер бермейді)
        // ДО*30%  --- қосымша қосылады
        if ($hoursUpdatedContent) {
            $sumAdditionalSurcharges += $do * 0.3;
            $data['additional_surcharges']['sum_hours_updated_content'] = $do * 0.3;
        }

        // int --- Часы по предметам профильного назначения
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        if ($hoursSpecializedSubjects) {
            $sumAdditionalSurcharges += $zchbdo * $hoursSpecializedSubjects * 0.4;
            $data['additional_surcharges']['sum_hours_specialized_subjects'] = $zchbdo * $hoursSpecializedSubjects * 0.4;
        }

        // int --- Часы замены в классах с числом менее 15 учащихся
        // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
        // 38,1 коэфицент
        if ($replacementHoursInClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 38.1 * $replacementHoursInClassesWithFewerThan15Students;
            $data['additional_surcharges']['sum_replacement_hours_in_classes_with_fewer_than_15_students']
                = ($do1 + $do2) / 38.1 * $replacementHoursInClassesWithFewerThan15Students;
        }
        // int --- Часы замены в полных классах
        // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
        // 76,2 коэфицент

        if ($replacementHourFullClasses) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 76.2 * $replacementHourFullClasses;
            $data['additional_surcharges']['sum_replacement_hour_full_classes']
                = ($do1 + $do2) / 76.2 * $replacementHourFullClasses;
        }
        // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
        // Сағат санын жазады
        if ($replacementHoursNewProgramInClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 38.1 * $replacementHoursNewProgramInClassesWithFewerThan15Students;
            $data['additional_surcharges']['sum_replacement_hours_new_program_in_classes_with_fewer_than_15_students']
                = ($do1 + $do2) / 38.1 * $replacementHoursNewProgramInClassesWithFewerThan15Students;
        }
              // int --- Часы замены из них часы замены по новой программе в полных классах
        // Сағат санын жазады
        if ($replacementHoursNewProgramInClassesWithFullClasses) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 76.2 * $replacementHoursNewProgramInClassesWithFullClasses;
            $data['additional_surcharges']['sum_replacement_hours_new_program_in_classes_with_full_classes']
                = ($do1 + $do2) / 76.2 * $replacementHoursNewProgramInClassesWithFullClasses;
        }

           // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Сағат санын жазады
        if ($replacementHoursLyceumGymnasiumClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += $zchbdo * $replacementHoursNewProgramInClassesWithFullClasses * 0.05;
            $data['additional_surcharges']['sum_replacement_hours_lyceum_gymnasium_classes_with_fewer_than_15_students']
                = $zchbdo * $replacementHoursNewProgramInClassesWithFullClasses * 0.05;
        }
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
        //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
        if ($replacementHoursLyceumGymnasiumClassesFullClasses) {
            $sumAdditionalSurcharges += $zchbdo * $replacementHoursLyceumGymnasiumClassesFullClasses * 0.1;
            $data['additional_surcharges']['sum_replacement_hours_lyceum_gymnasium_classes_full_classes']
                = $zchbdo * $replacementHoursLyceumGymnasiumClassesFullClasses * 0.1;
        }
        // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
        if ($replacementClassroomManagementFrom1stTo4thGradeClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += $zchbdo * $replacementClassroomManagementFrom1stTo4thGradeClassesWithFewerThan15Students * 0.25;
            $data['additional_surcharges']['sum_replacement_classroom_management_from_1st_to_4th_grade_classes_with_fewer_than_15_students']
                = $zchbdo * $replacementClassroomManagementFrom1stTo4thGradeClassesWithFewerThan15Students * 0.25;
        }

        // int ---Замена классного руководства с 1 по 4 класс в полных классах
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        if ($replacementClassroomManagementFromGrade1ToGrade4FullClasses) {
            $sumAdditionalSurcharges += $zchbdo * $replacementClassroomManagementFromGrade1ToGrade4FullClasses * 0.5;
            $data['additional_surcharges']['sum_replacement_classroom_management_from_grade_1_to_grade_4_full_classes']
                = $zchbdo * $replacementClassroomManagementFromGrade1ToGrade4FullClasses * 0.5;
        }
        // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
        //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
        if ($replacementClassroomManagementFrom5stTo10thGradeClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += $zchbdo * $replacementClassroomManagementFrom5stTo10thGradeClassesWithFewerThan15Students * 0.3;
            $data['additional_surcharges']['sum_replacement_classroom_management_from_5st_to_10th_grade_classes_with_fewer_than_15_students']
                = $zchbdo * $replacementClassroomManagementFrom5stTo10thGradeClassesWithFewerThan15Students * 0.3;
        }
  // int ---Замена классного руководства с 5 по 10 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $replacementClassroomManagementFromGrade5ToGrade10FullClasses = $request->input('replacement_classroom_management_from_grade_5_to_grade_10_full_classes');
        if ($replacementClassroomManagementFromGrade5ToGrade10FullClasses) {
            $sumAdditionalSurcharges += $zchbdo * $replacementClassroomManagementFromGrade5ToGrade10FullClasses * 0.5;
            $data['additional_surcharges']['sum_replacement_classroom_management_from_grade_5_to_grade_10_full_classes']
                = $zchbdo * $replacementClassroomManagementFromGrade5ToGrade10FullClasses * 0.5;
        }
        $data['withheld'] = [];

         // checkbox --- Заявление об удержании профсоюзных взносов (1%)
        //Иә болса жалақы суммасынан ИТОГ*1% алынады.
        if ($applicationWithholdingUnionDues == 'true') {
            $data['withheld']['sum_application_withholding_union_dues'] = $sumAdditionalSurcharges * 0.01;
        }
        // checkbox ---Заявление об удержании партийных взносов (297,5 тенге)
        //ПВ (статичный) жалақы суммасынан алынады
        if ($applicationWithholdingPartyContributions == 'true') {
            $data['withheld']['sum_application_withholding_party_contributions'] = $pv;
        }

        // checkbox ---Работающий пенсионер
        //Итог*10% жалақы суммасынан алынады
        $data['withheld']['sum_mandatory_pension_contribution'] =  $workingPensioner == 'true' ? 0 :($sumAdditionalSurcharges * 0.1) ;

        // checkbox ---Освобожден от уплаты индивидуального подоходного налога
        //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
        if($exemptFromPayingIndividualIncomeTax == 'false') {
            $data['withheld']['sum_exempt_from_paying_individual_income_tax'] = ($sumAdditionalSurcharges * 0.88 - $snv) * 0.1;
        }
        $data['withheld']['sum_osms_contribution'] = $sumAdditionalSurcharges * 0.02;


        // $data['superpower']
        //work_in_radiation_risk_zone
        $data['do'] = $do;
        $data['sum_additional_surcharges'] = $sumAdditionalSurcharges;
        $data['total_accured'] = $do + $sumAdditionalSurcharges ;
        $data['total_withheld'] = array_sum($data['withheld']) ;
        $data['amount_hand'] = $data['total_accured']  - $data['total_withheld'];

        $this->storeSalaryCalculatorHistory($request);

        return response()->json([
            'data' => $data,
            'status' => true
        ]);
    }

    private function storeSalaryCalculatorHistory($request)
    {
        $salaryCalculator = new SalaryCalculatorHistory();
        $salaryCalculator->year = $request->input('year', now()->format('Y'));
        $salaryCalculator->month = $request->input('month', now()->format('m'));
        $salaryCalculator->education = $request->input('education', 'B2');

        $salaryCalculator->experience_year = $request->input('experience_year', 0);

        $salaryCalculator->experience_month = $request->input('experience_month', 0);
        $salaryCalculator->experience_day = $request->input('experience_day', 0);
        $salaryCalculator->work_in_village =  $request->input('work_in_village', false) == 'true';
        $salaryCalculator->special_working_conditions =   $request->input('special_working_conditions', false) =='true';
        $salaryCalculator->work_in_env_disaster_zone = $request->input('work_in_env_disaster_zone', 1);
        $salaryCalculator->work_in_radiation_risk_zone =$request->input('work_in_radiation_risk_zone', 1);
        $salaryCalculator->teaching_in_english = $request->input('teaching_in_english', 1);
        $salaryCalculator->magister_degree = $request->input('magister_degree', false) =='true';
        $salaryCalculator->mentoring = $request->input('mentoring', false) =='true';
        $salaryCalculator->ped_skill  = $request->input('ped_skill', 1);
        $salaryCalculator->class_guide  = $request->input('class_guide', false) =='true';
        $salaryCalculator->class_guide_elementary_grade  = $request->input('class_guide_elementary_grade', false) =='true';
        $salaryCalculator->class_occupancy  = $request->input('class_occupancy', 0);
        $salaryCalculator->for_managing_office  = $request->input('for_managing_office', 1);
        $salaryCalculator->for_running_workshop  = $request->input('for_running_workshop', false) =='true';
        $salaryCalculator->for_checking_notebook  = $request->input('for_checking_notebook', 1);
        $salaryCalculator->for_checking_notebooks_full_classes  =$request->input('for_checking_notebooks_full_classes', 0);
        $salaryCalculator->for_checking_notebooks_half_classes  =$request->input('for_checking_notebooks_half_classes', 0);
        $salaryCalculator->training_load_billing_load  =$request->input('training_load_billing_load', 0);
        $salaryCalculator->homeschooling  = $request->input('homeschooling', 0);
        $salaryCalculator->hours_with_lyceum_classes  = $request->input('hours_with_lyceum_classes', 0);
        $salaryCalculator->hours_in_depth_study  = $request->input('hours_in_depth_study', 0);
        $salaryCalculator->hours_updated_content  = $request->input('hours_updated_content', 0);
        $salaryCalculator->hours_specialized_subjects  =$request->input('hours_specialized_subjects',0);
        $salaryCalculator->replace_hours_half_classes  = $request->input('replace_hours_half_classes',0);
        $salaryCalculator->replace_hour_full_classes  = $request->input('replacement_hour_full_classes',0);
        $salaryCalculator->replace_hours_new_program_half_classes  = $request->input('replace_hours_new_program_half_classes',0);
        $salaryCalculator->replace_hours_new_program_full_classes  = $request->input('replace_hours_new_program_full_classes',0);
        $salaryCalculator->replace_hours_lyceum_classes_half_classes  =  $request->input('replace_hours_lyceum_classes_half_classes', 0);
        $salaryCalculator->replace_hours_lyceum_classes_full_classes  = $request->input('replace_hours_lyceum_classes_full_classes', 0);
        $salaryCalculator->replace_classroom_management_elementary_grade_half_classes  =$request->input('replace_classroom_management_elementary_grade_half_classes', 0);
        $salaryCalculator->replace_classroom_management_elementary_grade_full_classes  = $request->input('replace_classroom_management_elementary_grade_full_classes', 0);
        $salaryCalculator->replace_classroom_management_senior_grade_half_classes  = $request->input('replace_classroom_management_senior_grade_half_classes', 0);
        $salaryCalculator->replace_classroom_management_senior_grade_full_classes  = $request->input('replace_classroom_management_senior_grade_full_classes', 0);
        $salaryCalculator->app_withholding_union_dues  = $request->input('app_withholding_union_dues', false) =='true';
        $salaryCalculator->app_withholding_party_contributions  = $request->input('app_withholding_party_contributions', false) =='true';
        $salaryCalculator->working_pensioner  =$request->input('working_pensioner', false) =='true';
        $salaryCalculator->exempt_from_paying_individual_income_tax  = $request->input('exempt_from_paying_individual_income_tax', false) =='true';
        $salaryCalculator->category  = $request->input('category', 4);
        $salaryCalculator->save();
    }

    private function calculateSalary()
    {
        $year = $request->input('year', now()->format('Y'));
        // int -- select ---- 12 months
        //За период (месяц)
        $month = $request->input('month', now()->format('m'));
        // string -- select Высшее (B2), Среднее специальное (B4)
        //Образование

        $education = $request->input('education', 'B2');
        // int -- select
        //Стаж (лет)
        $experienceYear = $request->input('experience_year', 0);
        // int -- select
        //Стаж (месяцев)
        $experienceMonth = $request->input('experience_month', 0);
        // int -- select
        //Стаж (дней)
        $experienceDay = $request->input('experience_day', 0);
        // bool -- checkbox
        //Работа в сельской местности
        $workInVillage = $request->input('work_in_village', false);
        ////select - int
        ////Количество ставок
        //// 0.25,0.5,0.75,1,1.25,1.5,1.75,2
        //// $stavka = $request->input('stavka', 1);

        //bool -- checkbox
        //Доплата за особые условия труда (10%)
        $specialWorkingConditions = $request->input('special_working_conditions', false);
        // int
        // select --  Нет, Зона экологической катастрофы, Зона экологического кризиса, Зона экологического предкризисного состояния
        // 0, ДО*50%, ДО*30%, ДО*20% қосымша қосылады
        //Доплата за работу в зоне экологического бедствия
        $workInEnvironmentalDisasterZone = $request->input('work_in_env_disaster_zone', 1);

        // int
        // select -- Нет, Зона черезвычайного радиационнного риска, Зона максимального радиационнного риска,
        //Зона повышенного радиационнного риска, Зона минимального радиационнного риска, Зона с льготным социально-экономическим статусом
        //Доплата за работу на территориях радиационного риска

        // 0, МРП*2, МРП*1,75, МРП*1,5, МРП*1,25, МРП*1 қосымша қосылады

        $workInRadiationRiskZone = $request->input('work_in_radiation_risk_zone', 1);

        // int -- select -- Нет, Частичное погружение, Полное погружение
        // 0, БДО*1. БДО*2 қосымша қосылады
        //Доплата за преподавание на английском языке
        $teachingInEnglish = $request->input('teaching_in_english', 1);
        // bool --- checkbox
        //  МРП*10 қосымша қосылады
        // Доплата за степень магистра по НПН

        $magisterDegree = $request->input('magister_degree', false);
        // bool --- checkbox
        // БДО*1 қосымша қосылады
        // Доплата за наставничество
        $mentoring = $request->input('mentoring', false);
        // int
        // select -- Нет, педагог-модератор, педагог-эксперт,  педагог-исследователь, педагог-мастер
        //0, ДО*50%, ДО*40%, ДО*35%, ДО*30% қосымша қосылады
        // Пед. Мастерство
        $pedSkill = $request->input('ped_skill', 1);

        // checkbox -- Классное руководство
        //Полный класс: 1-4 сынып үшін БДО*50%,
        //5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады
        $classGuide = $request->input('class_guide', false);
        // checkbox -- Классное руководство: Начальный класс?
        //Полный класс: 1-4 сынып үшін БДО*50%,
        // 5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады
        $classGuideElementaryGrade = $request->input('class_guide_elementary_grade', false);
        //int -- Наполняемость класса
        //Санын енгізеді. Класное руководство Иә болғанда ғана жазуға болады. Кері жағдайда неактивный болады.
        $classOccupancy = $request->input('class_occupancy', 0);
        // select -- За заведование кабинетом
        //Нет, Половина дня, Полный день
        //0, БДО*10%, БДО*20%  или за мастерской всегда БДО*20% қосымша қосылады

        $forManagingOffice = $request->input('for_managing_office', 1);

        // checkbox -- bool -- За заведование мастерской
        //  за мастерской всегда БДО*20% қосымша қосылады
        $forRunningWorkshop = $request->input('for_running_workshop', false);
        // int
        // select -- За проверку тетрадей
        // Нет, Учитель начальных классов, Учитель ЕМН, Учитель языка и литературы
        // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%
        $forCheckingNotebook = $request->input('for_checking_notebook', 1);
        //int ---  За проверку тетрадей в полных классах
        // Сағат санын жазады
        //(Тетрадь*Сағат саны) қосымша қосылады
        $forCheckingNotebooksFullClasses = $request->input('for_checking_notebooks_full_classes', 0);
        //int --- За проверку тетрадей в классах с числом менее 15 учащихся
        // Сағат санын жазады
        //(Тетрадь*Сағат саны/2) қосымша қосылады
        $forCheckingNotebooksClassesLessThan15Students = $request->input('for_checking_notebooks_half_classes', 0);

        // iint --- Учебная нагрузка по тарификации - Нагрузка
        // Сағат санын жазады
        //ДО анықтауға керек негізге параметр. ДО = БДО/16*сағат санына
        $trainingLoadBillingLoad = $request->input('training_load_billing_load', 0);
        // int --- Обучение на дому
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        $homeschooling = $request->input('homeschooling', 0);
        // int --- Часы работы с лицейcкими и гимназическими классами
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        $hoursWithLyceumGymnasiumClasses = $request->input('hours_with_lyceum_classes', 0);
        // int --- Часы углубленного изучения
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        $hoursInDepthStudy = $request->input('hours_in_depth_study', 0);
        // int --- Часы обновленного содержания
        // Сағат санын жазады (еш әсер бермейді)
        // ДО*30%  --- қосымша қосылады
        $hoursUpdatedContent = $request->input('hours_updated_content', 0);
        // int --- Часы по предметам профильного назначения
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        $hoursSpecializedSubjects = $request->input('hours_specialized_subjects',0);
        // int --- Часы замены в классах с числом менее 15 учащихся
        // Сағат санын жазады
        // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
        //44
         //38,1 classes_with_fewer_than_15_students
        $replacementHoursInClassesWithFewerThan15Students = $request->input('replace_hours_half_classes',0);
        // int --- Часы замены в полных классах
        // Сағат санын жазады
        // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
        // 76,2 коэфицент
        //45
        $replacementHourFullClasses = $request->input('replacement_hour_full_classes',0);
        // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
        // Сағат санын жазады
        // 38.1 коэфицент
        //46
        $replacementHoursNewProgramInClassesWithFewerThan15Students = $request->input('replace_hours_new_program_half_classes',0);
        // int --- Часы замены из них часы замены по новой программе в полных классах
        // Сағат санын жазады
        // 38.1 коэфицент
        $replacementHoursNewProgramInClassesWithFullClasses = $request->input('replace_hours_new_program_full_classes', 0);
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Сағат санын жазады
        $replacementHoursLyceumGymnasiumClassesWithFewerThan15Students = $request->input('replace_hours_lyceum_classes_half_classes', 0);
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
        //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
        // Сағат санын жазады
        $replacementHoursLyceumGymnasiumClassesFullClasses = $request->input('replace_hours_lyceum_classes_full_classes', 0);
        // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
        $replacementClassroomManagementFrom1stTo4thGradeClassesWithFewerThan15Students = $request->input('replace_classroom_management_elementary_grade_half_classes', 0);
        // int ---Замена классного руководства с 1 по 4 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $replacementClassroomManagementFromGrade1ToGrade4FullClasses = $request->input('replace_classroom_management_elementary_grade_full_classes', 0);

        // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
        $replacementClassroomManagementFrom5stTo10thGradeClassesWithFewerThan15Students = $request->input('replace_classroom_management_senior_grade_half_classes', 0);
        // int ---Замена классного руководства с 5 по 10 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $replacementClassroomManagementFromGrade5ToGrade10FullClasses = $request->input('replace_classroom_management_senior_grade_full_classes', 0);
        // checkbox --- Заявление об удержании профсоюзных взносов (1%)
        //Иә болса жалақы суммасынан ИТОГ*1% алынады.
        $applicationWithholdingUnionDues = $request->input('app_withholding_union_dues', false);
        // checkbox ---Заявление об удержании партийных взносов (297,5 тенге)
        //ПВ (статичный) жалақы суммасынан алынады
        $applicationWithholdingPartyContributions  = $request->input('app_withholding_party_contributions', false);
        // checkbox ---Работающий пенсионер
        //Итог*10% жалақы суммасынан алынады
        $workingPensioner  = $request->input('working_pensioner', false);
        // checkbox ---Освобожден от уплаты индивидуального подоходного налога
        //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
        $exemptFromPayingIndividualIncomeTax  = $request->input('exempt_from_paying_individual_income_tax', false);


        $category = $request->input('category', 4);

        $salaryCalculatorData = SalaryCalculator::latest()->first();
        if (empty($salaryCalculatorData)) {
            return 0;
        }
        $experience = round($experienceYear + $experienceMonth / 12 + $experienceDay / 365, 2);
        // dd(,floatval($experienceYear . '.' . $experienceMonth));
        // $experience = floatval($experienceYear . '.' . $experienceMonth);
        $coefficient = SalaryCalculationService::getCoefficent($education, $category, $experience, $year, $month);
        $mrp = $salaryCalculatorData->mrp;
        $bdo = $salaryCalculatorData->bdo;
        $pv = $salaryCalculatorData->pv;
        $snv = $salaryCalculatorData->snv;
        $dpop = $salaryCalculatorData->dpop;
        $zchbdo = $bdo / 16;
        $do1 = $bdo * $coefficient;
        // Увеличение ДО согласно поправочного коэффициента 75 %

        // $stavka = floatval($stavka);
        // $hours = in_array($stavka, SalaryCalculator::STAVKI) ? 18 * $stavka : 0;

        $do2 = $do1 * 0.75;
        $do = ($do1 + $do2) / 16 * $trainingLoadBillingLoad;
        // начислено по тарифу
        // $resultByTariff = $workInVillage == 'true' ? $do * 1.25 : $do;
        //---/
        $do = $workInVillage == 'true' ? $do * 1.25 : $do;
        $data = [
            'base' => [
                'bdo' => $bdo,
                'coefficient' => $coefficient,
                'do1' => $do1,
                'do2' => $do2,
                'do' => $do
                // 'result' => $do,
                // 'result_by_tariff' => $resultByTariff,
                // 'work_in_village' => $workInVillage == 'true',
                // 'sum_work_in_village' => $sumWorkInVillage,
            ],
            'additional_surcharges' => []
        ];
        $sumAdditionalSurcharges = 0;
        //ауылдық болса егер
        // $sumWorkInVillage = $workInVillage == 'true' ? $do * 0.25 : 0;
        if ($workInVillage == 'true') {
            $data['base']['sum_work_in_village'] = $do * 0.25;
        }

        // Доплата за особые условия труда (10%)
        if ($specialWorkingConditions == 'true') {
            // $do = $do * 1.1;
            $sumAdditionalSurcharges += $do * 0.1;
            $data['additional_surcharges']['sum_special_working_conditions'] = $do * 0.1;
        }
        //
        // Пед. Мастерство
        foreach (SalaryCalculator::PED_SKILLS as $pedSkillItem) {
            if ($pedSkill == $pedSkillItem['number']) {
                $sumAdditionalSurcharges += $do * floatval('0.' . $pedSkillItem['percent']);
                $data['additional_surcharges']['sum_ped_skill'] = $do * floatval('0.' . $pedSkillItem['percent']);
            }
        }

        //Доплата за работу в зоне экологического бедствия

        foreach (SalaryCalculator::WORK_IN_ENVIRONMENTAL_DISASTER_ZONES as $workInEnvironmentalDisasterZoneItem) {
            if ($workInEnvironmentalDisasterZoneItem['number'] == $workInEnvironmentalDisasterZone) {
                $sumAdditionalSurcharges += $do * floatval('0.' . $workInEnvironmentalDisasterZoneItem['percent']);
                $data['additional_surcharges']['sum_work_in_env_disaster_zone']
                    = $do * floatval('0.' . $workInEnvironmentalDisasterZoneItem['percent']);
            }
        }
        //Доплата за работу на территориях радиационного риска
        foreach (SalaryCalculator::WORK_IN_RADIATION_RISK_ZONES as $workInRadiationRiskZoneItem) {
            if ($workInRadiationRiskZoneItem['number'] == $workInRadiationRiskZone) {
                $sumAdditionalSurcharges += $mrp * $workInRadiationRiskZoneItem['mrp'];
                $data['additional_surcharges']['sum_work_in_radiation_risk_zone'] = $mrp * $workInRadiationRiskZoneItem['mrp'];
            }
        }

        //Доплата за преподавание на английском языке
        foreach (SalaryCalculator::TECHING_IN_ENGLISH_ITEMS as $teachingInEnglishItem) {
            if ($teachingInEnglish == $teachingInEnglishItem['number']) {
                $sumAdditionalSurcharges += $bdo * $teachingInEnglishItem['bdo'];
                $data['additional_surcharges']['sum_teaching_in_english'] = $bdo * $teachingInEnglishItem['bdo'];
            }
        }

        // Доплата за степень магистра по НПН
        if ($magisterDegree == 'true') {
            $sumAdditionalSurcharges += $mrp * 10;
            $data['additional_surcharges']['sum_teaching_in_english'] = $mrp * 10;
        }
        // Доплата за наставничество
        if ($mentoring == 'true') {
            $sumAdditionalSurcharges += $bdo * 1;
            $data['additional_surcharges']['sum_mentoring'] = $bdo * 1;
        }

        // checkbox -- Классное руководство
        //Полный класс: 1-4 сынып үшін БДО*50%,
        //5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады

        if($classGuide == 'true') {
            if($classGuideElementaryGrade == 'true') {
                if (intval( $classOccupancy) > 0  && intval( $classOccupancy) < 15) {
                    $sumAdditionalSurcharges += $bdo * 0.25;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.25;


                } else if (intval( $classOccupancy) >= 15) {
                    $sumAdditionalSurcharges += $bdo * 0.5;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.5;
                }
            } else {
                if (intval( $classOccupancy) > 0  && intval( $classOccupancy) < 15) {
                    $sumAdditionalSurcharges += $bdo * 0.3;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.3;

                } else if (intval( $classOccupancy) >= 15) {
                    $sumAdditionalSurcharges += $bdo * 0.6;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.6;
                }
            }
        }
        //За заведование кабинетом
        foreach (SalaryCalculator::FOR_MANAGING_OFFICE_ITEMS as $forManagingOfficeItem) {
            if ($forManagingOffice == $forManagingOfficeItem['number']) {
                $sumAdditionalSurcharges +=  $bdo * floatval('0.' . $forManagingOfficeItem['bdo_percent']);;
                $data['additional_surcharges']['sum_for_managing_office'] = $bdo * floatval('0.' . $forManagingOfficeItem['bdo_percent']);
            }
        }
        // За заведование мастерской
        if ($forRunningWorkshop == 'true') {
            $sumAdditionalSurcharges += $bdo * 0.20;
            $data['additional_surcharges']['sum_for_running_workshop'] = $bdo * 0.20;
        }

        // select -- За проверку тетрадей
        // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%

        if ($forCheckingNotebook != SalaryCalculator::FOR_CHECKING_NOTEBOOKS[0]['number']) {
            foreach (SalaryCalculator::FOR_CHECKING_NOTEBOOKS as $forCheckingNotebookItem) {
                if ($forCheckingNotebookItem['number'] == $forCheckingNotebook) {
                    $sumAdditionalSurcharges += $zchbdo * (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent']))  *  $forCheckingNotebooksFullClasses;
                    $data['additional_surcharges']['sum_for_checking_notebooks_full_classes'] =  $zchbdo * (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent']))  *  $forCheckingNotebooksFullClasses;
                    $sumAdditionalSurcharges +=  $zchbdo *  (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent'])) * ($forCheckingNotebooksClassesLessThan15Students / 2);
                    $data['additional_surcharges']['sum_for_checking_notebooks_classes_less_than_15_students'] = $zchbdo *  (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent'])) * ($forCheckingNotebooksClassesLessThan15Students / 2);
                }
            }
        }
        //Учебная нагрузка по тарификации - Нагрузка
        // $trainingLoadBillingLoad =

        // int --- Обучение на дому
        if ($homeschooling) {
            $sumAdditionalSurcharges += $zchbdo  * $homeschooling * 0.4;
            $data['additional_surcharges']['sum_shomeschooling'] = $zchbdo  * $homeschooling * 0.4;
        }

        // int --- Часы работы с лицейcкими и гимназическими классами
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        if ($hoursWithLyceumGymnasiumClasses) {
            $sumAdditionalSurcharges += $zchbdo * $hoursWithLyceumGymnasiumClasses * 0.2;
            $data['additional_surcharges']['sum_hours_with_lyceum_gymnasium_classes'] = $zchbdo * $hoursWithLyceumGymnasiumClasses * 0.2;
        }
        // int --- Часы углубленного изучения
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        if ($hoursInDepthStudy) {
            $sumAdditionalSurcharges += $zchbdo * $hoursInDepthStudy * 0.2;
            $data['additional_surcharges']['sum_hours_in_depth_study'] = $zchbdo * $hoursInDepthStudy * 0.2;
        }
        // int --- Часы обновленного содержания
        // Сағат санын жазады (еш әсер бермейді)
        // ДО*30%  --- қосымша қосылады
        if ($hoursUpdatedContent) {
            $sumAdditionalSurcharges += $do * 0.3;
            $data['additional_surcharges']['sum_hours_updated_content'] = $do * 0.3;
        }

        // int --- Часы по предметам профильного назначения
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        if ($hoursSpecializedSubjects) {
            $sumAdditionalSurcharges += $zchbdo * $hoursSpecializedSubjects * 0.4;
            $data['additional_surcharges']['sum_hours_specialized_subjects'] = $zchbdo * $hoursSpecializedSubjects * 0.4;
        }

        // int --- Часы замены в классах с числом менее 15 учащихся
        // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
        // 38,1 коэфицент
        if ($replacementHoursInClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 38.1 * $replacementHoursInClassesWithFewerThan15Students;
            $data['additional_surcharges']['sum_replacement_hours_in_classes_with_fewer_than_15_students']
                = ($do1 + $do2) / 38.1 * $replacementHoursInClassesWithFewerThan15Students;
        }
        // int --- Часы замены в полных классах
        // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
        // 76,2 коэфицент

        if ($replacementHourFullClasses) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 76.2 * $replacementHourFullClasses;
            $data['additional_surcharges']['sum_replacement_hour_full_classes']
                = ($do1 + $do2) / 76.2 * $replacementHourFullClasses;
        }
        // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
        // Сағат санын жазады
        if ($replacementHoursNewProgramInClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 38.1 * $replacementHoursNewProgramInClassesWithFewerThan15Students;
            $data['additional_surcharges']['sum_replacement_hours_new_program_in_classes_with_fewer_than_15_students']
                = ($do1 + $do2) / 38.1 * $replacementHoursNewProgramInClassesWithFewerThan15Students;
        }
              // int --- Часы замены из них часы замены по новой программе в полных классах
        // Сағат санын жазады
        if ($replacementHoursNewProgramInClassesWithFullClasses) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 76.2 * $replacementHoursNewProgramInClassesWithFullClasses;
            $data['additional_surcharges']['sum_replacement_hours_new_program_in_classes_with_full_classes']
                = ($do1 + $do2) / 76.2 * $replacementHoursNewProgramInClassesWithFullClasses;
        }

           // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Сағат санын жазады
        if ($replacementHoursLyceumGymnasiumClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += $zchbdo * $replacementHoursNewProgramInClassesWithFullClasses * 0.05;
            $data['additional_surcharges']['sum_replacement_hours_lyceum_gymnasium_classes_with_fewer_than_15_students']
                = $zchbdo * $replacementHoursNewProgramInClassesWithFullClasses * 0.05;
        }
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
        //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
        if ($replacementHoursLyceumGymnasiumClassesFullClasses) {
            $sumAdditionalSurcharges += $zchbdo * $replacementHoursLyceumGymnasiumClassesFullClasses * 0.1;
            $data['additional_surcharges']['sum_replacement_hours_lyceum_gymnasium_classes_full_classes']
                = $zchbdo * $replacementHoursLyceumGymnasiumClassesFullClasses * 0.1;
        }
        // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
        if ($replacementClassroomManagementFrom1stTo4thGradeClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += $zchbdo * $replacementClassroomManagementFrom1stTo4thGradeClassesWithFewerThan15Students * 0.25;
            $data['additional_surcharges']['sum_replacement_classroom_management_from_1st_to_4th_grade_classes_with_fewer_than_15_students']
                = $zchbdo * $replacementClassroomManagementFrom1stTo4thGradeClassesWithFewerThan15Students * 0.25;
        }

        // int ---Замена классного руководства с 1 по 4 класс в полных классах
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        if ($replacementClassroomManagementFromGrade1ToGrade4FullClasses) {
            $sumAdditionalSurcharges += $zchbdo * $replacementClassroomManagementFromGrade1ToGrade4FullClasses * 0.5;
            $data['additional_surcharges']['sum_replacement_classroom_management_from_grade_1_to_grade_4_full_classes']
                = $zchbdo * $replacementClassroomManagementFromGrade1ToGrade4FullClasses * 0.5;
        }
        // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
        //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
        if ($replacementClassroomManagementFrom5stTo10thGradeClassesWithFewerThan15Students) {
            $sumAdditionalSurcharges += $zchbdo * $replacementClassroomManagementFrom5stTo10thGradeClassesWithFewerThan15Students * 0.3;
            $data['additional_surcharges']['sum_replacement_classroom_management_from_5st_to_10th_grade_classes_with_fewer_than_15_students']
                = $zchbdo * $replacementClassroomManagementFrom5stTo10thGradeClassesWithFewerThan15Students * 0.3;
        }
  // int ---Замена классного руководства с 5 по 10 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $replacementClassroomManagementFromGrade5ToGrade10FullClasses = $request->input('replacement_classroom_management_from_grade_5_to_grade_10_full_classes');
        if ($replacementClassroomManagementFromGrade5ToGrade10FullClasses) {
            $sumAdditionalSurcharges += $zchbdo * $replacementClassroomManagementFromGrade5ToGrade10FullClasses * 0.5;
            $data['additional_surcharges']['sum_replacement_classroom_management_from_grade_5_to_grade_10_full_classes']
                = $zchbdo * $replacementClassroomManagementFromGrade5ToGrade10FullClasses * 0.5;
        }
        $data['withheld'] = [];

         // checkbox --- Заявление об удержании профсоюзных взносов (1%)
        //Иә болса жалақы суммасынан ИТОГ*1% алынады.
        if ($applicationWithholdingUnionDues == 'true') {
            $data['withheld']['sum_application_withholding_union_dues'] = $sumAdditionalSurcharges * 0.01;
        }
        // checkbox ---Заявление об удержании партийных взносов (297,5 тенге)
        //ПВ (статичный) жалақы суммасынан алынады
        if ($applicationWithholdingPartyContributions == 'true') {
            $data['withheld']['sum_application_withholding_party_contributions'] = $pv;
        }

        // checkbox ---Работающий пенсионер
        //Итог*10% жалақы суммасынан алынады
        $data['withheld']['sum_mandatory_pension_contribution'] =  $workingPensioner == 'true' ? 0 :($sumAdditionalSurcharges * 0.1) ;

        // checkbox ---Освобожден от уплаты индивидуального подоходного налога
        //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
        if($exemptFromPayingIndividualIncomeTax == 'false') {
            $data['withheld']['sum_exempt_from_paying_individual_income_tax'] = ($sumAdditionalSurcharges * 0.88 - $snv) * 0.1;
        }
        $data['withheld']['sum_osms_contribution'] = $sumAdditionalSurcharges * 0.02;


        // $data['superpower']
        //work_in_radiation_risk_zone
        $data['do'] = $do;
        $data['sum_additional_surcharges'] = $sumAdditionalSurcharges;
        $data['total_accured'] = $do + $sumAdditionalSurcharges ;
        $data['total_withheld'] = array_sum($data['withheld']) ;
        $data['amount_hand'] = $data['total_accured']  - $data['total_withheld'];
    }


    public function downloadPDF()
    {
        // $pdf = PDF::loadView('pdf/salary', compact('user'));
        PDF::setOptions(['defaultFont' => 'arail_uni.ttf']);

        $salaryHistory = SalaryCalculatorHistory::firstOrFail();
        $pdf = PDF::loadView('pdf/salary');
        return $pdf->download('invoice.pdf');
    }
}
