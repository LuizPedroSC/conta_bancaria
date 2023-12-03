<?php

namespace App\Services;

use App\Repositories\BankAccountRepository;
use App\DTO\BankAccountDTO;
use App\DTO\CashDepositDTO;
use App\DTO\CashWithdrawDTO;
use App\DTO\CashTransferDTO;
use App\DTO\ValueDTO;

class BankAccountService
{

    const ACTIVE_ACCOUNT_ACRONYMI = 'A';
    const ERROR_MESSAGE_ACCOUNT_NOT_FOUND = 'Conta bancaria não encontrada';
    const ERROR_MESSAGE_ACCOUNT_IS_NOT_THE_USER = 'Conta não pertence ao usuário';
    const ERROR_MESSAGE_ACCOUNT_NOT_ACTIVE = 'Conta não está ativa';
    const ERROR_MESSAGE_MAKING_DEPOSIT = 'Falha ao realizar a operação';
    const ERROR_MESSAGE_BALANCE_VALUE_INSUFFICIENT = 'Saldo em conta insuficiente';

    private $BankAccountRepository;

    public function __construct(){
        $this->UserSessionService = new UserSessionService();
        $this->BankAccountRepository = new BankAccountRepository();
    }
    
    public function findOrFailByBankAccount(array $conditonFind){
        $bankAccount = $this->findByBankAccount($conditonFind);
        if($bankAccount){
            return $bankAccount;
        }
        throw new \Exception(self::ERROR_MESSAGE_ACCOUNT_NOT_FOUND);
    }

    public function findByBankAccount(array $conditonFind){
        return $this->BankAccountRepository->findByFirst($conditonFind);
    }  

    public function getConditionFind(BankAccountDTO $bankAccount){
        return [
            'bank_number' => $bankAccount->getBankNumber(), 
            'branch_number' => $bankAccount->getBranchNumber(), 
            'account_number' => $bankAccount->getAccountNumber()
        ];
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

    public function depositValue(BankAccountDTO $BankAccountDTO, ValueDTO $ValueDTO){
        $depositWithBalance = $this->depositAmountIntoAccount($BankAccountDTO->getBalance(), $ValueDTO->getValue());
        $this->updateBalance($BankAccountDTO, $depositWithBalance);
    }

    private function updateBalance(BankAccountDTO $BankAccountDTO, float $value){
        $updateBalance = $this->BankAccountRepository->updateBalance($BankAccountDTO, $value);
        $this->validUpdateBalance($updateBalance);
    }

    private function depositAmountIntoAccount(float $balance, float $value){
        return $balance + $value;
    }

    private function validUpdateBalance($updateBalance){
        if(!$updateBalance){
            throw new \Exception(self::ERROR_MESSAGE_MAKING_DEPOSIT);
        }
    }

    public function validWithdrawValue(float $balance_value, float $withdraw_value){
        $this->insufficientBalanceWthdrawal($balance_value, $withdraw_value);
    }

    private function insufficientBalanceWthdrawal($balance_value, float $withdraw_value){
        if($withdraw_value > $balance_value){
            throw new \Exception(self::ERROR_MESSAGE_BALANCE_VALUE_INSUFFICIENT);
        }
    }

    public function withdrawValue(BankAccountDTO $BankAccountDTO, ValueDTO $ValueDTO){
        $withdrawWithBalance = $this->withdrawAmountIntoAccount($BankAccountDTO->getBalance(), $ValueDTO->getValue());
        $this->updateBalance($BankAccountDTO, $withdrawWithBalance);
    }

    private function withdrawAmountIntoAccount(float $balance, float $value){
        return $balance - $value;
    }

    public function validTransferSenderValue(float $balance_value, float $withdraw_value){
        $this->insufficientBalanceWthdrawal($balance_value, $withdraw_value);
    }

    public function transferValue(BankAccountDTO $BankAccountSenderDTO, BankAccountDTO $BankAccountRecipientDTO, ValueDTO $ValueDTO){
        $this->withdrawValue($BankAccountSenderDTO, $ValueDTO);
        $this->depositValue($BankAccountRecipientDTO, $ValueDTO);
    }
}