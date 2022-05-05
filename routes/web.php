<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/consultation/main','mailController@index');

Route::post('/consultation/send','mailController@send');
