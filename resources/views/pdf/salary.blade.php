<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@lang('site.Калькулятор для расчета заработной платы')</title>
{{--    <link href="{{ asset('css/pdf-salary.css') }}" rel="stylesheet"/>--}}

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
</style>
<style>
    body, body *, tr, td, table, p, h1 {
        font-family: 'Roboto', sans-serif !important;
    }

    h1 {
        font-family: 'Roboto', sans-serif !important;
    }
</style>
<style>
    * {
        margin: 0;
        padding: 0;
        text-indent: 0;
    }
    .s1 {
        color: black;
        font-family: Roboto, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 16pt;
    }

    p {
        color: black;
        font-family: Roboto, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 11pt;
        margin: 0pt;
    }
    .s2 {
        color: black;
        font-family: Roboto, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 11pt;
    }
    .s3 {
        color: black;
        font-family: "Times New Roman", serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 11pt;
    }
    table,
    tbody {
        vertical-align: top;
        overflow: visible;
    }
    .table-tr-2-column-key {
        width: 410pt;
        border-top-style: solid;
        border-top-width: 2pt;
        border-left-style: solid;
        border-left-width: 2pt;
        border-bottom-style: solid;
        border-bottom-width: 2pt;
        border-right-style: solid;
        border-right-width: 2pt;
    }
    .table-td-2-column-val {
        width: 100pt;
        border-top-style: solid;
        border-top-width: 2pt;
        border-left-style: solid;
        border-left-width: 2pt;
        border-bottom-style: solid;
        border-bottom-width: 2pt;
        border-right-style: solid;
        border-right-width: 2pt;
    }
    .s2-table-col-key {
        padding-top: 2pt;
        padding-left: 3pt;
        text-indent: 0pt;
        text-align: left;
    }
    .s2-table-col-center {
        width: 131pt;
        border-top-style: solid;
        border-top-width: 2pt;
        border-left-style: solid;
        border-left-width: 2pt;
        border-bottom-style: solid;
        border-bottom-width: 2pt;
        border-right-style: solid;
        border-right-width: 2pt;
    }
    .s2-table-col-center-text {
        padding-top: 8pt;
        padding-left: 2pt;
        text-indent: 0pt;
        text-align: left;
    }
    .s2-table-col-center-text-2 {

    }
    .s2-table-col-val {
        padding-top: 2pt;
        padding-right: 1pt;
        text-indent: 0pt;
        text-align: right;
    }
    .s2-table-col-val-text {
        padding-top: 8pt;
        padding-right: 1pt;
        text-indent: 0pt;
        text-align: right;
    }
    .s2-td-key {
        width: 276pt;
        border-top-style: solid;
        border-top-width: 2pt;
        border-left-style: solid;
        border-left-width: 2pt;
        border-bottom-style: solid;
        border-bottom-width: 2pt;
        border-right-style: solid;
        border-right-width: 2pt;
    }
    .s2-td-key-text-2 {
        padding-top: 8pt;
        padding-left: 3pt;
        text-indent: 0pt;
        text-align: left;
    }
    .s2-td-key-text {
        padding-top: 2pt;
        padding-left: 3pt;
        padding-right: 12pt;
        text-indent: 0pt;
        text-align: left;
    }

    tr, td {
        padding: 5px !important;
    }
    .table-td-2-column-text-2 {

    }
    body, body*, tr, td, table, p { font-family: Roboto !important; }

</style>

@php
    app()->setLocale($locale)
@endphp

<body class="page-break" style="padding:20px;">
<p
    class="s1"
    style="
        padding-top: 1pt;
        padding-left: 90pt;
        text-indent: 0pt;
        text-align: center;
      "
>
    @lang('site.Калькулятор для расчета заработной платы')
</p>
<p style="text-indent: 0pt; text-align: left"><br/></p>
<p style="
        padding-top: 5pt;
        font-size:18px;
        /*padding-left: 10pt;*/
        text-indent: 0pt;
        text-align: left;"
