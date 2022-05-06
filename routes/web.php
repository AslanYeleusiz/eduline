<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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
});
Route::get('/materials', function () {
    return view('pages.materials.material');
});
Route::get('/materials/my-materials', function () {
    return view('pages.materials.mymaterial');
});
Route::post('/materials/my-materials/publication/action', 'AjaxUploadController@action')->name('ajaxupload.action');

Route::get('/materials/my-materials/publication', function () {
    return view('pages.materials.materialpublication');
})->name('publication');

Route::get('/materials/my-materials/change', function () {
    return view('pages.materials.materialchange');
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
Route::get('/consultation/main', function () {
    return view('pages.consultation');
});

Route::get('/set_locale/{locale}',[PageController::class,'set_locale'])->name('set_locale');
