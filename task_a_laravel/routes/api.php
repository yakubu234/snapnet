<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('projects.employees', EmployeeController::class);
    Route::post('employees/{id}/restore', [EmployeeController::class, 'restore'])->name('employees.restore');
});

Route::get('dashboard', [ProjectController::class, 'dashboard'])->middleware('auth:sanctum');


// Route::apiResource('projects', ProjectController::class);
// Route::apiResource('projects.employees', EmployeeController::class);
// Route::post('employees/{id}/restore', [EmployeeController::class, 'restore'])->name('employees.restore');
