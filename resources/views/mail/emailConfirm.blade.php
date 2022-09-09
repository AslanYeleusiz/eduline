<!doctype html>
<html lang="ru">
<head>
    <title>@lang('site.Подтвердить почту')</title>
</head>
<body>
    <p>@lang('site.Сәлеметсіз бе! Сіз eduline.kz сайтында осы почтаны көрсеттіңіз. Почтаны растау үшін төмендегі сілтемені басыңыз:') </p>
    <a href="{{route('profile.confirm.email',[ 'email' => $email, 'token' => $token])}}">Сілтеме</a>
    <p>@lang('site.Егер сіз ешқандай өзгеріс жасамасаңыз бұл хатты елемесеңіз болады.')</p>
    <p>@lang('site.С уважением, Eduline.kz')</p>
    <p style="margin-top: 15px">@lang('site.Примечание'): @lang('site.Это сообщение отправляется автоматически. Не нужно отвечать на письмо').</p>
</body>
</html>
