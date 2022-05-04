<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MaterialController;
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


Route::get('/', function () {
    return view('pages.home');
})->name('index');
Route::get('/materials', function () {
    return view('pages.materials.material');
});
Route::get('/materials/edit', function () {
    return view('pages.materials.mymaterial');
});
Route::get('/materials/item', function () {
    return view('pages.materials.materialpage');
});
Route::get('/attestation', function () {
    return view('pages.attestation');
});
Route::get('/calculator', function () {
    return view('pages.calculator');
});
Route::get('/consultation', function () {
    return view('pages.consultationPrev');
});
// Route::get('/consultation/main','mailController@index');

// Route::post('/consultation/send','mailController@send');

Route::get('/set_locale/{locale}',[PageController::class,'set_locale'])->name('set_locale');



//- -- -- - -- - - - - - //

// Route::get('/', [MainController::class, 'index'])->name('index');

// Route::get('/calc', [MainController::class, 'calc'])->name('calc');
Route::get('/materials/{id}/download', [MaterialController::class, 'download'])->name('materials.download');
// Route::get('/materials/{}/certificate',            [MaterialController::class, 'getCertificate'])->where(['id' => '[0-9]+'])->name('get_certificate');
// Route::get('/thank-letter/{id}',           [MaterialController::class, 'getCertificateThankLetter'])->where(['id' => '[0-9]+'])->name('get_certificate_thank_letter');
// Route::get('/certificate-honor/{id}',      [MaterialController::class, 'getCertificateHonor'])->where(['id' => '[0-9]+'])->name('get_certificate_honor');
// Route::post('/certificate',                [MaterialControllerdonwload::class, 'updateCertificate'])->name('update_certificate');
Route::get('email/{email}/{token}', [MainController::class, 'emailUpdate'])->name('email.update');
Route::get('login', [AuthController::class, 'loginShowForm'])->name('loginShow')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
