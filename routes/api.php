<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashDepositController;
use App\Http\Controllers\CashWithdrawController;
use App\Http\Controllers\CashTransferController;

Route::middleware('auth.jwt')->group(function () {
    Route::post('/deposit', [CashDepositController::class, 'deposit']);
    Route::post('/withdraw', [CashWithdrawController::class, 'withdraw']);
    Route::post('/transfer', [CashTransferController::class, 'transfer']);    
});
