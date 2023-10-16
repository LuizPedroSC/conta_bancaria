<?php

namespace Tests\Feature\Deposit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\BaseTest;
use Illuminate\Support\Facades\Artisan;

class CashDepositControllerTest extends BaseTest
{

    const ROUTE_DEPOSIT = '/api/deposit';
    const BANK_NUMBER_TEST = 10;
    const ACCOUNT_NUMBER_TEST = 65485;
    const BRANCH_NUMBER_TEST = 258;
    const DEPOSIT_VALUE_TEST = 100.00;

    const SUCCESS_MESSAGE =  'Deposito realizado com sucesso';

    public function test_example()
    {
        Artisan::call('db:seed', [
            '--class' => 'BankAccountSeed',
        ]);

        $data = [
            'bank_number' => self::BANK_NUMBER_TEST,
            'account_number' => self::ACCOUNT_NUMBER_TEST,
            'branch_number' => self::BRANCH_NUMBER_TEST,
            'deposit_value' => self::DEPOSIT_VALUE_TEST,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getTokenApiTest(),
        ])->post(self::ROUTE_DEPOSIT, $data);

        $response->assertStatus(200);
        $response->assertSee(self::SUCCESS_MESSAGE);
    }
}
