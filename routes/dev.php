<?php

use App\Models\Material;
use App\Models\News;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Faker\Generator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    // dd('ok');
    //     Artisan::call('key:generate');
    //     dd('ok');

    $role = Role::isGeneral()->select('id')->get()->pluck('id')->toArray();

    dd($role);
    dd(auth()->user());
    $news = News::with('newsType')
        ->with('comments', fn ($query) => $query->withExists('thisUserLiked as is_liked')
            ->with('user'))
        ->withCount('comments')
        ->withExists('thisUserSaved as is_saved')
        ->findOrFail(1);

    return view('welcome');
    $material = Material::first();
    $year = (int) ($material->created_at?->format('Y') ?? now()->format('Y'));
    $month = (int) ($material->created_at?->format('m') ?? now()->format('m'));

    dd($material, $year, Str::length($year), (int) $month);
    $image = Generator::image(Storage::disk('public')->path('images/news'), 300, 300);
    dd($image);
    // 'image' => $this->faker->image(Storage::disk('public')->path('images/news'), 300, 300)
    $users = User::limit(20)->get();

    dd($users);
})->name('dev.index');
Route::prefix('commands')->group(function() {
    Route::get('passport-install', function() {
        Artisan::call('passport:install');
        dd('install');
    });
    Route::get('optimize-clear', function() {
        Artisan::call('optimize:clear');
        dd('clear');
    });
    
    Route::get('storage-link', function() {
        Artisan::call('storage:link');
        dd('link');
    });
});