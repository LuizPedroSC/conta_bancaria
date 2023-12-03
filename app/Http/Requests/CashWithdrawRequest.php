<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashWithdrawRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bank_number' => 'required|numeric',
            'account_number' => 'required|numeric',
            'branch_number' => 'required|numeric',
            'withdraw_value' => 'required|numeric|min:0.01'
        ];
    }
}
