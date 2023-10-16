<?php

namespace Tests\Feature\Deposit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CashDepositRequest;
use Tests\Feature\BaseTest;

class CashDepositRequestTest extends BaseTest
{
    public function __construct()
    {
        parent::__construct();
        $this->CashDepositRequest = new CashDepositRequest();
    }

    public function testAuthorization()
    {
        $this->assertTrue($this->CashDepositRequest->authorize());
    }

    public function testValidData()
    {

        $valid_data = [
            'bank_number' => 123456,
            'account_number' => 789012,
            'branch_number' => 456789,
            'deposit_value' => 100.00,
        ];

        $validator = Validator::make($valid_data, $this->CashDepositRequest->rules());
        $this->assertTrue($validator->passes());
    }

    public function testInvalidDataBankNumber()
    {
        $invalid_data = [
            'bank_number' => 'ABC',
            'account_number' => 789012,
            'branch_number' => 456789,
            'deposit_value' => 100.00,
        ];

        $invalidValidator = Validator::make($invalid_data, $this->CashDepositRequest->rules());

        $this->assertFalse($invalidValidator->passes());
    }

    public function testInvalidDataAccountNumber()
    {
        $invalid_data = [
            'bank_number' => 123456,
            'account_number' => 'ABC',
            'branch_number' => 456789,
            'deposit_value' => 100.00,
        ];

        $invalidValidator = Validator::make($invalid_data, $this->CashDepositRequest->rules());

        $this->assertFalse($invalidValidator->passes());
    }

    public function testInvalidDataBranchNumber()
    {
        $invalid_data = [
            'bank_number' => 123456,
            'account_number' => 789012,
            'branch_number' => 'ABC',
            'deposit_value' => 100.00,
        ];

        $invalidValidator = Validator::make($invalid_data, $this->CashDepositRequest->rules());

        $this->assertFalse($invalidValidator->passes());
    }

    public function testInvalidDataDepositValue0()
    {
        $invalid_data = [
            'bank_number' => 123456,
            'account_number' => 789012,
            'branch_number' => 456789,
            'deposit_value' => 0.00,
        ];

        $invalidValidator = Validator::make($invalid_data, $this->CashDepositRequest->rules());

        $this->assertFalse($invalidValidator->passes());
    }

    public function testInvalidDataDepositValueNull()
    {
        $invalid_data = [
            'bank_number' => 123456,
            'account_number' => 789012,
            'branch_number' => 456789,
            'deposit_value' => null,
        ];

        $invalidValidator = Validator::make($invalid_data, $this->CashDepositRequest->rules());

        $this->assertFalse($invalidValidator->passes());
    }
}
