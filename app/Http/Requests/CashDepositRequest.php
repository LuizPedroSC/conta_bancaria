<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashDepositRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'bank_number' => 'required|numeric',
            'account_number' => 'required|numeric',
            'branch_number' => 'required|numeric',
            'deposit_value' => 'required|numeric|min:0.01'
        ];
    }
}
