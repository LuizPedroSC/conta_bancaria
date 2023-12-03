<?php

namespace App\Repositories;

use App\Models\CashWithdraw;

class CashWithdrawRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new CashWithdraw());
    }
}