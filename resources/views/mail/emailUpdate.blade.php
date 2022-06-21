<!doctype html>
<html lang="ru">
<head>
    <title>@lang('site.Изменить почту')</title>
</head>
<body>
    <p>@lang('site.Сәлеметсіз бе! Сіз eduline.kz сайтында осы почтаны көрсеттіңіз. Почтаны растау үшін төмендегі сілтемені бастыңыз:') </p>
    <a href="{{route('email.update',[ 'email' => $email, 'token'=>$token])}}">@lang('site.Сілтеме')</a>
    <p>@lang('site.Егер сіз ешқандай өзгеріс жасамасаңыз бұл хатты елемесеңіз болады.')</p>
    <p>@lang('site.С уважением, Eduline.kz')</p>
    <p style="margin-top: 15px">@lang('site.Примечание'): @lang('site.Это сообщение отправляется автоматически. Не нужно отвечать на письмо').</p>
</body>
</html>
