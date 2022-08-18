<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\FaqController;
use App\Http\Controllers\Api\V1\MaterialController;
use App\Http\Controllers\Api\V1\MyMaterialController;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\PersonalAdviceController;
use App\Http\Controllers\Api\V1\RolesController;
use App\Http\Controllers\Api\V1\SalaryCalculatorController;
use App\Http\Controllers\Api\V1\SmsController;
use App\Http\Controllers\Api\V1\SubscriptionController;
use App\Http\Controllers\Api\V1\Test\FullTestController;
use App\Http\Controllers\Api\V1\Test\TestDirectionController;
use App\Http\Controllers\Api\V1\Test\TestLanguageController;
use App\Http\Controllers\Api\V1\Test\TestSubjectController;
use App\Http\Controllers\Api\V1\Test\TestSubjectOptionController;
use App\Http\Controllers\Api\V1\Test\TestSubjectOptionTestController;
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

Route::get('faqs', [FaqController::class, 'index'])->name('faqs.index');


// newsAnouncements
Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');

Route::apiResource('personal-advices', PersonalAdviceController::class)->only(['index', 'show'])->names('personalAdvices.');
Route::post('personal-advices/{id}', [PersonalAdviceController::class, 'store'])->name('personalAdvices.store');

Route::middleware('auth:api')->group(function () {
// Route::get('news/anouncements', [NewsController::class, 'newsAnouncements'])->name('news.anouncements');
    // Route::get('news/saveds', [NewsController::class, 'savedNews'])->name('news.saveds');
// Route::get('news/populars', [NewsController::class, 'popularNews'])->name('news.populars');
Route::post('news/{news}/save', [NewsController::class, 'saveNews'])->name('news.save');
    Route::post('news/{news}/comment', [NewsController::class, 'newsCommentSave'])->name('news.commentSave');

Route::apiResource('news', NewsController::class)->names('news.')->only('index', 'show');
});

Route::get('roles', RolesController::class)->name('roles');

// Route::post('sms', [UserController::class, 'profileUpdate'])->name('profile.update');
Route::post('send-sms', [SmsController::class, 'store'])->name('sms.send');

