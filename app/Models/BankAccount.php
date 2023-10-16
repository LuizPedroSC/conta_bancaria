<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankAccount extends BaseModelUUID
{
    use HasFactory;

    protected $primaryKey = ['account_number', 'branch_number', 'bank_number'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'account_number',
        'branch_number',
        'bank_number',
        'account_type',
        'user_id',
        'balance',
        'opening_date',
        'account_status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
