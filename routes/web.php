<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\CustomAuth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('auth.showLogin');
    Route::post('/login', 'login')->name('auth.login');
    Route::get('/register', 'showRegister')->name('auth.showRegister');
    Route::post('/register', 'register')->name('auth.register');
    Route::get('/logout', 'logout')->name('auth.logout');
});

// Home
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/{id}/post', 'post')->name('post');
});

// Dashboard
Route::middleware(CustomAuth::class)->prefix('dashboard')->name('dashboard.')->group(function () {
    // Index redirect
    Route::get('/', function () {
        return to_route('dashboard.post.index');
    })->name('index');

    // Post
    Route::controller(PostController::class)->prefix('post')->name('post.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}/show', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}/edit', 'update')->name('update');
        Route::post('/{id}/delete', 'delete')->name('delete');
    });
});
