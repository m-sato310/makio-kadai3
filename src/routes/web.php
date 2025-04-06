<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightLogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register/step1', [AuthController::class, 'registerStep1Form']);
Route::post('/register/step1', [AuthController::class, 'registerStep1Store']);
Route::get('/register/step2', [WeightLogController::class, 'registerStep2Form']);
Route::post('/register/step2', [WeightLogController::class, 'registerStep2Store']);


Route::middleware(['auth'])->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index']);
    Route::post('/weight_logs/create', [WeightLogController::class, 'store']);
    Route::get('/weight_logs/search', [WeightLogController::class, 'search']);

    Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'goalSettingForm']);
    Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'goalSettingUpdate']);

    Route::get('/weight_logs/{id}', [WeightLogController::class, 'edit']);
    Route::post('/weight_logs/{id}/update', [WeightLogController::class, 'update']);
    Route::post('/weight_logs/{id}/delete', [WeightLogController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});