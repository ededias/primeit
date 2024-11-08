<?php

use App\Http\Controllers\JWTController;
use App\Http\Controllers\PatientController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [JWTController::class, 'register']);
Route::post('login', [JWTController::class, 'login']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user', [JWTController::class, 'getUser']);
    Route::post('logout', [JWTController::class, 'logout']);


    Route::group(['prefix' => 'patient'], function() {
        Route::post('create', [PatientController::class, 'create']);
        Route::get('get-doctors', [PatientController::class, 'getDoctors']);
        Route::put('update', [PatientController::class, 'update']);
        Route::get('get/{id}', [PatientController::class, 'get']);
        Route::get('all', [PatientController::class, 'all']);
        Route::delete('delete/{id}', [PatientController::class, 'delete']);
        Route::group(['prefix' => 'attendant', 'middleware' => ['role:attendant']], function () {
            Route::post('set-doctor', [PatientController::class, 'setDoctor']);
        });
       
    });

    

});
