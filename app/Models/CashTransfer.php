<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashTransfer extends BaseModelUUID
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'cash_transfer';
    protected $keyType = 'string';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'user_id',
        'bank_number_sender',
        'branch_number_sender',
        'account_number_sender',
        'bank_number_recipient',
        'branch_number_recipient',
        'account_number_recipient',
        'deposit_value'
    ];
}
