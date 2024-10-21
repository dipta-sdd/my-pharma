<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplyController;
use Illuminate\Support\Facades\Route;
use App\Models\Supplier;
use App\Models\Supply;

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return view('home');
});

Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return view('dashboard');
});


// Route::get('/supply', [SupplyController::class, 'show']);
Route::get('/supply', function (SupplyController $supplyController) {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return $supplyController->show(request());
});


// Route::get('/supplys', [SupplyController::class, 'all']);
Route::get('/supplys', function (SupplyController $supplyController) {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return $supplyController->all(request());
});


// Route::post('/create-supply', [SupplyController::class, 'create']);
Route::post('/create-supply', function (SupplyController $supplyController) {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return $supplyController->create(request());
});


Route::get('/login', function () {
    return view('/login');
});
