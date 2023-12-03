<?php

namespace App\DTO;

class CashTransferDTO extends DTO
{
    public BankAccountDTO $banck_account_cash_transfer_recipient;
    public BankAccountDTO $banck_account_cash_transfer_sender;
    public ValueDTO $value_transfer;

    public function __construct($data)
    {
        $array_key_recipient = ['bank_number_recipient', 'account_number_recipient', 'branch_number_recipient'];
        $array_key_sender = ['bank_number_sender', 'account_number_sender', 'branch_number_sender'];

        $map_key_recipient = [
            'bank_number_recipient' => 'bank_number', 
            'account_number_recipient' => 'account_number', 
            'branch_number_recipient' => 'branch_number'
        ];

        $map_key_sender = [
            'bank_number_sender' => 'bank_number', 
            'account_number_sender' => 'account_number', 
            'branch_number_sender' => 'branch_number'
        ];

        $data_recipient = $this->extractValuesByKeys($data, $array_key_recipient);
        $data_sender = $this->extractValuesByKeys($data, $array_key_sender);

        $data_recipient_renamed = $this->renameKeysArray($data_recipient, $map_key_recipient);
        $data_sender_renamed = $this->renameKeysArray($data_sender, $map_key_sender);
        

        $this->banck_account_cash_transfer_recipient = new BankAccountDTO($data_recipient_renamed);
        $this->banck_account_cash_transfer_sender = new BankAccountDTO($data_sender_renamed);
        $this->value_transfer = new ValueDTO($data['transfer_value']);
    }

    
}