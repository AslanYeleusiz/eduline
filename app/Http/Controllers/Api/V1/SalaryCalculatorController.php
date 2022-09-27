<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SalaryCalculatorHistoryResource;
use App\Models\SalaryCalculator;
use App\Models\SalaryCalculatorHistory;
use App\Services\V1\SalaryCalculationCalculateService;
use App\Services\V1\SalaryCalculationService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SalaryCalculatorController extends Controller
{
    public function __construct(public SalaryCalculationCalculateService $calculateService)
    {
    }

    public function index(Request $request)
    {
        $salaryCalculators = SalaryCalculatorHistory::select('id', 'created_at')->thisUser()->latest()->get();
        return SalaryCalculatorHistoryResource::collection($salaryCalculators);
    }

    public function store(Request $request)
    {
        //За период (год) int -- select --- 2019-2026 арасы
        $this->calculateService->year = $request->input('year', now()->format('Y'));

        //За период (месяц) int -- select ---- 12 months
        $this->calculateService->month = $request->input('month', now()->format('m'));
        // Образование string -- select Высшее (B2), Среднее специальное (B4)

        $this->calculateService->education = $request->input('education', 'B2');
        //Стаж (лет)  int --
        $this->calculateService->experienceYear = $request->input('experience_year', 0);
        //Стаж (месяцев) int -- select
        $this->calculateService->experienceMonth = $request->input('experience_month', 0);
        //Стаж (дней) int -- select
        $this->calculateService->experienceDay = $request->input('experience_day', 0);
        //Работа в сельской местности bool -- checkbox
        $this->calculateService->workInVillage = $request->input('work_in_village', false);
        //Доплата за особые условия труда (10%) bool -- checkbox
        $this->calculateService->specialWorkingConditions = $request->input('special_working_conditions', false);
        // 0, ДО*50%, ДО*30%, ДО*20% қосымша қосылады
        // select --  Нет, Зона экологической катастрофы, Зона экологического кризиса, Зона экологического предкризисного состояния
        //Доплата за работу в зоне экологического бедствия int
        $this->calculateService->workInEnvDisasterZone = $request->input('work_in_env_disaster_zone', 1);

        // select -- Нет, Зона черезвычайного радиационнного риска, Зона максимального радиационнного риска,
        //Зона повышенного радиационнного риска, Зона минимального радиационнного риска, Зона с льготным социально-экономическим статусом
        //Доплата за работу на территориях радиационного риска
        // 0, МРП*2, МРП*1,75, МРП*1,5, МРП*1,25, МРП*1 қосымша қосылады
        $this->calculateService->workInRadiationRiskZone = $request->input('work_in_radiation_risk_zone', 1);

        // int -- select -- Нет, Частичное погружение, Полное погружение
        // 0, БДО*1. БДО*2 қосымша қосылады
        //Доплата за преподавание на английском языке
        $this->calculateService->teachingInEnglish = $request->input('teaching_in_english', 1);
        // bool --- checkbox
        //  МРП*10 қосымша қосылады
        // Доплата за степень магистра по НПН

        $this->calculateService->magisterDegree = $request->input('magister_degree', false);
        // bool --- checkbox
        // БДО*1 қосымша қосылады
        // Доплата за наставничество
        $this->calculateService->mentoring = $request->input('mentoring', false);
        // int
        // select -- Нет, педагог-модератор, педагог-эксперт,  педагог-исследователь, педагог-мастер
        //0, ДО*50%, ДО*40%, ДО*35%, ДО*30% қосымша қосылады
        // Пед. Мастерство
        $this->calculateService->pedSkill = $request->input('ped_skill', 1);

        // checkbox -- Классное руководство
        //Полный класс: 1-4 сынып үшін БДО*50%,
        //5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады
        $this->calculateService->classGuide = $request->input('class_guide', false);
        // checkbox -- Классное руководство: Начальный класс?
        //Полный класс: 1-4 сынып үшін БДО*50%,
        // 5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады
        $this->calculateService->classGuideElementaryGrade = $request->input('class_guide_elementary_grade', false);
        //int -- Наполняемость класса
        //Санын енгізеді. Класное руководство Иә болғанда ғана жазуға болады. Кері жағдайда неактивный болады.
        $this->calculateService->classOccupancy = $request->input('class_occupancy', 0);
        // select -- За заведование кабинетом
        //Нет, Половина дня, Полный день
        //0, БДО*10%, БДО*20%  или за мастерской всегда БДО*20% қосымша қосылады

        $this->calculateService->forManagingOffice = $request->input('for_managing_office', 1);
        // checkbox -- bool -- За заведование мастерской
        //  за мастерской всегда БДО*20% қосымша қосылады
        $this->calculateService->forRunningWorkshop = $request->input('for_running_workshop', false);
        // int
        // select -- За проверку тетрадей
        // Нет, Учитель начальных классов, Учитель ЕМН, Учитель языка и литературы
        // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%
        $this->calculateService->forCheckingNotebook = $request->input('for_checking_notebook', 1);
        // Сағат санын жазады int ---  За проверку тетрадей в полных классах
        //(Тетрадь*Сағат саны) қосымша қосылады
        $this->calculateService->forCheckingNotebooksFullClasses = $request->input('for_checking_notebooks_full_classes', 0);
        // Сағат санын жазады int --- За проверку тетрадей в классах с числом менее 15 учащихся
        //(Тетрадь*Сағат саны/2) қосымша қосылады
        $this->calculateService->forCheckingNotebooksHalfClasses = $request->input('for_checking_notebooks_half_classes', 0);
       // Сағат санын жазады int --- Доплата за работу с детьми с особыми образовательными потребностями
        $this->calculateService->workingWithChildrenWithSpecialEducationalNeeds = $request->input('working_with_children_with_special_educational_needs', 0);
        // Сағат санын жазады iint --- Учебная нагрузка по тарификации - Нагрузка
        //ДО анықтауға керек негізге параметр. ДО = БДО/16*сағат санына
        $this->calculateService->trainingLoadBillingLoad = $request->input('training_load_billing_load', 0);
        // Сағат санын жазады  int --- Обучение на дому
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        $this->calculateService->homeschooling = $request->input('homeschooling', 0);
        // Сағат санын жазады int --- Часы работы с лицейcкими и гимназическими классами
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        $this->calculateService->hoursWithLyceumClasses = $request->input('hours_with_lyceum_classes', 0);
        // Сағат санын жазады  int --- Часы углубленного изучения
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        $this->calculateService->hoursInDepthStudy = $request->input('hours_in_depth_study', 0);
        // Сағат санын жазады (еш әсер бермейді) int --- Часы обновленного содержания
        // ДО*30%  --- қосымша қосылады
        $this->calculateService->hoursUpdatedContent = $request->input('hours_updated_content', 0);
        // Сағат санын жазады int --- Часы по предметам профильного назначения
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        $this->calculateService->hoursSpecializedSubjects = $request->input('hours_specialized_subjects', 0);
        // Сағат санын жазады  int --- Часы замены в классах с числом менее 15 учащихся
        // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
        //44
         //38,1 classes_with_fewer_than_15_students
        $this->calculateService->replaceHoursHalfClasses = $request->input('replace_hours_half_classes',0);
        // int --- Часы замены в полных классах
        // Сағат санын жазады
        // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
        // 76,2 коэфицент
        //45
        $this->calculateService->replaceHourFullClasses =  $request->input('replace_hour_full_classes',0);
        // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
        // Сағат санын жазады
        // 38.1 коэфицент
        //46
        $this->calculateService->replaceHoursNewProgramHalfClasses = $request->input('replace_hours_new_program_half_classes',0);
        // int --- Часы замены из них часы замены по новой программе в полных классах
        // Сағат санын жазады
        // 38.1 коэфицент
        $this->calculateService->replaceHoursNewProgramFullClasses = $request->input('replace_hours_new_program_full_classes', 0);
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Сағат санын жазады
        $this->calculateService->replaceHoursLyceumClassesHalfClasses = $request->input('replace_hours_lyceum_classes_half_classes', 0);
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
        //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
        // Сағат санын жазады
        $this->calculateService->replaceHoursLyceumClassesFullClasses = $request->input('replace_hours_lyceum_classes_full_classes', 0);
        // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
        $this->calculateService->replaceClassroomManagementElementaryGradeHalfClasses = $request->input('replace_classroom_management_elementary_grade_half_classes', 0);
        // int ---Замена классного руководства с 1 по 4 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $this->calculateService->replaceClassroomManagementElementaryGradeFullClasses = $request->input('replace_classroom_management_elementary_grade_full_classes', 0);

        // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
        $this->calculateService->replaceClassroomManagementSeniorGradeHalfClasses  = $request->input('replace_classroom_management_senior_grade_half_classes', 0);
        // int ---Замена классного руководства с 5 по 10 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $this->calculateService->replaceClassroomManagementSeniorGradeFullClasses  = $request->input('replace_classroom_management_senior_grade_full_classes', 0);
        // checkbox --- Заявление об удержании профсоюзных взносов (1%)
        //Иә болса жалақы суммасынан ИТОГ*1% алынады.
        $this->calculateService->appWithholdingUnionDues  = $request->input('app_withholding_union_dues', false);
        // checkbox ---Заявление об удержании партийных взносов (297,5 тенге)
        //ПВ (статичный) жалақы суммасынан алынады
        $this->calculateService->appWithholdingPartyContributions = $request->input('app_withholding_party_contributions', false);
        // checkbox ---Работающий пенсионер
        //Итог*10% жалақы суммасынан алынады
        $this->calculateService->workingPensioner = $request->input('working_pensioner', false);
        // checkbox ---Освобожден от уплаты индивидуального подоходного налога
        //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
        $this->calculateService->exemptFromPayingIndividualOncomeTax = $request->input('exempt_from_paying_individual_income_tax', false);


        $this->calculateService->category = $request->input('category',  last(SalaryCalculator::CATEGORIES)['number']);
        $data = $this->calculateService->calculateSalary();

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
        $salaryCalculator->working_with_children_with_special_educational_needs = $request->input('working_with_children_with_special_educational_needs', 0);
        $salaryCalculator->training_load_billing_load  =$request->input('training_load_billing_load', 0);
        $salaryCalculator->homeschooling  = $request->input('homeschooling', 0);
        $salaryCalculator->hours_with_lyceum_classes  = $request->input('hours_with_lyceum_classes', 0);
        $salaryCalculator->hours_in_depth_study  = $request->input('hours_in_depth_study', 0);
        $salaryCalculator->hours_updated_content  = $request->input('hours_updated_content', 0);
        $salaryCalculator->hours_specialized_subjects  =$request->input('hours_specialized_subjects',0);
        $salaryCalculator->replace_hours_half_classes  = $request->input('replace_hours_half_classes',0);
        $salaryCalculator->replace_hour_full_classes  = $request->input('replace_hour_full_classes',0);
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
        $salaryCalculator->category  = $request->input('category', last(SalaryCalculator::CATEGORIES)['number']);
        $salaryCalculator->user_id  = auth()->guard('api')->user()->id;
        $salaryCalculator->save();
    }

    public function downloadPDF($id)
    {
        // $pdf = PDF::loadView('pdf/salary', compact('user'));

        $salaryHistory = SalaryCalculatorHistory::findOrFail($id);

        //За период (год) int -- select --- 2019-2026 арасы
        $this->calculateService->year = $salaryHistory->year;

        //За период (месяц) int -- select ---- 12 months
        $this->calculateService->month = $salaryHistory->month;
        // Образование string -- select Высшее (B2), Среднее специальное (B4)

        $this->calculateService->education = $salaryHistory->education;
        //Стаж (лет)  int --
        $this->calculateService->experienceYear = $salaryHistory->experience_year;
        //Стаж (месяцев) int -- select
        $this->calculateService->experienceMonth = $salaryHistory->experience_month;
        //Стаж (дней) int -- select
        $this->calculateService->experienceDay = $salaryHistory->experience_day;
        //Работа в сельской местности bool -- checkbox
        $this->calculateService->workInVillage = $salaryHistory->work_in_village;
        //Доплата за особые условия труда (10%) bool -- checkbox
        $this->calculateService->specialWorkingConditions = $salaryHistory->special_working_conditions;
        // 0, ДО*50%, ДО*30%, ДО*20% қосымша қосылады
        // select --  Нет, Зона экологической катастрофы, Зона экологического кризиса, Зона экологического предкризисного состояния
        //Доплата за работу в зоне экологического бедствия int
        $this->calculateService->workInEnvDisasterZone = $salaryHistory->work_in_env_disaster_zone;

        // select -- Нет, Зона черезвычайного радиационнного риска, Зона максимального радиационнного риска,
        //Зона повышенного радиационнного риска, Зона минимального радиационнного риска, Зона с льготным социально-экономическим статусом
        //Доплата за работу на территориях радиационного риска
        // 0, МРП*2, МРП*1,75, МРП*1,5, МРП*1,25, МРП*1 қосымша қосылады
        $this->calculateService->workInRadiationRiskZone = $salaryHistory->work_in_radiation_risk_zone;

        // int -- select -- Нет, Частичное погружение, Полное погружение
        // 0, БДО*1. БДО*2 қосымша қосылады
        //Доплата за преподавание на английском языке
        $this->calculateService->teachingInEnglish = $salaryHistory->teaching_in_english;
        // bool --- checkbox
        //  МРП*10 қосымша қосылады
        // Доплата за степень магистра по НПН

        $this->calculateService->magisterDegree = $salaryHistory->magister_degree;
        // bool --- checkbox
        // БДО*1 қосымша қосылады
        // Доплата за наставничество
        $this->calculateService->mentoring = $salaryHistory->mentoring;
        // int
        // select -- Нет, педагог-модератор, педагог-эксперт,  педагог-исследователь, педагог-мастер
        //0, ДО*50%, ДО*40%, ДО*35%, ДО*30% қосымша қосылады
        // Пед. Мастерство
        $this->calculateService->pedSkill = $salaryHistory->ped_skill;

        // checkbox -- Классное руководство
        //Полный класс: 1-4 сынып үшін БДО*50%,
        //5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады
        $this->calculateService->classGuide = $salaryHistory->class_guide;
        // checkbox -- Классное руководство: Начальный класс?
        //Полный класс: 1-4 сынып үшін БДО*50%,
        // 5-12 сынып үшін БДО*60%
        // --------------------
        //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
        // 5-12 сынып үшін БДО*30%    қосымша қосылады
        $this->calculateService->classGuideElementaryGrade = $salaryHistory->class_guide_elementary_grade;
        //int -- Наполняемость класса
        //Санын енгізеді. Класное руководство Иә болғанда ғана жазуға болады. Кері жағдайда неактивный болады.
        $this->calculateService->classOccupancy = $salaryHistory->class_occupancy;
        // select -- За заведование кабинетом
        //Нет, Половина дня, Полный день
        //0, БДО*10%, БДО*20%  или за мастерской всегда БДО*20% қосымша қосылады

        $this->calculateService->forManagingOffice = $salaryHistory->for_managing_office;
        // checkbox -- bool -- За заведование мастерской
        //  за мастерской всегда БДО*20% қосымша қосылады
        $this->calculateService->forRunningWorkshop = $salaryHistory->for_running_workshop;
        // int
        // select -- За проверку тетрадей
        // Нет, Учитель начальных классов, Учитель ЕМН, Учитель языка и литературы
        // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%
        $this->calculateService->forCheckingNotebook = $salaryHistory->for_checking_notebook;
        // Сағат санын жазады int ---  За проверку тетрадей в полных классах
        //(Тетрадь*Сағат саны) қосымша қосылады
        $this->calculateService->forCheckingNotebooksFullClasses = $salaryHistory->for_checking_notebooks_full_classes;
        // Сағат санын жазады int --- За проверку тетрадей в классах с числом менее 15 учащихся
        //(Тетрадь*Сағат саны/2) қосымша қосылады
        $this->calculateService->forCheckingNotebooksHalfClasses = $salaryHistory->for_checking_notebooks_half_classes;

        // Сағат санын жазады int --- Доплата за работу с детьми с особыми образовательными потребностями
        $this->calculateService->workingWithChildrenWithSpecialEducationalNeeds = $salaryHistory->working_with_children_with_special_educational_needs;

        // Сағат санын жазады iint --- Учебная нагрузка по тарификации - Нагрузка
        //ДО анықтауға керек негізге параметр. ДО = БДО/16*сағат санына
        $this->calculateService->trainingLoadBillingLoad = $salaryHistory->training_load_billing_load;
        // Сағат санын жазады  int --- Обучение на дому
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        $this->calculateService->homeschooling = $salaryHistory->homeschooling;
        // Сағат санын жазады int --- Часы работы с лицейcкими и гимназическими классами
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        $this->calculateService->hoursWithLyceumClasses = $salaryHistory->hours_with_lyceum_classes;
        // Сағат санын жазады  int --- Часы углубленного изучения
        // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
        $this->calculateService->hoursInDepthStudy = $salaryHistory->hours_in_depth_study;
        // Сағат санын жазады (еш әсер бермейді) int --- Часы обновленного содержания
        // ДО*30%  --- қосымша қосылады
        $this->calculateService->hoursUpdatedContent = $salaryHistory->hours_updated_content;
        // Сағат санын жазады int --- Часы по предметам профильного назначения
        // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
        $this->calculateService->hoursSpecializedSubjects = $salaryHistory->hours_specialized_subjects;
        // Сағат санын жазады  int --- Часы замены в классах с числом менее 15 учащихся
        // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
        //44
        //38,1 classes_with_fewer_than_15_students
        $this->calculateService->replaceHoursHalfClasses = $salaryHistory->replace_hours_half_classes;
        // int --- Часы замены в полных классах
        // Сағат санын жазады
        // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
        // 76,2 коэфицент
        //45
        $this->calculateService->replaceHourFullClasses = $salaryHistory->replace_hour_full_classes;
        // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
        // Сағат санын жазады
        // 38.1 коэфицент
        //46
        $this->calculateService->replaceHoursNewProgramHalfClasses = $salaryHistory->replace_hours_new_program_half_classes;
        // int --- Часы замены из них часы замены по новой программе в полных классах
        // Сағат санын жазады
        // 38.1 коэфицент
        $this->calculateService->replaceHoursNewProgramFullClasses = $salaryHistory->replace_hours_new_program_full_classes;
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
        // Сағат санын жазады
        $this->calculateService->replaceHoursLyceumClassesHalfClasses = $salaryHistory->replace_hours_lyceum_classes_half_classes;
        // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
        //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
        // Сағат санын жазады
        $this->calculateService->replaceHoursLyceumClassesFullClasses = $salaryHistory->replace_hours_lyceum_classes_full_classes;
        // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
        $this->calculateService->replaceClassroomManagementElementaryGradeHalfClasses = $salaryHistory->replace_classroom_management_elementary_grade_half_classes;
        // int ---Замена классного руководства с 1 по 4 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $this->calculateService->replaceClassroomManagementElementaryGradeFullClasses = $salaryHistory->replace_classroom_management_elementary_grade_full_classes;

        // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
        // Күн санын жазады
        //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
        $this->calculateService->replaceClassroomManagementSeniorGradeHalfClasses  = $salaryHistory->replace_classroom_management_senior_grade_half_classes;
        // int ---Замена классного руководства с 5 по 10 класс в полных классах
        // Күн санын жазады
        //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
        $this->calculateService->replaceClassroomManagementSeniorGradeFullClasses  = $salaryHistory->replace_classroom_management_senior_grade_full_classes;
        // checkbox --- Заявление об удержании профсоюзных взносов (1%)
        //Иә болса жалақы суммасынан ИТОГ*1% алынады.
        $this->calculateService->appWithholdingUnionDues  = $salaryHistory->app_withholding_union_dues;
        // checkbox ---Заявление об удержании партийных взносов (297,5 тенге)
        //ПВ (статичный) жалақы суммасынан алынады
        $this->calculateService->appWithholdingPartyContributions = $salaryHistory->app_withholding_party_contributions;
        // checkbox ---Работающий пенсионер
        //Итог*10% жалақы суммасынан алынады
        $this->calculateService->workingPensioner = $salaryHistory->working_pensioner;
        // checkbox ---Освобожден от уплаты индивидуального подоходного налога
        //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
        $this->calculateService->exemptFromPayingIndividualOncomeTax = $salaryHistory->exempt_from_paying_individual_income_tax;


        $this->calculateService->category = $salaryHistory->category;
        $data = $this->calculateService->calculateSalary();


        Pdf::setOptions(['dpi' => 150, 'defaultFont' => 'dejavu sans bold']);
        $name = 'invoice_' .$salaryHistory->id .'_' . $salaryHistory->created_at . ".pdf";
        $pdf = PDF::loadView('pdf/salary', compact('data','name'));

        return $pdf->download($name);
    }
}
