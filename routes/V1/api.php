<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\MaterialController;
use App\Http\Controllers\Api\V1\MyMaterialController;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\PersonalAdviceController;
use App\Http\Controllers\Api\V1\RolesController;
use App\Http\Controllers\Api\V1\SmsController;
use App\Http\Controllers\Api\V1\SubscriptionController;
use App\Http\Controllers\Api\V1\Test\FullTestController;
use App\Http\Controllers\Api\V1\Test\TestDirectionController;
use App\Http\Controllers\Api\V1\Test\TestLanguageController;
use App\Http\Controllers\Api\V1\Test\TestSubjectOptionController;
use App\Http\Controllers\Api\V1\Test\TestSubjectPreparationController;
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
     return 'asdsd';
});

// newsAnouncements
Route::get('news/anouncements', [NewsController::class, 'newsAnouncements'])->name('news.anouncements');
Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');

Route::apiResource('personal-advices', PersonalAdviceController::class)->only(['index', 'show'])->names('personalAdvices.');
Route::post('personal-advices/{id}', [PersonalAdviceController::class, 'store'])->name('personalAdvices.store');

Route::middleware('auth:api')->group(function () {
     Route::get('news/saveds', [NewsController::class, 'savedNews'])->name('news.saveds');
     Route::post('news/{news}/save', [NewsController::class, 'saveNews'])->name('news.save');
     Route::post('news/{news}/comment', [NewsController::class, 'newsCommentSave'])->name('news.commentSave');
});
Route::get('roles', RolesController::class)->name('roles');

Route::get('news/populars', [NewsController::class, 'popularNews'])->name('news.populars');
Route::apiResource('news', NewsController::class)->names('news.')->only('index', 'show');

// Route::post('sms', [UserController::class, 'profileUpdate'])->name('profile.update');
Route::post('send-sms', [SmsController::class, 'store'])->name('sms.send');

Route::prefix('test')->name('test.')->group(function() {
     Route::get('languages', [TestLanguageController::class, 'index'])->name('languages.index');
     Route::get('directions', [TestDirectionController::class, 'index'])->name('directions.index');
     Route::get('subjects/{id}/options', [TestSubjectOptionController::class, 'index'])->name('subjects.options.index');
     Route::post('subjects/{id}/options/{option_id}', [TestSubjectOptionController::class, 'store'])->name('subjects.options.store');
     Route::post('subjects/{id}/options/{option_id}/finish', [TestSubjectOptionController::class, 'finish'])->name('subjects.options.finish');
    
     Route::get('subjects/{id}/preparations', [TestSubjectPreparationController::class, 'preparationsByTitle'])->name('subjects.options.preparationsByTitle');
     Route::get('subjects/{id}/preparations/{preparation_id}', [TestSubjectPreparationController::class, 'preparation'])->name('subjects.options.preparation');

     Route::post('subjects/{id}/preparations/{preparation_id}/test-start', [TestSubjectPreparationController::class, 'preparationTestStart'])->name('subjects.options.preparationTestStart');
     Route::post('subjects/{id}/preparations/{preparation_id}/test-finish', [TestSubjectPreparationController::class, 'preparationTestFinish'])->name('subjects.options.preparationTestFinish');
    
     Route::post('subjects/{id}/preparations/{preparation_id}/appeal', [TestSubjectPreparationController::class, 'preparationAppeal'])->name('subjects.options.preparationAppeal');
     
     Route::get('subjects/{id}/preparations-classes', [TestSubjectPreparationController::class, 'preparationClasses'])->name('subjects.options.preparationClasses');
     Route::get('subjects/{id}/preparations-classes/{class_id}', [TestSubjectPreparationController::class, 'preparationClass'])->name('subjects.options.preparationClass');

     Route::get('full/{id}', [FullTestController::class, 'show'])->name('full.show');
     Route::get('full/{uuid}/result', [FullTestController::class, 'result']);
     Route::post('full', [FullTestController::class, 'store'])->name('full.store');
     Route::post('full/{id}/answer', [FullTestController::class, 'saveAnswer']);
     Route::post('full/{id}/appeal', [FullTestController::class, 'testQuestionAppeal']);
     Route::post('full/{id}/finish', [FullTestController::class, 'finish']);
});

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

     Route::post('materials/{id}/send-journal', [MaterialController::class, 'sendToJournal'])->name('materials.sendJournal');
     Route::post('materials/{id}/comment', [MaterialController::class, 'materialCommentSave'])->name('materials.commentSave');

});

Route::get('materials/{id}/download',            [MaterialController::class, 'download'])->where(['id' => '[0-9]+'])->name('materials.download');
Route::get('materials/{id}/certificate',         [MaterialController::class, 'getCertificate'])->where(['id' => '[0-9]+'])->name('materials.getCertificate');
Route::get('materials/{id}/thank-letter',        [MaterialController::class, 'getCertificateThankLetter'])->where(['id' => '[0-9]+'])->name('materials.getCertificateThankLetter');
Route::get('materials/{id}/certificate-honor',   [MaterialController::class, 'getCertificateHonor'])->where(['id' => '[0-9]+'])->name('materials.getCertificateHonor');

Route::apiResource('materials',  MaterialController::class)->names('materials.')->only(['index', 'show']);

Route::middleware('guest')->group(function () {
     Route::post('login', [AuthController::class, 'login'])->name('login');
     Route::post('register', [AuthController::class, 'register'])->name('register');
});
