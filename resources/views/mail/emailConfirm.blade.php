<!doctype html>
<html lang="ru">
<head>
    <title>@lang('site.Подтвердить почту')</title>
</head>
<body>
    <style>
        p, a{
            font-size: 16px;
            font-weight: 400;
        }
    </style>
    <p>@lang('site.Сәлеметсіз бе! Сіз eduline.kz сайтында осы почтаны көрсеттіңіз. Почтаны растау үшін төмендегі сілтемені бастыңыз:') </p>
    <a href="{{route('profile.confirm.email',[ 'email' => $email])}}">@lang('site.Сілтеме')</a>
    <p>@lang('site.Егер сіз ешқандай өзгеріс жасамасаңыз бұл хатты елемесеңіз болады.')</p>
    <p>@lang('site.С уважением, Eduline.kz')</p>
    <p style="margin-top: 15px">@lang('site.Примечание'): @lang('site.Это сообщение отправляется автоматически. Не нужно отвечать на письмо').</p>
</body>
</html>
