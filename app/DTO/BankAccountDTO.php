<?php

namespace App\DTO;

class BankAccountDTO extends DTO
{
    private int $account_number;
    private int $branch_number;
    private int $bank_number;
    private string $account_type;
    private int $user_id;
    private float $balance;
    private $opening_date;
    private $account_status;

    public function __construct(array $data = []){
        $this->setAll($data);
    }

    public function setAll($data){
        $this->setAccountNumber($data['account_number'] ?? 0);
        $this->setBranchNumber($data['branch_number'] ?? 0);
        $this->setBankNumber($data['bank_number'] ?? 0);
        $this->setAccountType($data['account_type'] ?? '');
        $this->setUserId($data['user_id'] ?? 0);
        $this->setBalance($data['balance'] ?? 0);
        $this->setOpeningDate($data['opening_date'] ?? null);
        $this->setAccountStatus($data['account_status'] ?? null);
    }

    public function setAccountNumber($account_number){
        $this->account_number = $this->convertInteger($account_number);
    }

    public function setBranchNumber($branch_number){
        $this->branch_number = $this->convertInteger($branch_number);
    }

    public function setBankNumber($bank_number){
        $this->bank_number = $this->convertInteger($bank_number);
    }

    public function setAccountType(string $account_type){
        $this->account_type = $account_type;
    }

    public function setUserId($user_id){
        $this->user_id = $this->convertInteger($user_id);
    }

    public function setBalance($balance){
        $this->balance = $this->convertInteger($balance);
    }

    public function setOpeningDate($opening_date){
        $this->opening_date = $opening_date;
    }

    public function setAccountStatus($account_status){
        $this->account_status = $account_status;
    }

    public function getAccountNumber(){
        return $this->account_number;
    }

    public function getBranchNumber(){
        return $this->branch_number;
    }

    public function getBankNumber(){
        return $this->bank_number;
    }

    public function getAccountType(){
        return $this->account_type;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getBalance(){
        return $this->balance;
    }

    public function getOpeningDate(){
        return $this->opening_date;
    }

    public function getAccountStatus(){
        return $this->account_status;
    }

}