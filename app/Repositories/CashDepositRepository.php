<?php

namespace App\Repositories;

use App\Models\CashDeposit;

class CashDepositRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new CashDeposit());
    }
}