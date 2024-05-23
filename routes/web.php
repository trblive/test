<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// static pages
Route::get('/', [StaticPageController::class, 'welcome'])->name('home');
Route::get('/welcome', [StaticPageController::class, 'welcome'])->name('welcome');
Route::get('/about', [StaticPageController::class, 'about'])->name('about');
Route::get('/contact-us', [StaticPageController::class, 'contact_us'])->name('contact-us');
Route::get('/pricing', [StaticPageController::class, 'pricing'])->name('pricing');

// user dashboard
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/dashboard/profile/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard/profile', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::get('/dashboard/delete', [DashboardController::class, 'delete'])->name('dashboard.delete');
    Route::delete('/dashboard', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

// roles
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::patch('/roles', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('destroy');
});


Route::middleware('auth')->group(function () {
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // delete user confirmation
    Route::get('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

    // trashed users
    Route::get('/users/trash', [UserController::class, 'trash'])->name('users.trash');
    // recover/delete single user
    Route::get('/users/trash/{id}/restore', [UserController::class, 'restore'])->name('users.trash-restore');
    Route::delete('/users/trash/{id}/remove', [UserController::class, 'remove'])->name('users.trash-remove');

    // recover/delete all users
    Route::post('/users/trash/recover', [UserController::class, 'recoverAll'])->name('users.trash-recover');
    Route::delete('/users/trash/empty', [UserController::class, 'empty'])->name('users.trash-empty');

    // user controller
    Route::resource('users', UserController::class);

    // delete listing confirmation
    Route::get('/listings/{listing}/delete', [ListingController::class, 'delete'])->name('listings.delete');

    // trashed listings
    Route::get('/listings/trash', [ListingController::class, 'trash'])->name('listings.trash');
    // recover/delete single listing
    Route::get('/listings/trash/{id}/restore', [ListingController::class, 'restore'])->name('listings.trash-restore');
    Route::delete('/listings/trash/{id}/remove', [ListingController::class, 'remove'])->name('listings.trash-remove');

    // recover/delete all listings
    Route::post('/listings/trash/recover', [ListingController::class, 'recoverAll'])->name('listings.trash-recover');
    Route::delete('/listings/trash/empty', [ListingController::class, 'empty'])->name('listings.trash-empty');

    // listing controller
    Route::resource('listings', ListingController::class);
});

require __DIR__ . '/auth.php';
