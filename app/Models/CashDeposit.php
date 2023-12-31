<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashDeposit extends BaseModelUUID
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'cash_deposits';
    protected $keyType = 'string';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'bank_number',
        'branch_number',
        'account_number',
        'user_id',
        'deposit_value'
    ];
}
