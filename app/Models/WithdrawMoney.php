<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class WithdrawMoney extends BaseModelUUID
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id'; 


}
