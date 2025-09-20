<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function (){

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


});
Route::resource('survey', \App\Http\Controllers\SurveyController::class);

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

