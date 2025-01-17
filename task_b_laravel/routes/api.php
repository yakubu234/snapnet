<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\RoleController;

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:Admin')->group(function () {
        Route::post('/roles/assign/{user}', [RoleController::class, 'assignRole']);
        Route::post('/roles/remove/{user}', [RoleController::class, 'removeRole']);
    });

    Route::middleware('role:Manager')->group(function () {
        Route::get('/projects', 'ProjectController@index');
        Route::get('/employees', 'EmployeeController@index');
    });

    Route::middleware('role:Employee')->group(function () {
        Route::get('/profile', 'ProfileController@show');
        Route::get('/projects/{project}', 'ProjectController@show');
    });
});
