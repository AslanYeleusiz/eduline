<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Подтвердить почту</title>
</head>
<body>

    <h1>@lang('site.Сәлеметсіз бе! Сіз eduline.kz сайтында осы почтаны көрсеттіңіз. Почтаны растау үшін төмендегі сілтемені бастыңыз:') </h1>
    <a href="{{route('profile.confirm.email',[ 'email' => $email])}}">{{route('email.update',[ 'email' => $email, 'token'=>$token])}}</a>
    <p>@lang('site.Егер сіз ешқандай өзгеріс жасамасаңыз бұл хатты елемесеңіз болады.')</p>
    <p>@lang('site.С уважением, Eduline.kz')</p>
    <p style="margin-top: 15px"><b>@lang('site.Примечание'):</b> @lang('site.Это сообщение отправляется автоматически. Не нужно отвечать на письмо').</p>
</body>
</html>
