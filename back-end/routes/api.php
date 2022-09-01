<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Clients\ClientController;
use App\Http\Controllers\Api\V1\Opportunities\OpportunityController;
use App\Http\Controllers\Api\V1\Products\ProductController;
use Illuminate\Support\Facades\Route;

/**
 * Auth
 */
Route::prefix('/auth')->name('auth.')->group(function (){
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth:api-sellers'], function (){

    /**
     * Clients
     */
    Route::prefix('/clients')->name('clients.')->group(function (){
        Route::get('', [ClientController::class, 'index'])->name('index');
        Route::post('', [ClientController::class, 'store'])->name('store');
    });

    /**
     * Products
     */
    Route::prefix('/products')->name('products.')->group(function (){
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::post('', [ProductController::class, 'store'])->name('store');
    });

    /**
     * Opportunities
     */
    Route::prefix('/opportunities')->name('opportunities.')->group(function (){
        Route::get('', [OpportunityController::class, 'index'])->name('index');
        Route::post('', [OpportunityController::class, 'store'])->name('store');
        Route::get('/{id}', [OpportunityController::class, 'show'])->name('show');
        Route::put('/{id}', [OpportunityController::class, 'update'])->name('update');
    });

    /**
     * Select Field
     */
    Route::prefix('/select-options')->name('select-options.')->group(function (){
        Route::get('/clients', [ClientController::class, 'selectClientOptions'])->name('clients');
        Route::get('/products', [ProductController::class, 'selectProductOptions'])->name('products');
    });
});
