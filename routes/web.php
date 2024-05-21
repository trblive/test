<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StaticPageController::class, 'welcome'])->name('home');
Route::get('/welcome', [StaticPageController::class, 'welcome'])->name('welcome');
Route::get('/about', [StaticPageController::class, 'about'])->name('about');
Route::get('/contact-us', [StaticPageController::class, 'contact_us'])->name('contact-us');
Route::get('/pricing', [StaticPageController::class, 'pricing'])->name('pricing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//    profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//    user controller
    Route::resource('users', UserController::class);
    Route::get('users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

    // trashed users
    Route::get('users/trash', [UserController::class, 'trash'])->name('users.trash');
    // recover/delete single user
    Route::get('users/trash/{id}/restore', [UserController::class, 'restore'])->name('users.trash-restore');
    Route::get('users/trash/{id}/remove', [UserController::class, 'remove'])->name('users.trash-remove');

    // recover/delete all
    Route::get('users/trash/recover', [UserController::class, 'recoverAll'])->name('users.trash-recover');
    Route::get('users/trash/empty', [UserController::class, 'empty'])->name('users.empty');
});

require __DIR__ . '/auth.php';
