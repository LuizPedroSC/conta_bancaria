<?php

namespace App\Services;

use App\DTO\CashWithdrawDTO;
use Illuminate\Support\Facades\Session;
use App\Repositories\CashWithdrawRepository;

class CashWithdrawService
{
    private $BankAccountService;

    public function __construct(){
        $this->BankAccountService = new BankAccountService();
        $this->CashWithdrawRepository = new CashWithdrawRepository();
    }

    public function withdraw(CashWithdrawDTO $CashWithdraw){
        $conditionFind = $this->BankAccountService->getConditionFind($CashWithdraw->banck_account_cash_withdraw);
        $banckAccountCashWithdraw = $this->BankAccountService->findOrFailByBankAccount($conditionFind);
        $CashWithdraw->banck_account_cash_withdraw->setAll($banckAccountCashWithdraw);

        $this->BankAccountService->validBelongsToUser($CashWithdraw->banck_account_cash_withdraw->getUserId());
        $this->BankAccountService->validAccountStatusActive($CashWithdraw->banck_account_cash_withdraw->getAccountStatus());
        $this->BankAccountService->validWithdrawValue($CashWithdraw->banck_account_cash_withdraw->getBalance(), $CashWithdraw->value_withdraw->getValue());
        $this->BankAccountService->withdrawValue($CashWithdraw->banck_account_cash_withdraw, $CashWithdraw->value_withdraw);
        
        $dataInsertion = $this->prepareDataForInsertion($CashWithdraw);
        $this->CashWithdrawRepository->create($dataInsertion);
    }

    private function prepareDataForInsertion(CashWithdrawDTO $CashWithdraw){
        return [
            'bank_number' =>  $CashWithdraw->banck_account_cash_withdraw->getBankNumber(),
            'branch_number' =>   $CashWithdraw->banck_account_cash_withdraw->getBranchNumber(),
            'account_number' =>   $CashWithdraw->banck_account_cash_withdraw->getAccountNumber(),
            'user_id' =>   $CashWithdraw->banck_account_cash_withdraw->getUserId(),
            'withdraw_value' =>   $CashWithdraw->value_withdraw->getValue(),
        ];
    }
}