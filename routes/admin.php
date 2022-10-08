<?php

use App\Http\Controllers\Admin\DeletedMaterialController;
use App\Http\Controllers\Admin\MaterialEditController;
use App\Http\Controllers\Admin\MaterialClassController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\Test\TestOptionQuestionAppealController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsTypeController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\MaterialDirectionController;
use App\Http\Controllers\Admin\MaterialSubjectController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MaterialJournalController;
use App\Http\Controllers\Admin\PersonalAdviceController;
use App\Http\Controllers\Admin\PersonalAdviceOrderController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\Test\TestQuestionAppealController;
use App\Http\Controllers\Admin\Test\TestClassController;
use App\Http\Controllers\Admin\Test\TestDirectionController;
use App\Http\Controllers\Admin\Test\TestLanguageController;
use App\Http\Controllers\Admin\Test\TestPreparationAppealController;
use App\Http\Controllers\Admin\Test\TestQuestionController;
use App\Http\Controllers\Admin\Test\TestSubjectController;
use App\Http\Controllers\Admin\Test\TestSubjectOptionController;
use App\Http\Controllers\Admin\Test\TestSubjectPreparationController;
use App\Http\Controllers\Admin\Test\TestTrainerController;
//use App\Http\Controllers\Api\V1\CkeditorController;
use App\Models\Subscription;
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


Route::get('/', [MainController::class, 'index'])->name('index');

//Route::post('/ckeditor/upload-image', [CkeditorController::class, 'uploadImage']);

Route::get('users/{user}/subscriptions', [UserController::class, 'userSubscriptions'])->name('users.subscriptions');

Route::post('users/{user}/subscriptions/{subscription}', [UserController::class, 'userSubscriptionStore'])->name('users.subscriptions.store');

Route::delete('users/{user}/subscriptions/{subscription}', [UserController::class, 'userSubscriptionDelete'])->name('users.subscriptions.delete');
Route::resource('faqs', FaqController::class)->except(['show'])->names('faqs');

Route::resource('users', UserController::class)->except(['show'])->names('users');
Route::resource('roles', RoleController::class)->except(['show'])->names('roles');
Route::resource('materials/subjects', MaterialSubjectController::class)->except(['show'])->names('materialSubjects');
Route::resource('materials/directions', MaterialDirectionController::class)->except(['show'])->names('materialDirections');
Route::resource('materials/classes', MaterialClassController::class)->except(['show'])->names('materialClasses');
Route::resource('materials', MaterialController::class)->except(['show', 'create', 'store'])->names('materials');
Route::resource('material-journals', MaterialJournalController::class)->except(['show', 'create', 'store'])->names('materialJournals');
Route::resource('deleted-materials', DeletedMaterialController::class)->except(['show', 'create', 'store'])->names('deletedMaterials');
Route::resource('edited-materials', MaterialEditController::class)->except(['show', 'create', 'store'])->names('editedMaterials');
Route::get('materials/{id}/comments', [MaterialController::class, 'comments'])->name('materials.comments');
Route::delete('materials/{id}/comments/{comment_id}', [MaterialController::class, 'commentDelete'])->name('materials.commentsDelete');
Route::resource('subscriptions', SubscriptionController::class)->except(['show'])->names('subscriptions');
Route::resource('personal-advice/orders', PersonalAdviceOrderController::class)->except(['show', 'create', 'store'])->names('personalAdviceOrders');
Route::resource('personal-advice', PersonalAdviceController::class)->except(['show'])->names('personalAdvice');
Route::resource('promo-codes', PromoCodeController::class)->except(['show'])->names('promoCodes');

Route::resource('news-types', NewsTypeController::class)->except(['show'])->names('newsTypes');
Route::resource('news', NewsController::class)->except(['show'])->names('news');
Route::get('news/{id}/comments', [NewsController::class, 'comments'])->name('news.comments');
Route::delete('news/{id}/comments/{comment_id}', [NewsController::class, 'commentDelete'])->name('news.commentsDelete');
Route::resource('slider', SliderController::class)->except(['show'])->names('slider');

Route::name('test.')->group(function () {
    Route::resource('languages', TestLanguageController::class)->except(['show'])->names('languages');
    Route::resource('subjects', TestSubjectController::class)->except(['show'])->names('subjects');
    Route::resource('trainers', TestTrainerController::class)->except(['show'])->names('trainers');


    // -- options//
    // test_subject_preparation_classes delete //

    Route::resource('subjects/{subject}/options', TestSubjectOptionController::class)->except(['show'])->names('subjectOptions');
    Route::get('subjects/{subject}/options/{option}/questions', [TestSubjectOptionController::class, 'questions'])->name('subjectOptionQuestions.index');
    Route::post('subjects/{subject}/options/{option}/questions', [TestSubjectOptionController::class, 'saveQuestions'])->name('subjectOptionQuestions.save');
    Route::post('subjects/{subject}/options/{option}/create-questions', [TestSubjectOptionController::class, 'createQuestions'])->name('subjectOptionQuestions.create');
    Route::post('subjects/{subject}/options/{option}/questions-numbers', [TestSubjectOptionController::class, 'saveQuestionsNumbers'])->name('subjectOptionQuestions.saveNumbers');
    Route::delete('subjects/{subject}/options/{option}/questions/{question}', [TestSubjectOptionController::class, 'deleteQuestions'])->name('subjectOptionQuestions.delete');

    // -- preparation //

    Route::resource('subjects/{subject}/preparations', TestSubjectPreparationController::class)->except(['show'])->names('subjectPreparations');

    // -- end -- //

    Route::resource('directions', TestDirectionController::class)->except(['show'])->names('directions');
    Route::resource('questions', TestQuestionController::class)->except(['show'])->names('questions');
    Route::resource('classes', TestClassController::class)->except(['show'])->names('classes');

    Route::resource('option-question-appeals', TestOptionQuestionAppealController::class)->only(['index', 'destroy'])->names('optionQuestionAppeals');

    Route::resource('question-appeals', TestQuestionAppealController::class)->except(['show'])->names('questionAppeals');

    Route::resource('preparation-appeals', TestPreparationAppealController::class)->only(['index', 'destroy'])->names('preparationAppeals');


});
