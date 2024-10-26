<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SupplyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
Route::middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/cccc', [AuthController::class, 'cccc'])->middleware('auth:sanctum');
    // ... other API routes that require session state ...
    Route::get('/supply/available-products/{id}', [SupplyController::class, 'availableProducts']);
    Route::get('/product/strength/{id}', [GeneralController::class, 'strengthByProduct']);
    Route::post('/supply/batch/add', [SupplyController::class, 'addProdToBatch']);

    // branch
    Route::post('/branches/edit/{id}', [BranchController::class, 'update']);
});