>
    @lang('site.Данные')
</p>
<p style="text-indent: 0pt; text-align: left"><br/></p>
<p style="
        padding-left: 24pt;
        text-indent: 0pt;
        line-height: 112%;
        text-align: left;
      "
>

    @lang('site.За период:ru') {{ Str::ucfirst(\Carbon\Carbon::create( $data['base']['year'] .'-' .  $data['base']['month'] .'-'. '1')->translatedFormat('F Y'))}} @lang('site.За период:kz')
    <br>
    {{--    Должность: Учитель--}}
    {{--    <br>--}}
    @lang('site.Образование'): {{ Arr::last(\App\Models\SalaryCalculator::EDUICATIONS, function ($value, $key) use ($data) {
    return $value['value'] ==  $data['base']['education'];
})['name'] ?? null }}
    <br>
    @lang('site.Категория'): {{ Arr::last(\App\Models\SalaryCalculator::CATEGORIES, function ($category, $key) use ($data) {
    return $category['number'] ==  $data['base']['category'];
})['name'] ?? null }}
    <br>
    @lang('site.Стаж'): {{ $data['base']['experience_year']  }} @lang('site.лет') {{ $data['base']['experience_month'] }}
    @lang('site.месяцев') {{ $data['base']['experience_day'] }} @lang('site.дней')
</p>
<p style="text-align: left;font-size:18px;padding-top: 15pt;">
    @lang('site.Результат')
</p>
<p style="text-indent: 0pt; text-align: left"><br/></p>
<table
    style="border-collapse: collapse; width: 100%"
    cellspacing="0"
>
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key">
                @lang('site.Базовый должностной оклад')
            </p>
        </td>
        <td
            class="table-td-2-column-val"
        >
            <p
                class="s2 s2-table-col-val">
                {{ $data['base']['bdo'] }}
            </p>
        </td>
    </tr>
    <tr style="height: 18pt">
        <td

            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key">
                @lang('site.Коэффициент')
            </p>
        </td>
        <td
            class="table-td-2-column-val"
        >
            <p
                class="s2 s2-table-col-val"
            >
                {{ $data['base']['coefficient'] }}
            </p>
        </td>
    </tr>
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key">
                @lang('site.Должностной оклад (ДО)')
            </p>
        </td>
        <td
            class="table-td-2-column-val"
        >
            <p
                class="s2 s2-table-col-val "
            >
                {{ $data['base']['do'] }}
            </p>
        </td>
    </tr>
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key">
                @lang('site.Увеличение ДО согласно поправочного коэффициента 75 %')
            </p>
        </td>
        <td
            class="table-td-2-column-val"
        >
            <p
                class="s2 s2-table-col-val"
            >
                {{ $data['base']['do2'] }}
            </p>
        </td>
    </tr>
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key">
                @lang('site.Должностной оклад для расчета')
            </p>
        </td>
        <td class="table-td-2-column-val"

        >
            <p
                class="s2 s2-table-col-val"
            >
                {{ $data['base']['do1'] }}
            </p>
        </td>
    </tr>
</table>
<p style="text-indent: 0pt; text-align: left"><br/></p>
<p
    style="
        padding-bottom: 1pt;
        text-indent: 0pt;
        text-align: left;
        font-size:18px;
      "
>
    @lang('site.Начислено'):
</p>
<table
    style="border-collapse: collapse; ; width: 100%"
    cellspacing="0"
