<?php



use Illuminate\Support\Facades\Route;
use SkylarkSoft\HoneyComb\Authentication\Controllers\API\V1\LoginController;
use SkylarkSoft\HoneyComb\Authentication\Controllers\API\V1\RegisterController;


Route::group(['prefix' => '/api/v1/'], function () {
    Route::group(['prefix' => 'auth'],function() {
        Route::post('/register',[RegisterController::class,'register']);
        Route::post('/login',[LoginController::class,'login']);

        Route::middleware('auth:api')->group(function () {
            Route::post('/logout',[LoginController::class,'logout']);
        });
    });
});

