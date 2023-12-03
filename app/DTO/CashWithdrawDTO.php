<?php

namespace App\DTO;

class CashWithdrawDTO extends DTO
{
    public BankAccountDTO $banck_account_cash_withdraw;
    public ValueDTO $value_withdraw;

    public function __construct($data)
    {
        $this->banck_account_cash_withdraw = new BankAccountDTO($data);
        $this->value_withdraw = new ValueDTO($data['withdraw_value']);
    }
}