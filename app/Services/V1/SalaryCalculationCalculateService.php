<?php


namespace App\Services\V1;

use App\Models\SalaryCalculator;
use App\Models\SalaryCalculatorCoefficient;
use Illuminate\Support\Str;

class SalaryCalculationCalculateService
{
    public     $year, $month, $education,
        $experienceYear, $experienceMonth, $experienceDay, $workInVillage,
        $specialWorkingConditions, $work_in_env_disaster_zone,
        $work_in_radiation_risk_zone, $teaching_in_english,
        $magister_degree, $mentoring, $pedSkill,
        $class_guide, $class_guide_elementary_grade,
        $class_occupancy, $for_managing_office, $for_running_workshop,
        $for_checking_notebook, $for_checking_notebooks_full_classes,
        $for_checking_notebooks_half_classes,
         $trainingLoadBillingLoad, $homeschooling,
        $hours_with_lyceum_classes, $hours_in_depth_study, $hours_updated_content,
        $hours_specialized_subjects,
        $replace_hours_half_classes, $replace_hour_full_classes,
        $replace_hours_new_program_half_classes, $replace_hours_new_program_full_classes,
        $replace_hours_lyceum_classes_half_classes, $replace_hours_lyceum_classes_full_classes,
        $replace_classroom_management_elementary_grade_half_classes,
        $replace_classroom_management_elementary_grade_full_classes,
        $replace_classroom_management_senior_grade_half_classes,
        $replace_classroom_management_senior_grade_full_classes,
        $app_withholding_union_dues, $app_withholding_party_contributions,
        $working_pensioner, $exempt_from_paying_individual_income_tax,
        $category;

    public function calculateSalary()
    {

        $salaryCalculatorData = SalaryCalculator::latest()->first();
        if (empty($salaryCalculatorData)) {
            return 0;
        }
        $experience = round($this->experienceYear + $this->experienceMonth / 12 + $this->experienceDay / 365, 2);
        // dd(,floatval($experienceYear . '.' . $experienceMonth));
        // $experience = floatval($experienceYear . '.' . $experienceMonth);
        $coefficient = SalaryCalculationService::getCoefficent($this->education, $this->category, $experience, $this->year, $this->month);
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
        $do = ($do1 + $do2) / 16 * $this->trainingLoadBillingLoad;
        // начислено по тарифу
        // $resultByTariff = $workInVillage == 'true' ? $do * 1.25 : $do;
        //---/
        $do = $this->workInVillage == 'true' ? $do * 1.25 : $do;
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
        if ($this->workInVillage == 'true') {
            $data['base']['sum_work_in_village'] = $do * 0.25;
        }

        // Доплата за особые условия труда (10%)
        if ($this->specialWorkingConditions == 'true') {
            // $do = $do * 1.1;
            $sumAdditionalSurcharges += $do * 0.1;
            $data['additional_surcharges']['sum_special_working_conditions'] = $do * 0.1;
        }
        //
        // Пед. Мастерство
        foreach (SalaryCalculator::PED_SKILLS as $pedSkillItem) {
            if ($this->pedSkill == $pedSkillItem['number']) {
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

        if ($classGuide == 'true') {
            if ($classGuideElementaryGrade == 'true') {
                if (intval($classOccupancy) > 0  && intval($classOccupancy) < 15) {
                    $sumAdditionalSurcharges += $bdo * 0.25;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.25;
                } else if (intval($classOccupancy) >= 15) {
                    $sumAdditionalSurcharges += $bdo * 0.5;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.5;
                }
            } else {
                if (intval($classOccupancy) > 0  && intval($classOccupancy) < 15) {
                    $sumAdditionalSurcharges += $bdo * 0.3;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.3;
                } else if (intval($classOccupancy) >= 15) {
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
        $data['withheld']['sum_mandatory_pension_contribution'] =  $workingPensioner == 'true' ? 0 : ($sumAdditionalSurcharges * 0.1);

        // checkbox ---Освобожден от уплаты индивидуального подоходного налога
        //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
        if ($exemptFromPayingIndividualIncomeTax == 'false') {
            $data['withheld']['sum_exempt_from_paying_individual_income_tax'] = ($sumAdditionalSurcharges * 0.88 - $snv) * 0.1;
        }
        $data['withheld']['sum_osms_contribution'] = $sumAdditionalSurcharges * 0.02;


        // $data['superpower']
        //work_in_radiation_risk_zone
        $data['do'] = $do;
        $data['sum_additional_surcharges'] = $sumAdditionalSurcharges;
        $data['total_accured'] = $do + $sumAdditionalSurcharges;
        $data['total_withheld'] = array_sum($data['withheld']);
        $data['amount_hand'] = $data['total_accured']  - $data['total_withheld'];
        return $data;
    }
}
