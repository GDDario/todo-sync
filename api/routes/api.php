<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoGroupController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\UserController;
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

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('email/reset', [EmailController::class, 'resetEmail']);
Route::post('email/confirm-token', [EmailController::class, 'confirmToken']);

Route::post('password/reset', [PasswordController::class, 'resetPassword']);
Route::post('password/confirm-token', [PasswordController::class, 'confirmToken']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::post('email/send-reset-email', [EmailController::class, 'sendResetEmail']);
    Route::post('password/send-reset-email', [PasswordController::class, 'sendResetEmail']);

    Route::prefix('/todo-list')->group(function () {
        Route::get('', [TodoListController::class, 'index']);
        Route::get('/{uuid}', [TodoListController::class, 'show']);
        Route::put('/{uuid}/positions', [TodoListController::class, 'changePositions']);
        Route::post('', [TodoListController::class, 'store']);
    });

    Route::prefix('/user')->group(function () {
        Route::get('/authenticated', [UserController::class, 'getByToken']);
        Route::get('/email', [UserController::class, 'getByEmail']);
        Route::put('', [UserController::class, 'update']);
    });

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::prefix('/todo')->group(function () {
        Route::get('/{uuid}', [TodoController::class, 'get']);
        Route::get('/todo-list/{todoListUuid}', [TodoController::class, 'getByTodoList']);
        Route::put('/{uuid}', [TodoController::class, 'update']);
        Route::put('/toggle/{uuid}', [TodoController::class, 'toggleState']);
        Route::put('/title/{uuid}', [TodoController::class, 'changeTitle']);
        Route::post('', [TodoController::class, 'store']);
    });

    Route::prefix('/tag')->group(function () {
        Route::get('', [TagController::class, 'index']);
    });

    Route::prefix('/todo-group')->group(function () {
        Route::put('', [TodoGroupController::class, 'store']);
    });

    Route::prefix('/preferences')->group(function () {
        Route::get('', [PreferencesController::class, 'index']);
        Route::get('/logged-user', [PreferencesController::class, 'get']);
        Route::put('', [PreferencesController::class, 'update']);
    });
});

// Route::middleware('auth:guest')->group(function () {
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
