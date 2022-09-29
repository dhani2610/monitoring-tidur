<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FitToWorkController;   
use App\Http\Controllers\StepRegisterController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController ::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('sendPasswordResetLink', [PasswordResetRequestController::class, 'sendEmail']);
    Route::post('resetPassword', [ChangePasswordController::class, 'passwordResetProcess']);

    // STEP 
    Route::post('step1', [StepRegisterController::class, 'step1']);
    Route::post('step2', [StepRegisterController::class, 'step2']);
    Route::post('step3', [StepRegisterController::class, 'step3']);

    // FIT TO WORK
    Route::post('tambah-fit-to-work', [FitToWorkController::class, 'store']);

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard']);
    Route::get('dashboard-admin', [DashboardController::class, 'dashboardAdmin']);


    
    // USER 
    Route::get('get-user', [AuthController::class, 'user']);
    

    
});

