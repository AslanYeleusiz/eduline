<?php

use App\Models\Material;
use App\Models\News;
use App\Models\Role;
use App\Models\SalaryCalculatorHistory;
use App\Models\TestClass;
use App\Models\TestSubject;
use App\Models\TestSubjectOption;
use App\Services\V1\SalaryCalculationCalculateService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Services\V1\SalaryCalculationService;
use Faker\Generator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
//use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    $salaryHistory = SalaryCalculatorHistory::latest()->firstOrFail();
    $calculateService = new SalaryCalculationCalculateService();
    //За период (год) int -- select --- 2019-2026 арасы
    $calculateService->year = $salaryHistory->year;

    //За период (месяц) int -- select ---- 12 months
    $calculateService->month = $salaryHistory->month;
    // Образование string -- select Высшее (B2), Среднее специальное (B4)

    $calculateService->education = $salaryHistory->education;
    //Стаж (лет)  int --
    $calculateService->experienceYear = $salaryHistory->experience_year;
    //Стаж (месяцев) int -- select
    $calculateService->experienceMonth = $salaryHistory->experience_month;
    //Стаж (дней) int -- select
    $calculateService->experienceDay = $salaryHistory->experience_day;
    //Работа в сельской местности bool -- checkbox
    $calculateService->workInVillage = $salaryHistory->work_in_village;
    //Доплата за особые условия труда (10%) bool -- checkbox
    $calculateService->specialWorkingConditions = $salaryHistory->special_working_conditions;
    // 0, ДО*50%, ДО*30%, ДО*20% қосымша қосылады
    // select --  Нет, Зона экологической катастрофы, Зона экологического кризиса, Зона экологического предкризисного состояния
    //Доплата за работу в зоне экологического бедствия int
    $calculateService->workInEnvDisasterZone = $salaryHistory->work_in_env_disaster_zone;

    // select -- Нет, Зона черезвычайного радиационнного риска, Зона максимального радиационнного риска,
    //Зона повышенного радиационнного риска, Зона минимального радиационнного риска, Зона с льготным социально-экономическим статусом
    //Доплата за работу на территориях радиационного риска
    // 0, МРП*2, МРП*1,75, МРП*1,5, МРП*1,25, МРП*1 қосымша қосылады
    $calculateService->workInRadiationRiskZone = $salaryHistory->work_in_radiation_risk_zone;

    // int -- select -- Нет, Частичное погружение, Полное погружение
    // 0, БДО*1. БДО*2 қосымша қосылады
    //Доплата за преподавание на английском языке
    $calculateService->teachingInEnglish = $salaryHistory->teaching_in_english;
    // bool --- checkbox
    //  МРП*10 қосымша қосылады
    // Доплата за степень магистра по НПН

    $calculateService->magisterDegree = $salaryHistory->magister_degree;
    // bool --- checkbox
    // БДО*1 қосымша қосылады
    // Доплата за наставничество
    $calculateService->mentoring = $salaryHistory->mentoring;
    // int
    // select -- Нет, педагог-модератор, педагог-эксперт,  педагог-исследователь, педагог-мастер
    //0, ДО*50%, ДО*40%, ДО*35%, ДО*30% қосымша қосылады
    // Пед. Мастерство
    $calculateService->pedSkill = $salaryHistory->ped_skill;

    // checkbox -- Классное руководство
    //Полный класс: 1-4 сынып үшін БДО*50%,
    //5-12 сынып үшін БДО*60%
    // --------------------
    //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
    // 5-12 сынып үшін БДО*30%    қосымша қосылады
    $calculateService->classGuide = $salaryHistory->class_guide;
    // checkbox -- Классное руководство: Начальный класс?
    //Полный класс: 1-4 сынып үшін БДО*50%,
    // 5-12 сынып үшін БДО*60%
    // --------------------
    //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
    // 5-12 сынып үшін БДО*30%    қосымша қосылады
    $calculateService->classGuideElementaryGrade = $salaryHistory->class_guide_elementary_grade;
    //int -- Наполняемость класса
    //Санын енгізеді. Класное руководство Иә болғанда ғана жазуға болады. Кері жағдайда неактивный болады.
    $calculateService->classOccupancy = $salaryHistory->class_occupancy;
    // select -- За заведование кабинетом
    //Нет, Половина дня, Полный день
    //0, БДО*10%, БДО*20%  или за мастерской всегда БДО*20% қосымша қосылады

    $calculateService->forManagingOffice = $salaryHistory->for_managing_office;
    // checkbox -- bool -- За заведование мастерской
    //  за мастерской всегда БДО*20% қосымша қосылады
    $calculateService->forRunningWorkshop = $salaryHistory->for_running_workshop;
    // int
    // select -- За проверку тетрадей
    // Нет, Учитель начальных классов, Учитель ЕМН, Учитель языка и литературы
    // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%
    $calculateService->forCheckingNotebook = $salaryHistory->for_checking_notebook;
    // Сағат санын жазады int ---  За проверку тетрадей в полных классах
    //(Тетрадь*Сағат саны) қосымша қосылады
    $calculateService->forCheckingNotebooksFullClasses = $salaryHistory->for_checking_notebooks_full_classes;
    // Сағат санын жазады int --- За проверку тетрадей в классах с числом менее 15 учащихся
    //(Тетрадь*Сағат саны/2) қосымша қосылады
    $calculateService->forCheckingNotebooksHalfClasses = $salaryHistory->for_checking_notebooks_half_classes;

    // Сағат санын жазады int --- Доплата за работу с детьми с особыми образовательными потребностями
    $calculateService->workingWithChildrenWithSpecialEducationalNeeds = $salaryHistory->working_with_children_with_special_educational_needs;

    // Сағат санын жазады iint --- Учебная нагрузка по тарификации - Нагрузка
    //ДО анықтауға керек негізге параметр. ДО = БДО/16*сағат санына
    $calculateService->trainingLoadBillingLoad = $salaryHistory->training_load_billing_load;
    // Сағат санын жазады  int --- Обучение на дому
    // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
    $calculateService->homeschooling = $salaryHistory->homeschooling;
    // Сағат санын жазады int --- Часы работы с лицейcкими и гимназическими классами
    // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
    $calculateService->hoursWithLyceumClasses = $salaryHistory->hours_with_lyceum_classes;
    // Сағат санын жазады  int --- Часы углубленного изучения
    // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
    $calculateService->hoursInDepthStudy = $salaryHistory->hours_in_depth_study;
    // Сағат санын жазады (еш әсер бермейді) int --- Часы обновленного содержания
    // ДО*30%  --- қосымша қосылады
    $calculateService->hoursUpdatedContent = $salaryHistory->hours_updated_content;
    // Сағат санын жазады int --- Часы по предметам профильного назначения
    // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
    $calculateService->hoursSpecializedSubjects = $salaryHistory->hours_specialized_subjects;
    // Сағат санын жазады  int --- Часы замены в классах с числом менее 15 учащихся
    // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
    //44
    //38,1 classes_with_fewer_than_15_students
    $calculateService->replaceHoursHalfClasses = $salaryHistory->replace_hours_half_classes;
    // int --- Часы замены в полных классах
    // Сағат санын жазады
    // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
    // 76,2 коэфицент
    //45
    $calculateService->replaceHourFullClasses = $salaryHistory->replace_hour_full_classes;
    // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
    // Сағат санын жазады
    // 38.1 коэфицент
    //46
    $calculateService->replaceHoursNewProgramHalfClasses = $salaryHistory->replace_hours_new_program_half_classes;
    // int --- Часы замены из них часы замены по новой программе в полных классах
    // Сағат санын жазады
    // 38.1 коэфицент
    $calculateService->replaceHoursNewProgramFullClasses = $salaryHistory->replace_hours_new_program_full_classes;
    // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
    // Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
    // Сағат санын жазады
    $calculateService->replaceHoursLyceumClassesHalfClasses = $salaryHistory->replace_hours_lyceum_classes_half_classes;
    // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
    //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
    // Сағат санын жазады
    $calculateService->replaceHoursLyceumClassesFullClasses = $salaryHistory->replace_hours_lyceum_classes_full_classes;
    // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
    // Күн санын жазады
    //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
    $calculateService->replaceClassroomManagementElementaryGradeHalfClasses = $salaryHistory->replace_classroom_management_elementary_grade_half_classes;
    // int ---Замена классного руководства с 1 по 4 класс в полных классах
    // Күн санын жазады
    //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
    $calculateService->replaceClassroomManagementElementaryGradeFullClasses = $salaryHistory->replace_classroom_management_elementary_grade_full_classes;

    // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
    // Күн санын жазады
    //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
    $calculateService->replaceClassroomManagementSeniorGradeHalfClasses  = $salaryHistory->replace_classroom_management_senior_grade_half_classes;
    // int ---Замена классного руководства с 5 по 10 класс в полных классах
    // Күн санын жазады
    //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
    $calculateService->replaceClassroomManagementSeniorGradeFullClasses  = $salaryHistory->replace_classroom_management_senior_grade_full_classes;
    // checkbox --- Заявление об удержании профсоюзных взносов (1%)
    //Иә болса жалақы суммасынан ИТОГ*1% алынады.
    $calculateService->appWithholdingUnionDues  = $salaryHistory->app_withholding_union_dues;
    // checkbox ---Заявление об удержании партийных взносов (297,5 тенге)
    //ПВ (статичный) жалақы суммасынан алынады
    $calculateService->appWithholdingPartyContributions = $salaryHistory->app_withholding_party_contributions;
    // checkbox ---Работающий пенсионер
    //Итог*10% жалақы суммасынан алынады
    $calculateService->workingPensioner = $salaryHistory->working_pensioner;
    // checkbox ---Освобожден от уплаты индивидуального подоходного налога
    //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
    $calculateService->exemptFromPayingIndividualOncomeTax = $salaryHistory->exempt_from_paying_individual_income_tax;


    $calculateService->category = $salaryHistory->category;
    $data = $calculateService->calculateSalary();
