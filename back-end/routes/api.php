<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Auth
 */
Route::prefix('/auth')->name('auth.')->group(function (){
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

//Route::group(['middleware' => 'auth:api-sellers'], function (){
//    Route::get('/teste', [AuthController::class, 'teste'])->name('iau');
//});
