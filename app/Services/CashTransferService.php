<?php

namespace App\Services;

use App\DTO\CashTransferDTO;
use Illuminate\Support\Facades\Session;
use App\Repositories\CashTransferRepository;

class CashTransferService
{
    private $BankAccountService;
    private $CashTransferRepository;

    public function __construct(){
        $this->BankAccountService = new BankAccountService();
        $this->CashTransferRepository = new CashTransferRepository();
    }

    public function transfer(CashTransferDTO $CashTransfer){

        $conditionFindRecipient = $this->BankAccountService->getConditionFind($CashTransfer->banck_account_cash_transfer_recipient);
        $banckAccountCashTransferRecipient = $this->BankAccountService->findOrFailByBankAccount($conditionFindRecipient);
        $CashTransfer->banck_account_cash_transfer_recipient->setAll($banckAccountCashTransferRecipient);

        $conditionFindSender = $this->BankAccountService->getConditionFind($CashTransfer->banck_account_cash_transfer_sender);
        $banckAccountCashTransferSender = $this->BankAccountService->findOrFailByBankAccount($conditionFindSender);
        $CashTransfer->banck_account_cash_transfer_sender->setAll($banckAccountCashTransferSender);

        $this->BankAccountService->validBelongsToUser($CashTransfer->banck_account_cash_transfer_sender->getUserId());
        $this->BankAccountService->validAccountStatusActive($CashTransfer->banck_account_cash_transfer_sender->getAccountStatus());
        $this->BankAccountService->validTransferSenderValue($CashTransfer->banck_account_cash_transfer_sender->getBalance(), $CashTransfer->value_transfer->getValue());

        $this->BankAccountService->validAccountStatusActive($CashTransfer->banck_account_cash_transfer_recipient->getAccountStatus());

        $this->BankAccountService->transferValue($CashTransfer->banck_account_cash_transfer_sender, $CashTransfer->banck_account_cash_transfer_recipient, $CashTransfer->value_transfer);

        $dataInsertion = $this->prepareDataForInsertion($CashTransfer);
        $this->CashTransferRepository->create($dataInsertion);

    }

    private function prepareDataForInsertion(CashTransferDTO $CashTransfer){
        return [
            'user_id' => $CashTransfer->banck_account_cash_transfer_sender->getUserId(),
            'bank_number_sender' => $CashTransfer->banck_account_cash_transfer_sender->getBankNumber(),
            'branch_number_sender' => $CashTransfer->banck_account_cash_transfer_sender->getBranchNumber(),
            'account_number_sender' => $CashTransfer->banck_account_cash_transfer_sender->getAccountNumber(),
            'bank_number_recipient' => $CashTransfer->banck_account_cash_transfer_recipient->getBankNumber(),
            'branch_number_recipient' => $CashTransfer->banck_account_cash_transfer_recipient->getBranchNumber(),
            'account_number_recipient' => $CashTransfer->banck_account_cash_transfer_recipient->getAccountNumber(),
            'deposit_value' => $CashTransfer->value_transfer->getValue(), 
        ];
    }
}