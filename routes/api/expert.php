<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\counselingController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FreetimeController;
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

Route::post('expert/register',[LoginController::class, 'expetRegister']);
Route::post('expert/login',[LoginController::class, 'expertLogin']);
Route::get('listExpert',[ExpertController::class, 'ShowAllExpert']);
// Route::get('ExpCoun/{nEx}',[ExpertController::class, 'ExpertForCounsling']);


Route::group( ['prefix' => 'expert','middleware' => ['auth:expert-api','scopes:expert'] ],function(){
    Route::post('CreateCounsel',[counselingController::class, 'CreatCounseling']);
    // Route::post('CreatAppoi',[AppointmentController::class, 'CreateAppointment']);
    Route::post('Logout.expert',[LoginController::class, 'Logoutexpert']);
    Route::post('freetime',[FreetimeController::class,'inputfreetime']);
    Route::get('showshedules',[FreetimeController::class,'shedulesexpert']);
});
