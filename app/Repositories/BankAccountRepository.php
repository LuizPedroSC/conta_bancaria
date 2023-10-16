<?php

namespace App\Repositories;

use App\Models\BankAccount;
use App\DTO\BankAccountDTO;

class BankAccountRepository
{
    public function findByBankAccount(BankAccountDTO $bankAccountDetail, $columns = ['*']){
        return BankAccount::select($columns)
            ->where([
                'bank_number' => $bankAccountDetail->getBankNumber(), 
                'branch_number' => $bankAccountDetail->getBranchNumber(), 
                'account_number' => $bankAccountDetail->getAccountNumber()
            ])->first();
    }

    public function updateBalance(BankAccountDTO $bankAccountDetail, $value){
        return BankAccount::select(['bank_number', 'branch_number', 'account_number', 'balance'])
            ->where([
                'bank_number' => $bankAccountDetail->getBankNumber(), 
                'branch_number' => $bankAccountDetail->getBranchNumber(), 
                'account_number' => $bankAccountDetail->getAccountNumber()
            ])->update(['balance' => $value]);
    }
}