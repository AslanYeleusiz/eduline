<?php

/*
|--------------------------------------------------------------------------
| Authentication Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used during authentication for various
| messages that we need to display to the user. You are free to modify
| these language lines according to your application's requirements.
|
*/

return [
    'failed'   => 'Неверное имя пользователя или пароль.',
    'throttle' => 'Слишком много попыток входа. Пожалуйста, попробуйте еще раз через :seconds секунд.',
    'password' => 'Неверный пароль или логин.',
    // 'sms_verification' => 'Ваш код подтверждения: ',
    'sms_verification' => config('app.name') . '. Ваш код для подтверждения: ',
    'Phone or password is incorrect' => 'Телефон или пароль неверны',
    'You are not admin' => 'Посетить эту страницу может только администрация сайта.',
    'Phone number not found' => 'Номер телефона не найден',
    'Phone number is incorrect' => 'Номер телефона неверный',
    'phone_invalid' => 'Такого номера не существует',
    'incorrect_code' => 'Неверный код или номер телефона',
];
