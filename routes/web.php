<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AjaxUploadController;

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


Route::get('/', function () {return view('pages.home');})->name('index');

Route::view('/attestation', 'pages.attestation')->name('attestation');

Route::post('/attestation', [MainController::class, 'attestation'])->name('attestation.store');

Route::view('/calculator', 'pages.calculator')->name('calculator');

Route::post('/calculator', [MainController::class, 'calculator'])->name('calculator.store');

Route::get('/consultations', [MainController::class, 'consultations'])->name('consultations');

Route::get('/consultation/{id?}', [MainController::class, 'consultation'], ['id' => 'id'])->name('consultation');

Route::get('/materials', function () { return view('pages.materials.material');});
Route::get('/materials/my-materials', function () { return view('pages.materials.mymaterial');});
Route::post('/materials/my-materials/publication/action', [AjaxUploadController::class, "action"])->name('ajaxupload.action');

Route::get('/set_locale/{locale}', [PageController::class, 'set_locale'])->name('set_locale');

Route::get('/materials/{id}/download', [MaterialController::class, 'download'])->name('materials.download');

// Route::get('/materials/{}/certificate',            [MaterialController::class, 'getCertificate'])->where(['id' => '[0-9]+'])->name('get_certificate');
// Route::get('/thank-letter/{id}',           [MaterialController::class, 'getCertificateThankLetter'])->where(['id' => '[0-9]+'])->name('get_certificate_thank_letter');
// Route::get('/certificate-honor/{id}',      [MaterialController::class, 'getCertificateHonor'])->where(['id' => '[0-9]+'])->name('get_certificate_honor');
// Route::post('/certificate',                [MaterialControllerdonwload::class, 'updateCertificate'])->name('update_certificate');

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
        Route::get('/my-materials', [PageController::class, 'myMaterials'])->name('.myMaterials');
    });
});

Route::post('/materials/my-materials/publication/action', [AjaxUploadController::class, 'upload'])->name('ajaxupload.action');

Route::get('/materials/my-materials/publication', [AjaxUploadController::class, 'index'])->name('publication');

Route::get('/materials/my-materials/change', function () {
    return view('pages.materials.materialchange');
});

Route::get('/materials/item', function () {
    return view('pages.materials.materialpage');
});
