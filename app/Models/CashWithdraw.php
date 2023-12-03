<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashWithdraw extends BaseModelUUID
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'cash_withdraw';
    protected $keyType = 'string';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'bank_number',
        'branch_number',
        'account_number',
        'user_id',
        'withdraw_value'
    ];


}
