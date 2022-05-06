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
    'sms_verification' => 'Ваш код подтверждения: ',
    'incorrect_code' => 'неверный код',
    'sms_verification' => config('app.name') . '. Ваш код для подтверждения: ',
];
