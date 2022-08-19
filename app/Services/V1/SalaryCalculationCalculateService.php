<?php


namespace App\Services\V1;

use App\Models\SalaryCalculator;
use App\Models\SalaryCalculatorCoefficient;
use Illuminate\Support\Str;

class SalaryCalculationCalculateService
{
    public     $year, $month, $education,
        $experienceYear, $experienceMonth, $experienceDay, $workInVillage,
        $specialWorkingConditions, $workInEnvDisasterZone,
        $workInRadiationRiskZone, $teachingInEnglish,
        $magisterDegree, $mentoring, $pedSkill,
        $classGuide, $classGuideElementaryGrade,
        $classOccupancy, $forManagingOffice, $forRunningWorkshop,
        $forCheckingNotebook, $forCheckingNotebooksFullClasses,
        $forCheckingNotebooksHalfClasses,
         $trainingLoadBillingLoad, $homeschooling,
        $hoursWithLyceumClasses, $hoursInDepthStudy, $hoursUpdatedContent,
        $hoursSpecializedSubjects,
        $replaceHoursHalfClasses, $replaceHourFullClasses,
        $replaceHoursNewProgramHalfClasses, $replaceHoursNewProgramFullClasses,
        $replaceHoursLyceumClassesHalfClasses, $replaceHoursLyceumClassesFullClasses,
        $replaceClassroomManagementElementaryGradeHalfClasses,
        $replaceClassroomManagementElementaryGradeFullClasses,
        $replaceClassroomManagementSeniorGradeHalfClasses,
        $replaceClassroomManagementSeniorGradeFullClasses,
        $appWithholdingUnionDues, $appWithholdingPartyContributions,
        $workingPensioner, $exemptFromPayingIndividualOncomeTax,
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
            if ($workInEnvironmentalDisasterZoneItem['number'] == $this->workInEnvDisasterZone) {
                $sumAdditionalSurcharges += $do * floatval('0.' . $workInEnvironmentalDisasterZoneItem['percent']);
                $data['additional_surcharges']['sum_work_in_env_disaster_zone']
                    = $do * floatval('0.' . $workInEnvironmentalDisasterZoneItem['percent']);
            }
        }
        //Доплата за работу на территориях радиационного риска
        foreach (SalaryCalculator::WORK_IN_RADIATION_RISK_ZONES as $workInRadiationRiskZoneItem) {
            if ($workInRadiationRiskZoneItem['number'] == $this->workInRadiationRiskZone) {
                $sumAdditionalSurcharges += $mrp * $workInRadiationRiskZoneItem['mrp'];
                $data['additional_surcharges']['sum_work_in_radiation_risk_zone'] = $mrp * $workInRadiationRiskZoneItem['mrp'];
            }
        }

        //Доплата за преподавание на английском языке
        foreach (SalaryCalculator::TECHING_IN_ENGLISH_ITEMS as $teachingInEnglishItem) {
            if ($this->teachingInEnglish == $teachingInEnglishItem['number']) {
                $sumAdditionalSurcharges += $bdo * $teachingInEnglishItem['bdo'];
                $data['additional_surcharges']['sum_teaching_in_english'] = $bdo * $teachingInEnglishItem['bdo'];
            }
        }

        // Доплата за степень магистра по НПН
        if ($this->magisterDegree == 'true') {
            $sumAdditionalSurcharges += $mrp * 10;
            $data['additional_surcharges']['sum_teaching_in_english'] = $mrp * 10;
        }
        // Доплата за наставничество
        if ($this->mentoring == 'true') {
            $sumAdditionalSurcharges += $bdo * 1;
            $data['additional_surcharges']['sum_mentoring'] = $bdo * 1;
        }

        // checkbox -- Классное руководство
        //Полный класс: 1-4 сынып үшін БДО*50%,
        //5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады

        if ($this->classGuide == 'true') {
            if ($this->classGuideElementaryGrade == 'true') {
                if (intval($this->classOccupancy) > 0  && intval($this->classOccupancy) < 15) {
                    $sumAdditionalSurcharges += $bdo * 0.25;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.25;
                } else if (intval($this->classOccupancy) >= 15) {
                    $sumAdditionalSurcharges += $bdo * 0.5;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.5;
                }
            } else {
                if (intval($this->classOccupancy) > 0  && intval($this->classOccupancy) < 15) {
                    $sumAdditionalSurcharges += $bdo * 0.3;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.3;
                } else if (intval($this->classOccupancy) >= 15) {
                    $sumAdditionalSurcharges += $bdo * 0.6;
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.6;
                }
            }
        }
        //За заведование кабинетом
        foreach (SalaryCalculator::FOR_MANAGING_OFFICE_ITEMS as $forManagingOfficeItem) {
            if ($this->forManagingOffice == $forManagingOfficeItem['number']) {
                $sumAdditionalSurcharges +=  $bdo * floatval('0.' . $forManagingOfficeItem['bdo_percent']);;
                $data['additional_surcharges']['sum_for_managing_office'] = $bdo * floatval('0.' . $forManagingOfficeItem['bdo_percent']);
            }
        }
        // За заведование мастерской
        if ($this->forRunningWorkshop == 'true') {
            $sumAdditionalSurcharges += $bdo * 0.20;
            $data['additional_surcharges']['sum_for_running_workshop'] = $bdo * 0.20;
        }

        // select -- За проверку тетрадей
        // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%

        if ($this->forCheckingNotebook != SalaryCalculator::FOR_CHECKING_NOTEBOOKS[0]['number']) {
            foreach (SalaryCalculator::FOR_CHECKING_NOTEBOOKS as $forCheckingNotebookItem) {
                if ($forCheckingNotebookItem['number'] == $this->forCheckingNotebook) {
                    $sumAdditionalSurcharges += $zchbdo * (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent']))  *  $this->forCheckingNotebooksFullClasses;
                    $data['additional_surcharges']['sum_for_checking_notebooks_full_classes'] =  $zchbdo * (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent']))  *  $this->forCheckingNotebooksFullClasses;
                    $sumAdditionalSurcharges +=  $zchbdo *  (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent'])) * ($this->forCheckingNotebooksHalfClasses / 2);
                    $data['additional_surcharges']['for_checking_notebooks_half_classes'] = $zchbdo *  (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent'])) * ($this->forCheckingNotebooksHalfClasses / 2);
                }
            }
        }
        //Учебная нагрузка по тарификации - Нагрузка
        // $trainingLoadBillingLoad =

        // int --- Обучение на дому
        if ($this->homeschooling) {
            $sumAdditionalSurcharges += $zchbdo  * $this->homeschooling * 0.4;
            $data['additional_surcharges']['sum_shomeschooling'] = $zchbdo  * $this->homeschooling * 0.4;
        }

        // int --- Часы работы с лицейcкими и гимназическими классами
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        if ($this->hoursWithLyceumClasses) {
            $sumAdditionalSurcharges += $zchbdo * $this->hoursWithLyceumClasses * 0.2;
            $data['additional_surcharges']['sum_hours_with_lyceum_gymnasium_classes'] = $zchbdo * $this->hoursWithLyceumClasses * 0.2;
        }
        // int --- Часы углубленного изучения
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        if ($this->hoursInDepthStudy) {
            $sumAdditionalSurcharges += $zchbdo * $this->hoursInDepthStudy * 0.2;
            $data['additional_surcharges']['sum_hours_in_depth_study'] = $zchbdo * $this->hoursInDepthStudy * 0.2;
        }
        // int --- Часы обновленного содержания
        // Сағат санын жазады (еш әсер бермейді)
        // ДО*30%  --- қосымша қосылады
        if ($this->hoursUpdatedContent) {
            $sumAdditionalSurcharges += $do * 0.3;
            $data['additional_surcharges']['sum_hours_updated_content'] = $do * 0.3;
        }

        // int --- Часы по предметам профильного назначения
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        if ($this->hoursSpecializedSubjects) {
            $sumAdditionalSurcharges += $zchbdo * $this->hoursSpecializedSubjects * 0.4;
            $data['additional_surcharges']['sum_hours_specialized_subjects'] = $zchbdo * $this->hoursSpecializedSubjects * 0.4;
        }

        // int --- Часы замены в классах с числом менее 15 учащихся
        // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
        // 38,1 коэфицент
        if ($this->replaceHoursHalfClasses) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 38.1 * $this->replaceHoursHalfClasses;
            $data['additional_surcharges']['sum_replace_hours_half_classes']
                = ($do1 + $do2) / 38.1 * $this->replaceHoursHalfClasses;
        }
        // int --- Часы замены в полных классах
        // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
        // 76,2 коэфицент

        if ($this->replaceHourFullClasses) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 76.2 * $this->replaceHourFullClasses;
            $data['additional_surcharges']['sum_replacement_hour_full_classes']
                = ($do1 + $do2) / 76.2 * $this->replaceHourFullClasses;
        }
        // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
        // Сағат санын жазады
        if ($this->replaceHoursNewProgramHalfClasses) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 38.1 * $this->replaceHoursNewProgramHalfClasses;
            $data['additional_surcharges']['sum_replace_hours_new_program_half_classes']
                = ($do1 + $do2) / 38.1 * $this->replaceHoursNewProgramHalfClasses;
        }
        // int --- Часы замены из них часы замены по новой программе в полных классах
        // Сағат санын жазады
        if ($this->replaceHoursNewProgramFullClasses) {
            $sumAdditionalSurcharges += ($do1 + $do2) / 76.2 * $this->replaceHoursNewProgramFullClasses;
            $data['additional_surcharges']['sum_replace_hours_new_program_full_classes']
                = ($do1 + $do2) / 76.2 * $this->replaceHoursNewProgramFullClasses;
        }

        // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Сағат санын жазады
        if ($this->replaceHoursLyceumClassesHalfClasses) {
            $sumAdditionalSurcharges += $zchbdo * $this->replaceHoursLyceumClassesHalfClasses * 0.05;
            $data['additional_surcharges']['sum_replace_hours_lyceum_classes_half_classes']
                = $zchbdo * $this->replaceHoursLyceumClassesHalfClasses * 0.05;
        }
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
        //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
        if ($this->replaceHoursLyceumClassesFullClasses) {
            $sumAdditionalSurcharges += $zchbdo * $this->replaceHoursLyceumClassesFullClasses * 0.1;
            $data['additional_surcharges']['sum_replace_hours_lyceum_classes_full_classes']
                = $zchbdo * $this->replaceHoursLyceumClassesFullClasses * 0.1;
        }
        // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
        if ($this->replaceClassroomManagementElementaryGradeHalfClasses) {
            $sumAdditionalSurcharges += $zchbdo * $this->replaceClassroomManagementElementaryGradeHalfClasses * 0.25;
            $data['additional_surcharges']['sum_replace_classroom_management_elementary_grade_half_classes']
                = $zchbdo * $this->replaceClassroomManagementElementaryGradeHalfClasses * 0.25;
        }

        // int ---Замена классного руководства с 1 по 4 класс в полных классах
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        if ($this->replaceClassroomManagementElementaryGradeFullClasses) {
            $sumAdditionalSurcharges += $zchbdo * $this->replaceClassroomManagementElementaryGradeFullClasses * 0.5;
            $data['additional_surcharges']['sum_replace_classroom_management_elementary_grade_full_classes']
                = $zchbdo * $this->replaceClassroomManagementElementaryGradeFullClasses * 0.5;
        }
        // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
        //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
        if ($this->replaceClassroomManagementSeniorGradeHalfClasses) {
            $sumAdditionalSurcharges += $zchbdo * $this->replaceClassroomManagementSeniorGradeHalfClasses * 0.3;
            $data['additional_surcharges']['sum_replace_classroom_management_senior_grade_half_classes']
                = $zchbdo * $this->replaceClassroomManagementSeniorGradeHalfClasses * 0.3;
        }
        // int ---Замена классного руководства с 5 по 10 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        if ($this->replaceClassroomManagementSeniorGradeFullClasses) {
            $sumAdditionalSurcharges += $zchbdo * $this->replaceClassroomManagementSeniorGradeFullClasses * 0.5;
            $data['additional_surcharges']['sum_replace_classroom_management_senior_grade_full_classes']
                = $zchbdo * $this->replaceClassroomManagementSeniorGradeFullClasses * 0.5;
        }
        $data['withheld'] = [];

        // checkbox --- Заявление об удержании профсоюзных взносов (1%)
        //Иә болса жалақы суммасынан ИТОГ*1% алынады.
        if ($this->appWithholdingUnionDues == 'true') {
            $data['withheld']['sum_app_withholding_union_dues'] = $this->appWithholdingUnionDues * 0.01;
        }
        // checkbox ---Заявление об удержании партийных взносов (297,5 тенге)
        //ПВ (статичный) жалақы суммасынан алынады
        if ($this->appWithholdingPartyContributions == 'true') {
            $data['withheld']['sum_app_withholding_party_contributions'] = $pv;
        }

        // checkbox ---Работающий пенсионер
        //Итог*10% жалақы суммасынан алынады
        $data['withheld']['sum_mandatory_pension_contribution'] =  $this->workingPensioner == 'true' ? 0 : ($sumAdditionalSurcharges * 0.1);

        // checkbox ---Освобожден от уплаты индивидуального подоходного налога
        //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
        if ($this->exemptFromPayingIndividualOncomeTax == 'false') {
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
