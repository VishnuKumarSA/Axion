<?php

use App\Http\Controllers\EnterpiseSettingController;
use App\Http\Controllers\EnterprisesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgot_password']);
Route::post('/create-enterprise', [EnterprisesController::class, 'create']);
Route::post('/update-enterprise', [EnterprisesController::class, 'update']);
Route::post('/enterprise-status-update', [EnterprisesController::class, 'updateEnterpriseStatus']);
Route::post('/enterprise-setting-create', [EnterpiseSettingController::class, 'createSettings']);
Route::post('/enterprise-setting-update', [EnterpiseSettingController::class, 'updateSetting']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/refresh-token', [AuthController::class, 'refresh_token']);

Route::middleware('auth:sanctum')->post('/user-profile', [UserController::class, 'userProfile']);