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
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


// Home
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return to_route('dashboard.post.index');
})->name('home');

// Dashboard
Route::middleware(CustomAuth::class)->prefix('dashboard')->name('dashboard.')->group(function () {
    // Index redirect
    Route::get('/', function () {
        return to_route('dashboard.post.index');
    })->name('index');

    // Post
    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('{id}/show', [PostController::class, 'show'])->name('show');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/create', [PostController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::post('{id}/edit', [PostController::class, 'update'])->name('update');
        Route::post('{id}/delete', [PostController::class, 'delete'])->name('delete');
    });
});
