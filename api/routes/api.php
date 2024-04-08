<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
//    Route::get('/authenticated-user', [UserController::class, 'getByToken']);

    Route::prefix('/todo-list')->group(function () {
        Route::post('', [TodoListController::class, 'store']);
        Route::get('', [TodoListController::class, 'index']);
        Route::get('/{uuid}', [TodoListController::class, 'show']);
        Route::put('/{uuid}/positions', [TodoListController::class, 'changePositions']);
    });

    Route::prefix('/user')->group(function () {
        Route::get('/authenticated', [UserController::class, 'getByToken']);
        Route::get('/email', [UserController::class, 'getByEmail']);
    });

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::prefix('/todo')->group(function () {
        Route::get('/{uuid}', [TodoController::class, 'get']);
        Route::get('/todo-list/{todoListUuid}', [TodoController::class, 'getByTodoList']);

        Route::post('', [TodoController::class, 'store']);

        Route::put('/{uuid}', [TodoController::class, 'update']);
        Route::put('/toggle/{uuid}', [TodoController::class, 'toggleState']);
        Route::put('/title/{uuid}', [TodoController::class, 'changeTitle']);
    });

    Route::prefix('/tag')->group(function () {
        Route::get('', [TagController::class, 'index']);
    });

    Route::prefix('/todo-group')->group(function () {
        Route::put('', [TodoGroupController::class, 'store']);
    });
});

// Route::middleware('auth:guest')->group(function () {
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
