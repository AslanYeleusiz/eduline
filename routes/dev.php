<?php

use App\Models\Material;
use App\Models\News;
use App\Models\Role;
use App\Models\TestClass;
use App\Models\TestSubject;
use App\Models\TestSubjectOption;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Services\V1\SalaryCalculationService;
use Faker\Generator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('pdf.salary');
    $test = SalaryCalculationService::getCoefficent('b4', 1,2, 2022, 6);
    var_dump($test);
    return view('welcome');
    dd($test);
    $subject = TestSubject::with('preparations.childs')->findOrFail(1);
    dd($subject);
    $testClassItems = TestClass::withCount(['preparations' => function($query) {
            return $query->where('test_subject_preparations.subject_id', 1)->whereNotNull('test_subject_preparations.parent_id');
        }])->whereHas('preparations', function($query) {
            return $query->where('test_subject_preparations.subject_id', 1)->whereNotNull('test_subject_preparations.parent_id');
        })->get();
    dd($testClassItems);
    $testClassItems = TestClass::whereHas('preparations', function($query){
        return $query->where('subject_id', 1);
    })->with(['preparations' => function($query) {
        return $query->where('subject_id',1)->whereNotNull('parent_id');
    }])->get();
    dd($testClassItems);
             $subject = TestSubject::with(['classItems' => function($query) {
             return $query;
         }])->findOrFail(1);
         dd($subject);
    $option = TestSubjectOption::with('questions')->get();
    dd($option);
    $user = User::with('subscription')->first();
    dd($user->subscription, $user,'user');
    // dd('ok');
    //     Artisan::call('key:generate');
    //     dd('ok');

    // return view('welcome');
    // $material = Material::first();
    // $year = (int) ($material->created_at?->format('Y') ?? now()->format('Y'));
    // $month = (int) ($material->created_at?->format('m') ?? now()->format('m'));

    // dd($material, $year, Str::length($year), (int) $month);
    // $image = Generator::image(Storage::disk('public')->path('images/news'), 300, 300);
    // dd($image);
    // // 'image' => $this->faker->image(Storage::disk('public')->path('images/news'), 300, 300)
    // $users = User::limit(20)->get();

    // dd($users);
})->name('dev.index');
Route::prefix('commands')->group(function() {
    Route::get('passport-install', function() {
        Artisan::call('passport:install');
        dd('install');
    });
    Route::get('optimize-clear', function() {
        Artisan::call('optimize');
        dd('clear');
    });


    Route::get('storage-link', function() {
        Artisan::call('storage:link');
        dd('link');
    });
Route::get('seed', function() {
        Artisan::call('db:seed');
        dd('clear');
    });


    Route::get('migrate', function() {
        Artisan::call('migrate');
        dd('migrate');
    });
});