//    return view('pdf.salary', compact('data'));
    $name = 'invoice_' .$salaryHistory->id .'_' . $salaryHistory->created_at . '.pdf';
    Pdf::setOptions(['dpi' => 150, 'defaultFont' => 'dejavu sans bold']);
    $pdf = PDF::loadView('pdf/salary', compact('data', 'name'));

    return $pdf->download($name);
    dd();

    dd(array_column(\App\Models\SalaryCalculator::EDUICATIONS, 'value'));
    // $pdf = PDF::loadView('pdf/salary', compact('user'));
//    return view('pdf.salary');
//    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
//    Pdf::setOptions(['dpi' => 150, 'defaultFont' => '\DejaVuSans.ttf', 'fontDir' => public_path('fonts'), 'fontCache' => public_path('fonts')]);
    $salaryHistory = SalaryCalculatorHistory::firstOrFail();

    $calculateService = new SalaryCalculationCalculateService();
    //За период (год) int -- select --- 2019-2026 арасы
    $calculateService->year = $salaryHistory->year;

    //За период (месяц) int -- select ---- 12 months
    $calculateService->month = $salaryHistory->month;
    // Образование string -- select Высшее (B2), Среднее специальное (B4)

    $calculateService->education = $salaryHistory->education;
    //Стаж (лет)  int --
    $calculateService->experienceYear = $salaryHistory->experience_year;
    //Стаж (месяцев) int -- select
    $calculateService->experienceMonth = $salaryHistory->experience_month;
    //Стаж (дней) int -- select
    $calculateService->experienceDay = $salaryHistory->experience_day;
    //Работа в сельской местности bool -- checkbox
    $calculateService->workInVillage = $salaryHistory->work_in_village;
    //Доплата за особые условия труда (10%) bool -- checkbox
    $calculateService->specialWorkingConditions = $salaryHistory->special_working_conditions;
    // 0, ДО*50%, ДО*30%, ДО*20% қосымша қосылады
    // select --  Нет, Зона экологической катастрофы, Зона экологического кризиса, Зона экологического предкризисного состояния
    //Доплата за работу в зоне экологического бедствия int
    $calculateService->workInEnvDisasterZone = $salaryHistory->work_in_env_disaster_zone;

    // select -- Нет, Зона черезвычайного радиационнного риска, Зона максимального радиационнного риска,
    //Зона повышенного радиационнного риска, Зона минимального радиационнного риска, Зона с льготным социально-экономическим статусом
    //Доплата за работу на территориях радиационного риска
    // 0, МРП*2, МРП*1,75, МРП*1,5, МРП*1,25, МРП*1 қосымша қосылады
    $calculateService->workInRadiationRiskZone = $salaryHistory->work_in_radiation_risk_zone;

    // int -- select -- Нет, Частичное погружение, Полное погружение
    // 0, БДО*1. БДО*2 қосымша қосылады
    //Доплата за преподавание на английском языке
    $calculateService->teachingInEnglish = $salaryHistory->teaching_in_english;
    // bool --- checkbox
    //  МРП*10 қосымша қосылады
    // Доплата за степень магистра по НПН

    $calculateService->magisterDegree = $salaryHistory->magister_degree;
    // bool --- checkbox
    // БДО*1 қосымша қосылады
    // Доплата за наставничество
    $calculateService->mentoring = $salaryHistory->mentoring;
    // int
    // select -- Нет, педагог-модератор, педагог-эксперт,  педагог-исследователь, педагог-мастер
    //0, ДО*50%, ДО*40%, ДО*35%, ДО*30% қосымша қосылады
    // Пед. Мастерство
    $calculateService->pedSkill = $salaryHistory->ped_skill;

    // checkbox -- Классное руководство
    //Полный класс: 1-4 сынып үшін БДО*50%,
    //5-12 сынып үшін БДО*60%
    // --------------------
    //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
    // 5-12 сынып үшін БДО*30%    қосымша қосылады
    $calculateService->classGuide = $salaryHistory->class_guide;
    // checkbox -- Классное руководство: Начальный класс?
    //Полный класс: 1-4 сынып үшін БДО*50%,
    // 5-12 сынып үшін БДО*60%
    // --------------------
    //15 адамға дейінгі класс класс: 1-4 сынып үшін БДО*25%,
    // 5-12 сынып үшін БДО*30%    қосымша қосылады
    $calculateService->classGuideElementaryGrade = $salaryHistory->class_guide_elementary_grade;
    //int -- Наполняемость класса
    //Санын енгізеді. Класное руководство Иә болғанда ғана жазуға болады. Кері жағдайда неактивный болады.
    $calculateService->classOccupancy = $salaryHistory->class_occupancy;
    // select -- За заведование кабинетом
    //Нет, Половина дня, Полный день
    //0, БДО*10%, БДО*20%  или за мастерской всегда БДО*20% қосымша қосылады

    $calculateService->forManagingOffice = $salaryHistory->for_managing_office;
    // checkbox -- bool -- За заведование мастерской
    //  за мастерской всегда БДО*20% қосымша қосылады
    $calculateService->forRunningWorkshop = $salaryHistory->for_running_workshop;
    // int
    // select -- За проверку тетрадей
    // Нет, Учитель начальных классов, Учитель ЕМН, Учитель языка и литературы
    // Тетрадь = 0, ЗЧБДО*50%, ЗЧБДО*50%, ЗЧБДО*50%
    $calculateService->forCheckingNotebook = $salaryHistory->for_checking_notebook;
    // Сағат санын жазады int ---  За проверку тетрадей в полных классах
    //(Тетрадь*Сағат саны) қосымша қосылады
    $calculateService->forCheckingNotebooksFullClasses = $salaryHistory->for_checking_notebooks_full_classes;
    // Сағат санын жазады int --- За проверку тетрадей в классах с числом менее 15 учащихся
    //(Тетрадь*Сағат саны/2) қосымша қосылады
    $calculateService->forCheckingNotebooksHalfClasses = $salaryHistory->for_checking_notebooks_half_classes;
    // Сағат санын жазады iint --- Учебная нагрузка по тарификации - Нагрузка
    //ДО анықтауға керек негізге параметр. ДО = БДО/16*сағат санына
    $calculateService->trainingLoadBillingLoad = $salaryHistory->training_load_billing_load;
    // Сағат санын жазады  int --- Обучение на дому
    // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
    $calculateService->homeschooling = $salaryHistory->homeschooling;
    // Сағат санын жазады int --- Часы работы с лицейcкими и гимназическими классами
    // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
    $calculateService->hoursWithLyceumClasses = $salaryHistory->hours_with_lyceum_classes;
    // Сағат санын жазады  int --- Часы углубленного изучения
    // ЗЧБДО*Сағат саны *20%  --- қосымша қосылады
    $calculateService->hoursInDepthStudy = $salaryHistory->hours_in_depth_study;
    // Сағат санын жазады (еш әсер бермейді) int --- Часы обновленного содержания
    // ДО*30%  --- қосымша қосылады
    $calculateService->hoursUpdatedContent = $salaryHistory->hours_updated_content;
    // Сағат санын жазады int --- Часы по предметам профильного назначения
    // ЗЧБДО*Сағат саны *40%  --- қосымша қосылады
    $calculateService->hoursSpecializedSubjects = $salaryHistory->hours_specialized_subjects;
    // Сағат санын жазады  int --- Часы замены в классах с числом менее 15 учащихся
    // ДО(без селский)*Сағат саны/38,1  --- қосымша қосылады
    //44
    //38,1 classes_with_fewer_than_15_students
    $calculateService->replaceHoursHalfClasses = $salaryHistory->replace_hours_half_classes;
    // int --- Часы замены в полных классах
    // Сағат санын жазады
    // ДО(без селский)*Сағат саны/76,2  --- қосымша қосылады
    // 76,2 коэфицент
    //45
    $calculateService->replaceHourFullClasses = $salaryHistory->replace_hour_full_classes;
    // int --- Часы замены из них часы замены по новой программе в классах с числом менее 15 учащихся
    // Сағат санын жазады
    // 38.1 коэфицент
    //46
    $calculateService->replaceHoursNewProgramHalfClasses = $salaryHistory->replace_hours_new_program_half_classes;
    // int --- Часы замены из них часы замены по новой программе в полных классах
    // Сағат санын жазады
    // 38.1 коэфицент
    $calculateService->replaceHoursNewProgramFullClasses = $salaryHistory->replace_hours_new_program_full_classes;
    // int --- Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
    // Часы замены из них часы замены в лицейских/гимназических классах в классах с числом менее 15 учащихся
    // Сағат санын жазады
    $calculateService->replaceHoursLyceumClassesHalfClasses = $salaryHistory->replace_hours_lyceum_classes_half_classes;
    // int --- Часы замены из них часы замены в лицейских/гимназических классах в полных классах
    //ЗЧБДО*Сағат саны *10%  --- қосымша қосылады
    // Сағат санын жазады
    $calculateService->replaceHoursLyceumClassesFullClasses = $salaryHistory->replace_hours_lyceum_classes_full_classes;
    // int --- Замена классного руководства с 1 по 4 класс в классах с числом менее 15 учащихся
    // Күн санын жазады
    //ЗЧБДО*Күн саны *25%  --- қосымша қосылады
    $calculateService->replaceClassroomManagementElementaryGradeHalfClasses = $salaryHistory->replace_classroom_management_elementary_grade_half_classes;
    // int ---Замена классного руководства с 1 по 4 класс в полных классах
    // Күн санын жазады
    //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
    $calculateService->replaceClassroomManagementElementaryGradeFullClasses = $salaryHistory->replace_classroom_management_elementary_grade_full_classes;

    // int --- Замена классного руководства с 5 по 10 класс в классах с числом менее 15 учащихся
    // Күн санын жазады
    //ЗЧБДО*Күн саны *30%  --- қосымша қосылады
    $calculateService->replaceClassroomManagementSeniorGradeHalfClasses  = $salaryHistory->replace_classroom_management_senior_grade_half_classes;
    // int ---Замена классного руководства с 5 по 10 класс в полных классах
    // Күн санын жазады
    //ЗЧБДО*Күн саны *50%  --- қосымша қосылады
    $calculateService->replaceClassroomManagementSeniorGradeFullClasses  = $salaryHistory->replace_classroom_management_senior_grade_full_classes;
    // checkbox --- Заявление об удержании профсоюзных взносов (1%)
    //Иә болса жалақы суммасынан ИТОГ*1% алынады.
    $calculateService->appWithholdingUnionDues  = $salaryHistory->app_withholding_union_dues;
    // checkbox ---Заявление об удержании партийных взносов (297,5 тенге)
    //ПВ (статичный) жалақы суммасынан алынады
    $calculateService->appWithholdingPartyContributions = $salaryHistory->app_withholding_party_contributions;
    // checkbox ---Работающий пенсионер
    //Итог*10% жалақы суммасынан алынады
    $calculateService->workingPensioner = $salaryHistory->working_pensioner;
    // checkbox ---Освобожден от уплаты индивидуального подоходного налога
    //ИПН алынбайды егер галочка қойылса. Қойылмаса ИПН жалақы суммасынан алынады
    $calculateService->exemptFromPayingIndividualOncomeTax = $salaryHistory->exempt_from_paying_individual_income_tax;


    $calculateService->category = $salaryHistory->category;
    $data = $calculateService->calculateSalary();
    return view('pdf.salary', compact('data'));
