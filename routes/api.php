<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashDepositController;

Route::middleware('auth.jwt')->group(function () {
    Route::post('/deposit', [CashDepositController::class, 'deposit']);
    // Route::post('/deposit', [CashDepositController::class, 'deposit']);
    // Route::post('/deposit', [CashDepositController::class, 'deposit']);
});
