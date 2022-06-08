<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AjaxUploadController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



        Route::get('/Announcement', [NewsController::class, 'announcement']);
        Route::get('/Popular', [NewsController::class, 'popular'])->name('news.popular');
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/news/save', [NewsController::class, 'save'])->name('news.save');
            Route::get('/Saves', [NewsController::class, 'news_saves'])->name('news.saves');
            Route::get('/news/comments/store', [CommentsController::class, 'store'])->name('index.comments.store');
            Route::get('/news/comments/answer', [CommentsController::class, 'answer'])->name('index.comments.answer');
            Route::get('/news/comments/likes', [CommentsController::class, 'likes'])->name('index.comments.likes');
        });
        Route::get('/news/id={id}', [NewsController::class, 'newspage'])->name('news.show');
        Route::get('/news/id={id}/comments', [CommentsController::class, 'show'])->name('.comments.show');
        Route::get('/', [NewsController::class, 'index'])->name('index');

Route::view('/attestation', 'pages.attestation')->name('attestation');

Route::post('/attestation', [MainController::class, 'attestation'])->name('attestation.store');

Route::view('/calculator', 'pages.calculator')->name('calculator');

Route::post('/calculator', [MainController::class, 'calculator'])->name('calculator.store');




Route::get('/consultations', [MainController::class, 'consultations'])->name('consultations');

Route::get('/consultation/{id?}', [MainController::class, 'consultation'], ['id' => 'id'])->name('consultation');

Route::post('/consultation/{id?}', [MainController::class, 'send'], ['id' => 'id','name' => 'name','phone' => 'phone']);







Route::get('/set_locale/{locale}', [PageController::class, 'set_locale'])->name('set_locale');



Route::get('email/{email}/{token}', [MainController::class, 'emailUpdate'])->name('email.update');

Route::view('admin/login', 'auth.login')->name('adminLoginShow');
Route::post('admin/login', [AuthController::class, 'adminLoginForm'])->name('adminLoginForm');

Route::middleware('guest')->group(function () {
    Route::view('login', 'pages.home')->name('login');
    Route::view('register', 'pages.home')->name('register');

    Route::post('register', [AuthController::class, 'register'])->name('ajax.register');
    Route::post('login', [AuthController::class, 'login'])->name('ajax.login');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('profile')->name('profile')->group(function () {
        Route::get('/', [PageController::class, 'profile']);
        Route::get('/subscription', [PageController::class, 'subscription'])->name('.subscription');
        Route::get('/password/update/{user}', [UserController::class, 'updatePassword'])->name('.ajax.updatePassword');
        Route::get('/email/update/{user}', [UserController::class, 'updateEmail'])->name('.ajax.updateEmail');
        Route::get('/update/{user}', [UserController::class, 'updateProfile'])->name('.ajax.updateProfile');
//        Route::post('/phone/send-sms', [UserController::class, 'checkSendSmsPhone'])->name('.ajax.checkSendSmsPhone');
    });
    Route::prefix('materials')->name('materials')->group(function () {
        Route::get('/', [PageController::class, 'materials']);
        Route::get('/search', [PageController::class, 'search'])->name('.search');
        Route::get('/item-{id}', [PageController::class, 'material'])->name('.material');
        Route::get('/my-materials', [PageController::class, 'myMaterials'])->name('.myMaterials');
        Route::post('/my-materials/publication/action', [AjaxUploadController::class, 'upload'])->name('.ajaxupload.action');
        Route::post('/my-materials/publication/store', [AjaxUploadController::class, 'store'])->name('.ajaxupload.store');
        Route::get('/my-materials/publication', [AjaxUploadController::class, 'index'])->name('.publication');
        Route::get('/my-materials/change/id-{id}', [PageController::class, 'change'])->name('.myMaterials.change');
        Route::get('/my-materials/changed', [PageController::class, 'changed'])->name('.myMaterials.changed');
        Route::post('/my-materials/delete', [PageController::class, 'delete'])->name('.myMaterials.delete');
        Route::get('/my-materials/send/journal', [PageController::class, 'journal'])->name('.myMaterials.journal');
        Route::get('/{id}/download', [MaterialController::class, 'download'])->name('.download');

        Route::get('/{id}/certificate', [MaterialController::class, 'getCertificate'])->where(['id' => '[0-9]+'])->name('.getCertificate');

        Route::get('/{id}/thank-letter', [MaterialController::class, 'getCertificateThankLetter'])->where(['id' => '[0-9]+'])->name('.getCertificateThank_letter');

        Route::get('/{id}/certificate-honor', [MaterialController::class, 'getCertificateHonor'])->where(['id' => '[0-9]+'])->name('.getCertificateHonor');
    });
});
