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

    <h1>Перейдите по ссылке ниже, чтобы Подтвердить почту </h1>
    <a href="{{route('profile.confirm.email',[ 'email' => $email])}}">Подтвердить почту</a>
</body>
</html>
