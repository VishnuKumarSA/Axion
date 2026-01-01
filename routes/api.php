<?php

use App\Http\Controllers\EnterpiseSettingController;
use App\Http\Controllers\EnterprisesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgot_password']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::put('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

    Route::post('/create-enterprise', [EnterprisesController::class, 'create']);
    Route::post('/update-enterprise', [EnterprisesController::class, 'update']);
    Route::post('/enterprise-status-update', [EnterprisesController::class, 'updateEnterpriseStatus']);

    Route::post('/enterprise-setting-create', [EnterpiseSettingController::class, 'createSettings']);
    Route::post('/enterprise-setting-update', [EnterpiseSettingController::class, 'updateSetting']);

    Route::post('/user-profile', [UserController::class, 'userProfile']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
});