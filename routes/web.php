<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::get('/profile/avatar/{filename}', [ProfileController::class, 'getImage'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user', [ProfileController::class, 'config'])->name('user.config');
    Route::post('/user/updateUser', [ProfileController::class, 'updateUser'])->name('user.update');


    Route::get('/upload_image', [ImageController::class, 'create'])->name('image.create');
    Route::post('/image/save', [ImageController::class, 'save'])->name('image.save');
});

require __DIR__ . '/auth.php';
