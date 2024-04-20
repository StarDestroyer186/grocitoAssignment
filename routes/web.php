<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PincodeController;

Route::get('/', function(){
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [UserController::class, 'authenticate']);

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [UserController::class, 'register']);

Route::get('/verify', function () {
    return view('verify');
});

Route::post('/verify', [UserController::class, 'verify']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index']);
    Route::post('/customer', [CustomerController::class, 'store']);
    Route::get('/customer/{id}', [CustomerController::class, 'edit']);
    Route::put('/customer/{id}', [CustomerController::class, 'update']);
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    Route::get('/state', [StateController::class, 'index']);
    Route::post('/state', [StateController::class, 'store']);
    Route::get('/state/{id}', [StateController::class, 'edit']);
    Route::put('/state/{id}', [StateController::class, 'update']);
    Route::delete('/state/{id}', [StateController::class, 'destroy'])->name('state.destroy');

    Route::get('/cities/{id}', [CityController::class, 'index']);
    Route::post('/city', [CityController::class, 'store']);
    Route::get('/city/{id}', [CityController::class, 'edit']);
    Route::put('/city/{id}', [CityController::class, 'update']);
    Route::delete('/city/{id}', [CityController::class, 'destroy'])->name('city.destroy');

    Route::get('/pincodes/{id}', [PincodeController::class, 'index']);
    Route::post('/pincode', [PincodeController::class, 'store']);
    Route::get('/pincode/{id}', [PincodeController::class, 'edit']);
    Route::put('/pincode/{id}', [PincodeController::class, 'update']);
    Route::delete('/pincode/{id}', [PincodeController::class, 'destroy'])->name('pincode.destroy');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