>
    <tr style="height: 18pt">
        <td class="s2-td-key"
        >
            <p
                class="s2 s2-table-col-key">
                @lang('site.Начислено по тарифу')

            </p>
        </td>
        <td class="s2-table-col-center">
            <p class="s2 s2-table-col-center-text-2">
                {{ $data['base']['training_load_billing_load'] }} @lang('site.часов')
            </p>
        </td>
        <td class="table-td-2-column-val"
        >
            <p
                class="s2 s2-table-col-val"
            >
                {{ $data['base']['do'] }}
            </p>
        </td>
    </tr>
    @if(isset($data['additional_surcharges']['sum_special_working_conditions']))
        <tr style="height: 18pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за особые условия труда (10%)')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    @lang('site.Да')
                </p>
            </td>
            <td class="table-td-2-column-val"
            >
                <p
                    class="s2 s2-table-col-val"
                >
                    {{ $data['additional_surcharges']['sum_special_working_conditions'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset( $data['additional_surcharges']['sum_ped_skill']))
        <tr style="height: 18pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Пед. мастерство')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    {{ Arr::last(\App\Models\SalaryCalculator::PED_SKILLS, function ($value, $key) use ($data) {
       return $value['number'] ==  $data['base']['ped_skill'];
    })['name'] }}
                </p>
            </td>
            <td class="table-td-2-column-val"
            >
                <p
                    class="s2 s2-table-col-val "
                >
                    {{ $data['additional_surcharges']['sum_ped_skill'] }}
                </p>
            </td>
        </tr>
    @endif

    @if(isset($data['additional_surcharges']['sum_work_in_env_disaster_zone']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-td-key-text-2"
                >
                    @lang('site.Доплата за работу в зоне экологического бедствия')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    {{ Arr::last(\App\Models\SalaryCalculator::WORK_IN_ENVIRONMENTAL_DISASTER_ZONES, function ($value, $key) use ($data) {
      return $value['number'] ==  $data['base']['work_in_env_disaster_zone'];
    })['name'] }}
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_work_in_env_disaster_zone'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_work_in_radiation_risk_zone']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за работу на территориях радиационного риска')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    {{ Arr::last(\App\Models\SalaryCalculator::WORK_IN_RADIATION_RISK_ZONES, function ($value, $key) use ($data) {
         return $value['number'] ==  $data['base']['work_in_radiation_risk_zone'];
       })['name'] }}
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_work_in_radiation_risk_zone'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_teaching_in_english']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-td-key-text-2"
                >
                    @lang('site.Доплата за преподавание на английском языке')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    {{ Arr::last(\App\Models\SalaryCalculator::TECHING_IN_ENGLISH_ITEMS, function ($value, $key) use ($data) {
             return $value['number'] ==  $data['base']['teaching_in_english'];
           })['name'] }}
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_teaching_in_english'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_magister_degree']))
        <tr style="height: 18pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за степень магистра по НПН')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    @lang('site.Да')
                </p>
            </td>
            <td class="table-td-2-column-val"

            >
                <p
                    class="s2 s2-table-col-val"
                >
                    {{ $data['additional_surcharges']['sum_magister_degree'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_mentoring']))
        <tr style="height: 18pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за наставничество')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    @lang('site.Да')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val">
                    {{  $data['additional_surcharges']['sum_mentoring'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_class_guide']) )
        <tr style="height: 18pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Классное руководство')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    {{  $data['base']['class_occupancy'] }}
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p
                    class="s2 s2-table-col-val"
                >
                    {{ $data['additional_surcharges']['sum_class_guide']  }}
                </p>
            </td>
        </tr>
    @endif



    @if(isset($data['additional_surcharges']['sum_for_managing_office']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-td-key-text-2"
                >
                    @lang('site.За заведование кабинетом')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p
                    class="s2"
                    style="
              padding-top: 2pt;
              padding-left: 2pt;
              padding-right: 56pt;
              text-indent: 0pt;
              text-align: left;
            "
                >
                    {{ $data['base']['for_managing_office'] }}
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_for_managing_office'] }}
                </p>
            </td>
        </tr>
    @endif

    @if(isset($data['additional_surcharges']['sum_for_checking_notebooks_half_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за проверку тетрадей в классах с числом менее 15 учащихся')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    Учитель начальных классов {{ $data['base']['for_checking_notebooks_half_classes'] }} часов
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_for_checking_notebooks_half_classes']}}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_for_checking_notebooks_full_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-td-key-text-2 "
                >
                    @lang('site.Доплата за проверку тетрадей в полных классах')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    Учитель начальных классов {{ $data['base']['for_checking_notebooks_full_classes'] }} часов
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_for_checking_notebooks_full_classes']}}
                </p>
            </td>
        </tr>
    @endif
    @if(isset( $data['additional_surcharges']['sum_shomeschooling']))
        <tr style="height: 18pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Обучение на дому')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    {{ $data['base']['homeschooling'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p
                    class="s2 s2-table-col-val "
                >
                    {{ $data['additional_surcharges']['sum_shomeschooling']}}
                </p>
            </td>
        </tr>
    @endif
    @if(isset( $data['additional_surcharges']['sum_hours_with_lyceum_gymnasium_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Часы работы с лицейcкими и гимназическими классами')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">

                    {{ $data['base']['hours_with_lyceum_gymnasium_classes'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_hours_with_lyceum_gymnasium_classes'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_hours_in_depth_study']))
        <tr style="height: 18pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Часы углубленного изучения')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    {{ $data['base']['hours_in_depth_study'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p
                    class="s2 s2-table-col-val"
                >
                    {{ $data['additional_surcharges']['sum_hours_in_depth_study'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_hours_in_depth_study']))
        <tr style="height: 18pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Часы обновленного содержания')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    {{ $data['base']['hours_updated_content'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p
                    class="s2 s2-table-col-val"
                >
                    {{ $data['additional_surcharges']['sum_hours_updated_content'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_hours_specialized_subjects']))
        <tr style="height: 31pt">
            <td
                style="
            width: 276pt;
            border-top-style: solid;
            border-top-width: 2pt;
            border-left-style: solid;
            border-left-width: 2pt;
            border-bottom-style: solid;
            border-bottom-width: 1pt;
            border-right-style: solid;
            border-right-width: 2pt;
          "
            >
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за часы по предметам профильного назначения')
                </p>
            </td>
            <td
                style="
            width: 131pt;
            border-top-style: solid;
            border-top-width: 2pt;
            border-left-style: solid;
            border-left-width: 2pt;
            border-bottom-style: solid;
            border-bottom-width: 1pt;
            border-right-style: solid;
            border-right-width: 2pt;
          "
            >
                <p class="s2 s2-table-col-center-text">
                    {{ $data['base']['hours_specialized_subjects'] }} @lang('site.часов')
                </p>
            </td>
            <td
                style="
            width: 102pt;
            border-top-style: solid;
            border-top-width: 2pt;
            border-left-style: solid;
            border-left-width: 2pt;
            border-bottom-style: solid;
            border-bottom-width: 1pt;
            border-right-style: solid;
            border-right-width: 2pt;
          "
            >
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_hours_specialized_subjects'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_replace_hours_half_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за часы замены в классах с числом менее 15 учащихся')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">

                    {{ $data['base']['replace_hours_half_classes'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_replace_hours_half_classes'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_replace_hour_full_classes']))
        <tr style="height: 18pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за часы замены в полных классах')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text-2">
                    {{ $data['base']['replace_hour_full_classes'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p
                    class="s2 s2-table-col-val"
                >
                    {{ $data['additional_surcharges']['sum_replace_hour_full_classes'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_replace_hours_new_program_half_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за часы замены по обновленной программе в классах с числом менее 15 учащихся')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">

                    {{ $data['base']['replace_hours_new_program_half_classes'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_replace_hours_new_program_half_classes'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_replace_hours_new_program_half_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p class="s2 s2-td-key-text">
                    @lang('site.Доплата за часы замены по обновленной программе в полных классах')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">

                    {{ $data['base']['replace_hours_new_program_half_classes'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_replace_hours_new_program_half_classes'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_working_with_children_with_special_educational_needs']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p class="s2 s2-td-key-text">
                    @lang('site.Доплата за работу с детьми с особыми образовательными потребностями')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">

                    {{ $data['base']['working_with_children_with_special_educational_needs'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_working_with_children_with_special_educational_needs'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_replace_hours_lyceum_classes_half_classes']))
        <tr style="height: 45pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за часы замены в лицейских/гимназических классах с числом менее 15 учащихся')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p style="text-indent: 0pt; text-align: left"><br/></p>
                <p
                    class="s2"
                    style="padding-left: 2pt; text-indent: 0pt; text-align: left"
                >
                    {{ $data['base']['replace_hours_lyceum_classes_half_classes'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p style="text-indent: 0pt; text-align: left"><br/></p>
                <p
                    class="s2"
                    style="padding-right: 1pt; text-indent: 0pt; text-align: right"
                >
                    {{ $data['additional_surcharges']['sum_replace_hours_lyceum_classes_half_classes'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_replace_hours_lyceum_classes_full_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Доплата за часы замены в полных лицейских/гимназических классах')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">

                    {{ $data['base']['replace_hours_lyceum_classes_full_classes'] }} @lang('site.часов')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_replace_hours_lyceum_classes_full_classes'] }}
                </p>
            </td>
        </tr>
    @endif

    @if(isset($data['additional_surcharges']['sum_replace_classroom_management_elementary_grade_half_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Замена классное руководство с 1 по 4 класс в классах с числом менее 15 учащихся')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">

                    {{ $data['base']['replace_classroom_management_elementary_grade_half_classes'] }} @lang('site.дней')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_replace_classroom_management_elementary_grade_half_classes'] }}
                </p>
            </td>
        </tr>
    @endif

    @if(isset($data['additional_surcharges']['sum_replace_classroom_management_elementary_grade_full_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p class="s2 s2-td-key-text">
                    @lang('site.Замена классное руководство с 1 по 4 класс в полных классах')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">
                    {{ $data['base']['replace_classroom_management_elementary_grade_full_classes'] }} @lang('site.дней')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_replace_classroom_management_elementary_grade_full_classes'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_replace_classroom_management_senior_grade_half_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p
                    class="s2 s2-table-col-key">
                    @lang('site.Замена классное руководство с 5 по 11 класс в классах с числом менее 15 учащихся')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">

                    {{ $data['base']['replace_classroom_management_senior_grade_half_classes'] }} @lang('site.дней')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p class="s2 s2-table-col-val-text">
                    {{ $data['additional_surcharges']['sum_replace_classroom_management_senior_grade_half_classes'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['additional_surcharges']['sum_replace_classroom_management_senior_grade_full_classes']))
        <tr style="height: 31pt">
            <td class="s2-td-key">
                <p class="s2 s2-td-key-text">
                    @lang('site.Замена классное руководство с 5 по 11 класс в полных классах')
                </p>
            </td>
            <td class="s2-table-col-center">
                <p class="s2 s2-table-col-center-text">
                    {{ $data['base']['replace_classroom_management_senior_grade_full_classes'] }} @lang('site.дней')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p
                    class="s2 s2-table-col-val-text "
                >
                    {{ $data['additional_surcharges']['sum_replace_classroom_management_senior_grade_full_classes'] }}
                </p>
            </td>
        </tr>
    @endif

    {{--    <tr style="height: 18pt">--}}
    {{--        <td class="s2-td-key">--}}
    {{--            <p--}}
    {{--                class="s2 s2-table-col-key">--}}
    {{--                xxxx Уровень по программам НИШ--}}
    {{--            </p>--}}
    {{--        </td>--}}
    {{--        <td class="s2-table-col-center">--}}
    {{--            <p class="s2 s2-table-col-center-text-2">--}}
    {{--                Второй (основной)--}}
    {{--            </p>--}}
    {{--        </td>--}}
    {{--        <td class="table-td-2-column-val"--}}

    {{--        >--}}
    {{--            <p--}}
    {{--                class="s2 s2-table-col-val"--}}
    {{--            >--}}
    {{--                59 345.78--}}
    {{--            </p>--}}
    {{--        </td>--}}
    {{--    </tr>--}}

</table>
<table
    style="border-collapse: collapse; ; width: 100%"
    cellspacing="0"
>
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
            style="border-top: unset !important;"
        >
            <p
                class="s2 s2-table-col-key"
            >
                @lang('site.ИТОГО НАЧИСЛЕНО'):
            </p>
        </td>
        <td class="table-td-2-column-val"

            style="border-top: unset !important;">
            <p
                class="s2 s2-table-col-val"
            >
                {{ $data['total_accured'] }}
            </p>
        </td>
    </tr>
</table>
<p style="text-indent: 0pt; text-align: left"><br/></p>
<p style="padding-top: 5pt;
        padding-bottom: 1pt;
        text-indent: 0pt;
        text-align: left;
        font-size:18px;"
>
    @lang('site.Удержание'):
</p>
<table
    style="border-collapse: collapse; width: 100%"
    cellspacing="0"
>
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key"
            >
                @lang('site.Взнос ОСМС')
            </p>
        </td>
        <td class="table-td-2-column-val">
            <p
                class="s2 s2-table-col-val"
            >
                {{ $data['withheld']['sum_osms_contribution']}}
            </p>
        </td>
    </tr>
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key">
                @lang('site.Обязательный пенсионный взнос')
            </p>
        </td>
        <td class="table-td-2-column-val">
            <p
                class="s2 s2-table-col-val"
            >
                {{ $data['withheld']['sum_mandatory_pension_contribution'] }}
            </p>
        </td>
    </tr>
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key"
            >
                @lang('site.Индивидуальный подоходный налог')
            </p>
        </td>
        <td class="table-td-2-column-val">
            <p
                class="s2 s2-table-col-val"
            >
                {{ $data['withheld']['sum_exempt_from_paying_individual_income_tax'] }}
            </p>
        </td>
    </tr>
    @if(isset($data['withheld']['sum_app_withholding_union_dues']))
        <tr style="height: 18pt">
            <td
                class="table-tr-2-column-key"
            >
                <p
                    class="s2 s2-table-col-key"
                >
                    @lang('site.Профсоюзный взнос')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p
                    class="s2 s2-table-col-val"
                >
                    {{ $data['withheld']['sum_app_withholding_union_dues'] }}
                </p>
            </td>
        </tr>
    @endif
    @if(isset($data['withheld']['sum_app_withholding_party_contributions']))
        <tr style="height: 18pt">
            <td
                class="table-tr-2-column-key"
            >
                <p
                    class="s2 s2-table-col-key"
                >
                    @lang('site.Партийный взнос')
                </p>
            </td>
            <td class="table-td-2-column-val">
                <p
                    class="s2 s2-table-col-val"
                >
                    {{ $data['withheld']['sum_app_withholding_party_contributions'] }}
                </p>
            </td>
        </tr>
    @endif
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key"
            >
                @lang('site.ИТОГО УДЕРЖАНО'):
            </p>
        </td>
        <td class="table-td-2-column-val">
            <p
                class="s2 s2-table-col-val"
            >
                {{ $data['total_withheld'] }}
            </p>
        </td>
    </tr>
</table>
<p style="text-indent: 0pt; text-align: left"><br/></p>
<table
    style="border-collapse: collapse;  width: 100%"
    cellspacing="0"
>
    <tr style="height: 18pt">
        <td
            class="table-tr-2-column-key"
        >
            <p
                class="s2 s2-table-col-key "
            >
                @lang('site.СУММА НА РУКИ'):
            </p>
        </td>
        <td class="table-td-2-column-val">
            <p
                class="s2"
                style="
              padding-top: 2pt;
              padding-left: 42pt;
              text-indent: 0pt;
              text-align: left;
            "
            >
                {{ $data['amount_hand'] }}
            </p>
        </td>
    </tr>
</table>
</body>
</html>
