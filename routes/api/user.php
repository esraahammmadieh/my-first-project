<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\counselingController;
use App\Http\Controllers\FavoritListController;
use App\Http\Controllers\FreetimeController;
use App\Http\Controllers\RatingController;
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

Route::post('user/register',[LoginController::class, 'userRegister']);
Route::post('user/login',[LoginController::class, 'userLogin']);
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
   // authenticated staff routes here
    Route::post('logout',[LoginController::class, 'LogoutUser']);
    Route::get('listCounsling',[counselingController::class, 'ListCounseling']);
    Route::get('Singleexpert/{id}',[ExpertController::class, 'SingleExpert']);
    Route::post('searchExpert/{name}',[ExpertController::class, 'SearchForExpert']);
    Route::get('search/{Cname}',[counselingController::class, 'SearchForCounsling']);
    Route::get('ExpertofCoun/{Counslingname}',[ExpertController::class, 'ExpertForCounsling']);
    //Add To Faviorte List
    Route::get('ListFav',[FavoritListController::class, 'FavoriteExpert']);
    Route::post('Fav/{id}',[FavoritListController::class, 'fav']);
    Route::get('UnFav/{id}',[FavoritListController::class, 'unfav']);
    Route::get('showallfree/{id}',[FreetimeController::class,'showallfreetimeofcertainexpert']);
    Route::post('selectshedule/{id}',[FreetimeController::class,'select_appointment']);
    Route::post('Rating/{id}',[RatingController::class,'Rating']);
    Route::post('ShowRating/{id}',[RatingController::class,'ShowRating']);
});
