<?php

namespace App\Services;

use App\Repositories\BankAccountRepository;
use App\DTO\BankAccountDTO;
use App\DTO\CashDepositDTO;
use App\Models\BankAccount;

class BankAccountService
{

    const ACTIVE_ACCOUNT_ACRONYMI = 'A';
    const ERROR_MESSAGE_ACCOUNT_NOT_FOUND = 'Conta bancaria não encontrada';
    const ERROR_MESSAGE_ACCOUNT_IS_NOT_THE_USER = 'Conta não pertence ao usuário';
    const ERROR_MESSAGE_ACCOUNT_NOT_ACTIVE = 'Conta não está ativa';
    const ERROR_MESSAGE_MAKING_DEPOSIT = 'Falha ao realizar a operação';

    private $BankAccountRepository;

    public function __construct(){
        $this->UserSessionService = new UserSessionService();
        $this->BankAccountRepository = new BankAccountRepository();
    }
    
    public function findOrFailByBankAccount(BankAccountDTO $bankAccount){
        $bankAccount = $this->findByBankAccount($bankAccount);
        if($bankAccount){
            return $bankAccount;
        }
        throw new \Exception(self::ERROR_MESSAGE_ACCOUNT_NOT_FOUND);
    }

    public function findByBankAccount(BankAccountDTO $bankAccount){
        return $this->BankAccountRepository->findByBankAccount($bankAccount);
    }  

    public function validBelongsToUser($user_id){
        if(!$this->UserSessionService->isUser($user_id)){
            throw new \Exception(self::ERROR_MESSAGE_ACCOUNT_IS_NOT_THE_USER);
        }
    }

    public function validAccountStatusActive($account_status){
        if(!$account_status == self::ACTIVE_ACCOUNT_ACRONYMI){
            throw new \Exception(self::ERROR_MESSAGE_ACCOUNT_NOT_ACTIVE);
        }
    }

    public function depositValue(CashDepositDTO $CashDepositDTO){
        $depositWithBalance = $this->depositAmountIntoAccount($CashDepositDTO);
        $updateBalance = $this->BankAccountRepository->updateBalance($CashDepositDTO->banck_account_cash_deposit, $depositWithBalance);
        $this->validUpdateBalance($updateBalance);
    }

    private function depositAmountIntoAccount(CashDepositDTO $CashDepositDTO){
        return $CashDepositDTO->banck_account_cash_deposit->getBalance() + $CashDepositDTO->value_deposit->getValue();
    }

    private function validUpdateBalance($updateBalance){
        if(!$updateBalance){
            throw new \Exception(self::ERROR_MESSAGE_MAKING_DEPOSIT);
        }
    }

}