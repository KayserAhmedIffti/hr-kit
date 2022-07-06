<?php

use Illuminate\Support\Facades\Route;
use SkylarkSoft\HoneyComb\Employee\Controllers\API\V1\PositionController;
use SkylarkSoft\HoneyComb\Employee\Controllers\API\V1\DepartmentController;
use SkylarkSoft\HoneyComb\Employee\Controllers\API\V1\LeaveController;
use SkylarkSoft\HoneyComb\Employee\Controllers\API\V1\HolidayController;
use SkylarkSoft\HoneyComb\Employee\Controllers\API\V1\EmployeeController;

use SkylarkSoft\HoneyComb\Employee\Controllers\API\V1\SystemSettingsController;
// Route::get('/api/auth', function () {
//     return 'hello';
// });

Route::group(['prefix' => '/api/v1/'], function () {
    Route::post('/positions',[PositionController::class,'store']);
    Route::get('/positions',[PositionController::class,'index']);
    Route::get('/positions/{id}',[PositionController::class,'show']);
    Route::put('/positions/{id}',[PositionController::class,'update']);
    Route::delete('/positions/{id}',[PositionController::class,'delete']);


    Route::post('/departments',[DepartmentController::class,'store']);
    Route::get('/departments',[DepartmentController::class,'index']);
    Route::get('/departments/{id}',[DepartmentController::class,'show']);
    Route::put('/departments/{id}',[DepartmentController::class,'update']);
    Route::delete('/departments/{id}',[DepartmentController::class,'delete']);


    Route::post('/holidays',[HolidayController::class,'store']);
    Route::get('/holidays',[HolidayController::class,'index']);
    Route::get('/holidays/{id}',[HolidayController::class,'show']);
    Route::put('/holidays/{id}',[HolidayController::class,'update']);
    Route::delete('/holidays/{id}',[HolidayController::class,'delete']);

    Route::post('/leaves',[LeaveController::class,'store']);
    Route::get('/leaves',[LeaveController::class,'index']);
    Route::get('/leaves/{id}',[LeaveController::class,'show']);
    Route::put('/leaves/{id}',[LeaveController::class,'update']);
    Route::delete('/leaves/{id}',[LeaveController::class,'delete']);

    Route::post('/employees',[EmployeeController::class,'store']);
    Route::get('/employees',[EmployeeController::class,'index']);
    Route::get('/employees/{id}',[EmployeeController::class,'show']);
    Route::put('/employees/{id}',[EmployeeController::class,'update']);
    Route::delete('/employees/{id}',[EmployeeController::class,'delete']);

    Route::post('/SystemSettings',[SystemSettingsController::class,'store']);
    Route::get('/SystemSettings',[SystemSettingsController::class,'index']);
    Route::get('/SystemSettings/{id}',[SystemSettingsController::class,'show']);
    Route::put('/SystemSettings/{id}',[SystemSettingsController::class,'update']);
    Route::delete('/SystemSettings/{id}',[SystemSettingsController::class,'delete']);

});

