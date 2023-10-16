<?php

namespace App\DTO;

class CashDepositDTO extends DTO{

    public BankAccountDTO $banck_account_cash_deposit;
    public ValueDTO $value_deposit;

    public function __construct($data)
    {
        $this->banck_account_cash_deposit = new BankAccountDTO($data);
        $this->value_deposit = new ValueDTO($data['deposit_value']);
    }

}