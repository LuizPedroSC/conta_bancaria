<?php

namespace App\Services;

use App\DTO\CashDepositDTO;
use Illuminate\Support\Facades\Session;


class CashDepositService
{
    private $BankAccountService;

    public function __construct(){
        $this->BankAccountService = new BankAccountService();
    }

    public function deposit(CashDepositDTO $cashDeposit){

        $banckAccountCashDeposit = $this->BankAccountService->findOrFailByBankAccount($cashDeposit->banck_account_cash_deposit);

        $cashDeposit->banck_account_cash_deposit->setAll($banckAccountCashDeposit);
        
        $this->BankAccountService->validBelongsToUser($cashDeposit->banck_account_cash_deposit->getUserId());
        $this->BankAccountService->validAccountStatusActive($cashDeposit->banck_account_cash_deposit->getAccountStatus());
        $this->BankAccountService->depositValue($cashDeposit);
        
    }


}