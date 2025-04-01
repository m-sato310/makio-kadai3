<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightLogController;
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

Route::get('/register/step1', function () {
    return view('auth.register-step1');
});
Route::post('/register', [AuthController::class, 'store']);
Route::get('/register/step2', [WeightLogController::class, 'registerStep2Form']);
Route::post('/register/step2', [WeightLogController::class, 'registerStep2Store']);