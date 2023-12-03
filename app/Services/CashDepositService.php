<?php

namespace App\Services;

use App\DTO\CashDepositDTO;
use Illuminate\Support\Facades\Session;
use App\Repositories\CashDepositRepository;


class CashDepositService
{
    private $BankAccountService;
    private $CashDepositRepository;

    public function __construct(){
        $this->BankAccountService = new BankAccountService();
        $this->CashDepositRepository = new CashDepositRepository();
    }

    public function deposit(CashDepositDTO $CashDeposit){

        $conditionFind = $this->BankAccountService->getConditionFind($CashDeposit->banck_account_cash_deposit);

        $banckAccountCashDeposit = $this->BankAccountService->findOrFailByBankAccount($conditionFind);

        $CashDeposit->banck_account_cash_deposit->setAll($banckAccountCashDeposit);
        
        $this->BankAccountService->validBelongsToUser($CashDeposit->banck_account_cash_deposit->getUserId());
        $this->BankAccountService->validAccountStatusActive($CashDeposit->banck_account_cash_deposit->getAccountStatus());
        $this->BankAccountService->depositValue($CashDeposit->banck_account_cash_deposit, $CashDeposit->value_deposit);

        $dataInsertion = $this->prepareDataForInsertion($CashDeposit);
        $this->CashDepositRepository->create($dataInsertion);
    }

    private function prepareDataForInsertion(CashDepositDTO $CashDeposit){
        return [
            'bank_number' =>  $CashDeposit->banck_account_cash_deposit->getBankNumber(),
            'branch_number' =>   $CashDeposit->banck_account_cash_deposit->getBranchNumber(),
            'account_number' =>   $CashDeposit->banck_account_cash_deposit->getAccountNumber(),
            'user_id' =>   $CashDeposit->banck_account_cash_deposit->getUserId(),
            'deposit_value' =>   $CashDeposit->value_deposit->getValue(),
        ];
    }


}