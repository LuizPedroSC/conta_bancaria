<?php

namespace App\Repositories;

use App\Models\CashTransfer;

class CashTransferRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new CashTransfer());
    }
}