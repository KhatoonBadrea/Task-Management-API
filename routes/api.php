<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

// Routes for admin: full CRUD access to users
Route::group(['middleware' => ['auth:api', 'admin']], function () {
    Route::apiResource('users', UserController::class);
});

// Routes for tasks: admin and manager access
Route::group(['middleware' => ['auth:api']], function () {
    // Admins and managers can create tasks
    Route::post('tasks', [TaskController::class, 'store'])->middleware('adminOrManager');

    // Admins can perform all CRUD operations on tasks
    Route::apiResource('tasks', TaskController::class)->only(['index', 'show']);

    // Admins and managers can update or delete tasks
    Route::put('tasks/{task}', [TaskController::class, 'update'])->middleware('adminOrManager');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->middleware('adminOrManager');
    Route::put('tasks/{task}/assigne', [TaskController::class, 'update_assigned_to'])->middleware('adminOrManager');
    Route::get('my_tasks', [TaskController::class, 'get_my_task']);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus']);
});