Route::prefix('test')->middleware('auth:api')->name('test.')->group(function () {
    Route::get('languages', [TestLanguageController::class, 'index'])->name('languages.index');
    Route::get('directions', [TestDirectionController::class, 'index'])->name('directions.index');
    Route::get('subjects/{id}/options', [TestSubjectOptionController::class, 'index'])->name('subjects.options.index');



    //  Route::post('subjects/{id}/options/{option_id}', [TestSubjectOptionController::class, 'store'])->name('subjects.options.store');
    //  Route::post('subjects/{id}/options/{option_id}/finish', [TestSubjectOptionController::class, 'finish'])->name('subjects.options.finish');

    Route::prefix('subjects')->group(function () {
        Route::get('/{id}/preparations', [TestSubjectPreparationController::class, 'preparationsByTitle'])->name('subjects.options.preparationsByTitle');
        Route::get('/{id}/preparations/{preparation_id}', [TestSubjectPreparationController::class, 'preparation'])->name('subjects.options.preparation');
        Route::post('/{id}/preparations/order', [TestSubjectPreparationController::class, 'preparationOrderStore'])->name('subjects.options.preparationOrderStore');

        Route::post('/{id}/preparations/{preparation_id}/test-start', [TestSubjectPreparationController::class, 'preparationTestStart'])->name('subjects.options.preparationTestStart');
        Route::post('/{id}/preparations/{preparation_id}/test-finish', [TestSubjectPreparationController::class, 'preparationTestFinish'])->name('subjects.options.preparationTestFinish');

        Route::post('/{id}/preparations/{preparation_id}/appeal', [TestSubjectPreparationController::class, 'preparationAppeal'])->name('subjects.options.preparationAppeal');

        Route::get('/{id}/preparations-classes', [TestSubjectPreparationController::class, 'preparationClasses'])->name('subjects.options.preparationClasses');
        Route::get('/{id}/preparations-classes/{class_id}', [TestSubjectPreparationController::class, 'preparationClass'])->name('subjects.options.preparationClass');

        Route::post('/{id}/test-start', [TestSubjectController::class, 'testStart'])->name('subjects.testStart');
        Route::post('/{id}/test-finish', [TestSubjectController::class, 'testFinish'])->name('subjects.testFinish');
    });

    Route::prefix('option-test')->group(function () {
        Route::get('/results', [TestSubjectOptionTestController::class, 'results'])->name('subjectOptionTest.results');
        Route::get('/{id}', [TestSubjectOptionTestController::class, 'show'])->name('subjectOptionTest.show');

        Route::get('/{id}/questions', [TestSubjectOptionTestController::class, 'showWithUserAnswers'])->name('subjectOptionTest.showWithUserAnswers');
        Route::get('/{id}/result', [TestSubjectOptionTestController::class, 'result'])->name('subjectOptionTest.result');
        Route::post('/{id}/answer', [TestSubjectOptionTestController::class, 'saveUserAnswer'])->name('subjectOptionTest.saveUserAnswer');
        Route::post('/{id}/finish', [TestSubjectOptionTestController::class, 'finish'])->name('subjectOptionTest.finish');
        Route::post('/{subject_id}/{option_id}/create', [TestSubjectOptionTestController::class, 'store'])->name('subjectOptionTest.store');
    });

    Route::prefix('full-test')->group(function () {
        Route::get('/results', [FullTestController::class, 'results'])->name('full.results');

        Route::get('/{id}', [FullTestController::class, 'show'])->name('full.show');
        Route::get('/{id}/result', [FullTestController::class, 'result'])->name('full.result');
        Route::get('/{id}/{subject_id}', [FullTestController::class, 'showTestSubject'])->name('full.showTestSubject');

        // Route::get('full/{id}/result', [FullTestController::class, 'result']);
        Route::post('/{direction_id}/{subject_id}/create', [FullTestController::class, 'store'])->name('full.store');
        Route::post('/{id}/answer', [FullTestController::class, 'saveAnswer']);
        Route::post('/{id}/appeal', [FullTestController::class, 'testQuestionAppeal']);
        Route::post('/{id}/finish', [FullTestController::class, 'finish']);
    });
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
Route::get('salary-calculator', [SalaryCalculatorController::class, 'index']);

Route::post('salary-calculator', [SalaryCalculatorController::class, 'store']);
Route::get('salary-calculator/downloadPDF', [SalaryCalculatorController::class, 'downloadPDF']);

Route::prefix('materials')->name('materials.')->group(function () {
    Route::get('/{id}/download', [MaterialController::class, 'download'])->where(['id' => '[0-9]+'])->name('.download');
    Route::get('/{id}/certificate', [MaterialController::class, 'getCertificate'])->where(['id' => '[0-9]+'])->name('.getCertificate');
    Route::get('/{id}/thank-letter', [MaterialController::class, 'getCertificateThankLetter'])->where(['id' => '[0-9]+'])->name('.getCertificateThankLetter');
    Route::get('/{id}/certificate-honor', [MaterialController::class, 'getCertificateHonor'])->where(['id' => '[0-9]+'])->name('.getCertificateHonor');
});


Route::apiResource('materials',  MaterialController::class)->names('materials.')->only(['index', 'show']);

Route::middleware('guest')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register/send-code', [AuthController::class, 'registerSendSmsCode'])->name('register.send_sms');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    //2022_05_31_112258_create_news_comment_answers_table
    //2022_06_11_120740_create_material_edits_table
    //2022_06_14_123756_change_users_table
    //2022_06_14_170746_change_promo_codes_table
    //2022_06_16_151950_create_used_promocodes_table
    Route::post('reset-password/send-code', [AuthController::class, 'resetPasswordSendSmsCode'])->name('reset_password.send_sms');
    Route::post('reset-password/verify-code', [AuthController::class, 'resetPasswordVerifyCode'])->name('reset_password.verify_hash');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('reset_password');
});
