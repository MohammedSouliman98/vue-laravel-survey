<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function (){

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::resource('survey', \App\Http\Controllers\SurveyController::class);
Route::get('/Dashboard', [DashboardController::class , 'index']);

});

Route::get('/survey-by-slug/{survey:slug}', [SurveyController::class , 'showforgust']);
Route::post('/survey/{survey}/answer', [SurveyController::class , 'storeAnswer']);

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

