<?php


namespace App\Services\V1;

use App\Models\SalaryCalculator;
use App\Models\SalaryCalculatorCoefficient;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SalaryCalculationCalculateService
{
    public $year, $month, $education,
        $experienceYear, $experienceMonth, $experienceDay, $workInVillage,
        $specialWorkingConditions, $workInEnvDisasterZone,
        $workInRadiationRiskZone, $teachingInEnglish,
        $magisterDegree, $mentoring, $pedSkill,
        $classGuide, $classGuideElementaryGrade,
        $classOccupancy, $forManagingOffice, $forRunningWorkshop,
        $forCheckingNotebook, $forCheckingNotebooksFullClasses,
        $forCheckingNotebooksHalfClasses,
        $workingWithChildrenWithSpecialEducationalNeeds,
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

        $salaryCalculatorData = SalaryCalculationService::getCalculatorData($this->year, $this->month);
        if (empty($salaryCalculatorData)) {
            return 0;
        }
        $experience = round($this->experienceYear + $this->experienceMonth / 12 + $this->experienceDay / 365, 2);

        $coefficient = SalaryCalculationService::getCoefficent($this->education, $this->category, $experience, $this->year, $this->month);
        $mrp = $salaryCalculatorData->mrp;
        $bdo = $salaryCalculatorData->bdo;
        $pv = $salaryCalculatorData->pv;
        $snv = $salaryCalculatorData->snv;
        $dpop = $salaryCalculatorData->dpop;
        $zchbdo = $bdo / 16;
        $do1 = $bdo * $coefficient;

        // Увеличение ДО согласно поправочного коэффициента 75 %
        $do2 = $do1 * 0.75;
        $do = ($do1 + $do2) / 16 * $this->trainingLoadBillingLoad;
        $do = $this->workInVillage == 'true' ? $do * 1.25 : $do;
        $data = [
            'base' => [
                'year' => $this->year,
                'month' => $this->month,
                'category' => $this->category,
                'education' => $this->education,
                'training_load_billing_load' => $this->trainingLoadBillingLoad,
                'experience_year' => $this->experienceYear,
                'experience_month' => $this->experienceMonth,
                'experience_day' => $this->experienceDay,
                'bdo' => $bdo,
                'coefficient' => $coefficient,
                'do1' => $do1,
                'do2' => $do2,
                // начислено по тарифу
                'do' => $do,
                'ped_skill' => $this->pedSkill,
                'work_in_env_disaster_zone' => $this->workInEnvDisasterZone,
                'work_in_radiation_risk_zone' => $this->workInRadiationRiskZone,
                'teaching_in_english' => $this->teachingInEnglish,
                'class_guide' => $this->classGuide == 'true',
                'class_occupancy' => $this->classOccupancy . ($this->classGuideElementaryGrade == 'true' ? ' нач. класс' : ''),
            ],
            // дополнительные доплаты
            'additional_surcharges' => []
        ];
        //ауылдық болса егер xxx
        // $sumWorkInVillage = $workInVillage == 'true' ? $do * 0.25 : 0;
        if ($this->workInVillage == 'true') {
            $data['base']['sum_work_in_village'] = $do * 0.25;
        }

        // Доплата за особые условия труда (10%)
        if ($this->specialWorkingConditions == 'true') {
            // $do = $do * 1.1;
            $data['additional_surcharges']['sum_special_working_conditions'] = $do * 0.1;
        }

        // Пед. Мастерство
        if (Arr::first(SalaryCalculator::PED_SKILLS)['number'] != $this->pedSkill) {
            foreach (SalaryCalculator::PED_SKILLS as $pedSkillItem) {
                if ($this->pedSkill == $pedSkillItem['number']) {
                    $data['additional_surcharges']['sum_ped_skill'] = $do * floatval('0.' . $pedSkillItem['percent']);
                }
            }
        }


        //Доплата за работу в зоне экологического бедствия
        if ($this->workInEnvDisasterZone != Arr::first(SalaryCalculator::WORK_IN_ENVIRONMENTAL_DISASTER_ZONES)['number']) {
            foreach (SalaryCalculator::WORK_IN_ENVIRONMENTAL_DISASTER_ZONES as $workInEnvironmentalDisasterZoneItem) {
                if ($workInEnvironmentalDisasterZoneItem['number'] == $this->workInEnvDisasterZone) {
                    $data['additional_surcharges']['sum_work_in_env_disaster_zone']
                        = $do * floatval('0.' . $workInEnvironmentalDisasterZoneItem['percent']);
                }
            }
        }

        //Доплата за работу на территориях радиационного риска
        if ($this->workInEnvDisasterZone != Arr::first(SalaryCalculator::WORK_IN_RADIATION_RISK_ZONES)['number']) {
            foreach (SalaryCalculator::WORK_IN_RADIATION_RISK_ZONES as $workInRadiationRiskZoneItem) {
                if ($workInRadiationRiskZoneItem['number'] == $this->workInRadiationRiskZone) {
                    $data['additional_surcharges']['sum_work_in_radiation_risk_zone'] = $mrp * $workInRadiationRiskZoneItem['mrp'];
                }
            }
        }

        //Доплата за преподавание на английском языке
        if ($this->workInEnvDisasterZone != Arr::first(SalaryCalculator::TECHING_IN_ENGLISH_ITEMS)['number']) {
            foreach (SalaryCalculator::TECHING_IN_ENGLISH_ITEMS as $teachingInEnglishItem) {
                if ($this->teachingInEnglish == $teachingInEnglishItem['number']) {
                    $data['additional_surcharges']['sum_teaching_in_english'] = $bdo * $teachingInEnglishItem['bdo'];
                }
            }
        }

        // Доплата за степень магистра по НПН
        if ($this->magisterDegree == 'true') {
            $data['additional_surcharges']['sum_magister_degree'] = $mrp * 10;
        }
        // Доплата за наставничество
        if ($this->mentoring == 'true') {
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
                if (intval($this->classOccupancy) > 0 && intval($this->classOccupancy) < 15) {
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.25;
                } else if (intval($this->classOccupancy) >= 15) {
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.5;
                }
            } else {
                if (intval($this->classOccupancy) > 0 && intval($this->classOccupancy) < 15) {
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.3;
                } else if (intval($this->classOccupancy) >= 15) {
                    $data['additional_surcharges']['sum_class_guide'] = $bdo * 0.6;
                }
            }
        }
        //За заведование кабинетом
        if ($this->forManagingOffice != Arr::first(SalaryCalculator::FOR_MANAGING_OFFICE_ITEMS)['number']) {
            foreach (SalaryCalculator::FOR_MANAGING_OFFICE_ITEMS as $forManagingOfficeItem) {
                if ($this->forManagingOffice == $forManagingOfficeItem['number']) {
                    $data['additional_surcharges']['sum_for_managing_office'] = $bdo * floatval('0.' . $forManagingOfficeItem['bdo_percent']);
                    $data['base']['for_managing_office'] = $forManagingOfficeItem['name'];
                }
            }
        }

        // За заведование мастерской
        if ($this->forRunningWorkshop == 'true') {
            $data['additional_surcharges']['sum_for_running_workshop'] = $bdo * 0.20;
            if (isset($data['additional_surcharges']['sum_for_managing_office'])) {
                $data['additional_surcharges']['sum_for_managing_office'] += $data['additional_surcharges']['sum_for_running_workshop'];
                $data['base']['for_managing_office'] .= '  мастерская';
            }
        }

        // select -- За проверку тетрадей
        // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%

        if ($this->forCheckingNotebook != Arr::first(SalaryCalculator::FOR_CHECKING_NOTEBOOKS)['number']) {
            foreach (SalaryCalculator::FOR_CHECKING_NOTEBOOKS as $forCheckingNotebookItem) {
                if ($forCheckingNotebookItem['number'] == $this->forCheckingNotebook) {

                    if ($this->forCheckingNotebooksHalfClasses > 0) {
                        $data['additional_surcharges']['sum_for_checking_notebooks_half_classes'] = $zchbdo * (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent'])) * ($this->forCheckingNotebooksHalfClasses / 2);
                        $data['base']['for_checking_notebooks_half_classes'] = $forCheckingNotebookItem['name'] . ' ' . $this->forCheckingNotebooksHalfClasses;
                    }
                    if ($this->forCheckingNotebooksFullClasses > 0) {
                        $data['additional_surcharges']['sum_for_checking_notebooks_full_classes'] = $zchbdo * (floatval('0.' . $forCheckingNotebookItem['zchbdo_percent'])) * $this->forCheckingNotebooksFullClasses;
                        $data['base']['for_checking_notebooks_full_classes'] = $forCheckingNotebookItem['name'] . ' ' . $this->forCheckingNotebooksFullClasses;
                    }
                }
            }
        }
        //working_with_children_with_special_educational_needs
        //Учебная нагрузка по тарификации - Нагрузка
        // $trainingLoadBillingLoad =

        // int --- Доплата за работу с детьми с особыми образовательными потребностями
        if ($this->workingWithChildrenWithSpecialEducationalNeeds) {

            $data['additional_surcharges']['sum_working_with_children_with_special_educational_needs']
                = $zchbdo * $this->workingWithChildrenWithSpecialEducationalNeeds * 0.4;
            $data['base']['working_with_children_with_special_educational_needs'] = $this->workingWithChildrenWithSpecialEducationalNeeds;
        }
        // int --- Обучение на дому
        if ($this->homeschooling) {
            $data['additional_surcharges']['sum_shomeschooling'] = $zchbdo * $this->homeschooling * 0.4;
            $data['base']['homeschooling'] = $this->homeschooling;
        }

        // int --- Часы работы с лицейcкими и гимназическими классами
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        if ($this->hoursWithLyceumClasses) {
            $data['additional_surcharges']['sum_hours_with_lyceum_gymnasium_classes'] = $zchbdo * $this->hoursWithLyceumClasses * 0.2;
            $data['base']['hours_with_lyceum_gymnasium_classes'] = $this->hoursWithLyceumClasses;
        }
        // int --- Часы углубленного изучения
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        if ($this->hoursInDepthStudy) {
            $data['additional_surcharges']['sum_hours_in_depth_study'] = $zchbdo * $this->hoursInDepthStudy * 0.2;
            $data['base']['hours_in_depth_study'] = $this->hoursInDepthStudy;
        }
        // int --- Часы обновленного содержания
        // Сағат санын жазады (еш әсер бермейді)
        // ДО*30%  --- қосымша қосылады
        if ($this->hoursUpdatedContent) {
            $data['additional_surcharges']['sum_hours_updated_content'] = $do * 0.3;
            $data['base']['hours_updated_content'] = $this->hoursUpdatedContent;
        }

        // int --- Часы по предметам профильного назначения
        // Сағат санын жазады
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        if ($this->hoursSpecializedSubjects) {
            $data['additional_surcharges']['sum_hours_specialized_subjects'] = $zchbdo * $this->hoursSpecializedSubjects * 0.4;
            $data['base']['hours_specialized_subjects'] = $this->hoursSpecializedSubjects;
        }

        // int --- Часы замены в классах с числом менее 15 учащихся
        // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
        // 38,1 коэфицент
        if ($this->replaceHoursHalfClasses) {
            $data['additional_surcharges']['sum_replace_hours_half_classes']
                = ($do1 + $do2) / 38.1 * $this->replaceHoursHalfClasses;
            $data['base']['replace_hours_half_classes'] = $this->replaceHoursHalfClasses;
        }
        // int --- Часы замены в полных классах
        // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
        // 76,2 коэфицент

        if ($this->replaceHourFullClasses) {
            $data['additional_surcharges']['sum_replace_hour_full_classes']
                = ($do1 + $do2) / 76.2 * $this->replaceHourFullClasses;
            $data['base']['replace_hour_full_classes'] = $this->replaceHourFullClasses;
        }
        // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
        // Сағат санын жазады
        if ($this->replaceHoursNewProgramHalfClasses) {
            $data['additional_surcharges']['sum_replace_hours_new_program_half_classes']
                = ($do1 + $do2) / 38.1 * $this->replaceHoursNewProgramHalfClasses;
            $data['base']['replace_hours_new_program_half_classes'] = $this->replaceHoursNewProgramHalfClasses;
        }
        // int --- Часы замены из них часы замены по новой программе в полных классах
        // Сағат санын жазады
        if ($this->replaceHoursNewProgramFullClasses) {
            $data['additional_surcharges']['sum_replace_hours_new_program_full_classes']
                = ($do1 + $do2) / 76.2 * $this->replaceHoursNewProgramFullClasses;
            $data['base']['replace_hours_new_program_full_classes'] = $this->replaceHoursNewProgramFullClasses;
        }

        // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Сағат санын жазады
        if ($this->replaceHoursLyceumClassesHalfClasses) {
            $data['additional_surcharges']['sum_replace_hours_lyceum_classes_half_classes']
                = $zchbdo * $this->replaceHoursLyceumClassesHalfClasses * 0.05;
            $data['base']['replace_hours_lyceum_classes_half_classes'] = $this->replaceHoursLyceumClassesHalfClasses;
        }
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
        //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
        if ($this->replaceHoursLyceumClassesFullClasses) {
            $data['additional_surcharges']['sum_replace_hours_lyceum_classes_full_classes']
                = $zchbdo * $this->replaceHoursLyceumClassesFullClasses * 0.1;
            $data['base']['replace_hours_lyceum_classes_full_classes'] = $this->replaceHoursLyceumClassesFullClasses;
        }
        // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
        if ($this->replaceClassroomManagementElementaryGradeHalfClasses) {
            $data['additional_surcharges']['sum_replace_classroom_management_elementary_grade_half_classes']
                = $zchbdo * $this->replaceClassroomManagementElementaryGradeHalfClasses * 0.25;
            $data['base']['replace_classroom_management_elementary_grade_half_classes'] = $this->replaceClassroomManagementElementaryGradeHalfClasses;
        }

        // int ---Замена классного руководства с 1 по 4 класс в полных классах
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        if ($this->replaceClassroomManagementElementaryGradeFullClasses) {
            $data['additional_surcharges']['sum_replace_classroom_management_elementary_grade_full_classes']
                = $zchbdo * $this->replaceClassroomManagementElementaryGradeFullClasses * 0.5;
            $data['base']['replace_classroom_management_elementary_grade_full_classes'] = $this->replaceClassroomManagementElementaryGradeFullClasses;
        }
        // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
        //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
        if ($this->replaceClassroomManagementSeniorGradeHalfClasses) {
            $data['additional_surcharges']['sum_replace_classroom_management_senior_grade_half_classes']
                = $zchbdo * $this->replaceClassroomManagementSeniorGradeHalfClasses * 0.3;
            $data['base']['replace_classroom_management_senior_grade_half_classes'] = $this->replaceClassroomManagementSeniorGradeHalfClasses;
        }
        // int ---Замена классного руководства с 5 по 10 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        if ($this->replaceClassroomManagementSeniorGradeFullClasses) {
            $data['additional_surcharges']['sum_replace_classroom_management_senior_grade_full_classes']
                = $zchbdo * $this->replaceClassroomManagementSeniorGradeFullClasses * 0.5;
            $data['base']['replace_classroom_management_senior_grade_full_classes'] = $this->replaceClassroomManagementSeniorGradeFullClasses;
        }
        //Удержано
        $data['withheld'] = [];

        $sumAdditionalSurcharges = array_sum($data['additional_surcharges']);
        //Взнос ОСМС
        $data['withheld']['sum_osms_contribution'] = $sumAdditionalSurcharges * 0.02;

        // checkbox ---Работающий пенсионер
        //Итог*10% жалақы суммасынан алынады
        $data['withheld']['sum_mandatory_pension_contribution'] = $this->workingPensioner == 'true' ? 0 : ($sumAdditionalSurcharges * 0.1);


        // checkbox ---Освобожден от уплаты индивидуального подоходного налога
        //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады

        // Индивидуальный подоходный налог
        $data['withheld']['sum_exempt_from_paying_individual_income_tax'] = $this->exemptFromPayingIndividualOncomeTax == 'true'
            ? 0 : (($sumAdditionalSurcharges * 0.88 - $snv) * 0.1);

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


        // $data['superpower']
        //work_in_radiation_risk_zone
        $data['do'] = round($do, 2);
        // Сумма дополнительные доплаты
        $data['sum_additional_surcharges'] = round($sumAdditionalSurcharges, 2);

        // ИТОГО НАЧИСЛЕНО:
        $data['total_accured'] = round($do + $sumAdditionalSurcharges);
//        ИТОГО УДЕРЖАНО:
        $data['total_withheld'] = round(array_sum($data['withheld']), 2);
//        СУММА НА РУКИ:
        $data['amount_hand'] = round($data['total_accured'] - $data['total_withheld'], 2);

        $this->floatRound($data['additional_surcharges']);
        $this->floatRound($data['withheld']);
        $this->floatRound($data['base']);
        return $data;
    }

    private function floatRound(&$data, $precision = 2)
    {
        foreach ($data as &$datum) {
            if (is_float($datum)) {
                $datum = round($datum, $precision);
            }
        }
    }
}
