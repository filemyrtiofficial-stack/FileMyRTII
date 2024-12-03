<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('send-otp',[AuthController::class, 'sendOtp']);
Route::post('verify-otp',[AuthController::class, 'verifyOtp']);

Route::middleware(['api-auth'])->group(function () {
    Route::get('my-profile',[AuthController::class, 'myProfile']);
    Route::post('register',[AuthController::class, 'register']);
    
});
Route::get('specialities',[DataController::class, 'specialityList']);
Route::post('hospitals',[DataController::class, 'hospitalList']);
Route::post('doctors',[DataController::class, 'doctorList']);
Route::get('disease-types',[DataController::class, 'diseaseTypeList']);
Route::get('disease-types/{id}',[DataController::class, 'getDiseaseType']);
Route::get('dashboard',[DataController::class, 'dashboard']);
Route::get('lab-tests',[DataController::class, 'labTest']);