//    dd(    $salaryHistory = SalaryCalculatorHistory::firstOrFail());
    Pdf::setOptions(['dpi' => 150, 'defaultFont' => 'dejavu sans bold']);
//    \Carbon\Carbon::setLocale('ru'); // <---
//    setlocale(LC_ALL, 'ru_RU.utf8');

//    dd(\Carbon\Carbon::create( '2020-10-10')->translatedFormat('F Y'));
//    dd(\Carbon\Carbon::create( $data['base']['year'] .'-' .  $data['base']['month'] .'-'. '1')->translatedFormat('F'));
//    dd($data);
    $pdf = PDF::loadView('pdf/salary', compact('data'));
    $name = 'invoice_' .$salaryHistory->id .'_' . $salaryHistory->created_at;
    return view('pdf.salary', compact('data'));
    return $pdf->download("$name.pdf");
    return $pdf->download('invoice.pdf');
    return view('pdf.salary');
    $test = SalaryCalculationService::getCoefficent('b4', 1,2, 2022, 6);
    var_dump($test);
    return view('welcome');
    dd($test);
    $subject = TestSubject::with('preparations.childs')->findOrFail(1);
    dd($subject);
    $testClassItems = TestClass::withCount(['preparations' => function($query) {
            return $query->where('test_subject_preparations.subject_id', 1)->whereNotNull('test_subject_preparations.parent_id');
        }])->whereHas('preparations', function($query) {
            return $query->where('test_subject_preparations.subject_id', 1)->whereNotNull('test_subject_preparations.parent_id');
        })->get();
    dd($testClassItems);
    $testClassItems = TestClass::whereHas('preparations', function($query){
        return $query->where('subject_id', 1);
    })->with(['preparations' => function($query) {
        return $query->where('subject_id',1)->whereNotNull('parent_id');
    }])->get();
    dd($testClassItems);
             $subject = TestSubject::with(['classItems' => function($query) {
             return $query;
         }])->findOrFail(1);
         dd($subject);
    $option = TestSubjectOption::with('questions')->get();
    dd($option);
    $user = User::with('subscription')->first();
    dd($user->subscription, $user,'user');
    // dd('ok');
    //     Artisan::call('key:generate');
    //     dd('ok');

    // return view('welcome');
    // $material = Material::first();
    // $year = (int) ($material->created_at?->format('Y') ?? now()->format('Y'));
    // $month = (int) ($material->created_at?->format('m') ?? now()->format('m'));

    // dd($material, $year, Str::length($year), (int) $month);
    // $image = Generator::image(Storage::disk('public')->path('images/news'), 300, 300);
    // dd($image);
    // // 'image' => $this->faker->image(Storage::disk('public')->path('images/news'), 300, 300)
    // $users = User::limit(20)->get();

    // dd($users);
})->name('dev.index');
Route::prefix('commands')->group(function() {
    Route::get('passport-install', function() {
        Artisan::call('passport:install');
        dd('install');
    });
    Route::get('optimize-clear', function() {
        Artisan::call('optimize');
        dd('clear');
    });


    Route::get('storage-link', function() {
        Artisan::call('storage:link');
        dd('link');
    });
Route::get('seed', function() {
        Artisan::call('db:seed');
        dd('clear');
    });


    Route::get('migrate', function() {
        Artisan::call('migrate');
        dd('migrate');
    });
});
