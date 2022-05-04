<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\MaterialController;
use App\Http\Controllers\Api\V1\MyMaterialController;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\SmsController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function (Request $request) {
     dd('api v1');
     return 'asdsd';
});

// newsAnouncements
Route::get('news/anouncements', [NewsController::class, 'newsAnouncements'])->name('news.anouncements');

Route::middleware('auth:api')->group(function () {
     Route::get('news/saveds', [NewsController::class, 'savedNews'])->name('news.saveds');
     Route::post('news/{news}/save', [NewsController::class, 'saveNews'])->name('news.save');
});
Route::get('news/populars', [NewsController::class, 'popularNews'])->name('news.populars');
Route::apiResource('news', NewsController::class)->names('news.')->only('index', 'show');

Route::post('materials/{id}/send-journal', [MaterialController::class, 'sendToJournal'])->name('materials.sendJournal');
Route::apiResource('materials',  MaterialController::class)->names('materials.')->only(['index', 'show']);

// Route::post('sms', [UserController::class, 'profileUpdate'])->name('profile.update');
Route::post('send-sms', [SmsController::class, 'store'])->name('sms.send');

Route::middleware('auth:api')->group(function () {
     Route::apiResource('my-materials',  MyMaterialController::class)->names('myMaterials.')
          ->only(['index', 'show', 'store', 'update', 'destroy']);

     Route::get('profile', [UserController::class, 'profile'])->name('profile');
     Route::post('profile', [UserController::class, 'updateProfile'])->name('profile.update');
     Route::post('profile/password', [UserController::class, 'updatePassword'])->name('profile.updatePassword');
      
     Route::post('profile/email', [UserController::class, 'updateEmail'])->name('profile.updateEmail');
     Route::post('profile/phone', [UserController::class, 'updatePhone'])->name('profile.updatePhone');
     Route::post('profile/phone/check-send-sms', [UserController::class, 'checkSendSmsNewPhone'])->name('profile.checkSendSmsNewPhone');
     Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

Route::middleware('guest')->group(function () {
     Route::post('login', [AuthController::class, 'login'])->name('login');
     Route::post('register', [AuthController::class, 'register'])->name('register');
});
