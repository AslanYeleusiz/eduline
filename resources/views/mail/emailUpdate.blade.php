<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Изменить почту</title>
</head>
<body>

    <h1>Перейдите по ссылке ниже, чтобы изменить почту </h1>
    <a href="{{route('email.update',[ 'email' => $email, 'token'=>$token])}}">Изменить почту</a>
</body>
</html>
