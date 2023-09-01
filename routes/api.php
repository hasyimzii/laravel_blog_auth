<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\ApiMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::middleware(ApiMiddleware::class)->post('/register', 'register');
    Route::middleware(ApiMiddleware::class)->post('/user', 'getUser');
    Route::middleware(ApiMiddleware::class)->post('/logout', 'logout');
});
