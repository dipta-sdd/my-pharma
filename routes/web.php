<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\UserController;
use App\Models\Branch;
use Illuminate\Support\Facades\Route;
use App\Models\Supplier;
use App\Models\Supply;

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return view('pos');
});


Route::get('/login', function () {
    return view('/login');
});
Route::get('/tmp', function () {
    return view('/tmp');
});
Route::get('/tmp2', function () {
    return view('/tmp2');
});
// sidebar

Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return view('home');
});

// supply
// all supply
Route::get('/supplys', function (SupplyController $supplyController) {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return $supplyController->all(request());
});
// create supply
Route::post('/create-supply', function (SupplyController $supplyController) {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return $supplyController->create(request());
});
// view a single supply
// Route::get('/supply', [SupplyController::class, 'show']);
Route::get('/supply', function (SupplyController $supplyController) {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return $supplyController->show(request());
});


// branche
// all branche
Route::get('/branches', function (BranchController $branchController) {
    if (!auth()->check()) {
        return redirect('/login');
    } else {
        if (auth()->user()->role != 'admin' && auth()->user()->role != 'manager') {
            return redirect('/dashboard');
        }
        return $branchController->allBranch(request());
    }
});
// export branche
Route::get('/export/branches', function (ExportController $exportController) {
    if (!auth()->check()) {
        return redirect('/login');
    } else {
        if (auth()->user()->role != 'admin' && auth()->user()->role != 'manager') {
            return redirect('/dashboard');
        }
        return $exportController->branchExport(request());
    }
});

// create branche
Route::post('/branches/create', function (BranchController $branchController) {
    if (!auth()->check()) {
        return redirect('/login');
    } else {
        if (auth()->user()->role != 'admin' && auth()->user()->role != 'manager') {
            return redirect('/dashboard');
        }
        return $branchController->create(request());
    }
});
// users
Route::get('/users', function (UserController $userController) {
    if (!auth()->check()) {
        return redirect('/login');
    }
    return $userController->index(request());
});