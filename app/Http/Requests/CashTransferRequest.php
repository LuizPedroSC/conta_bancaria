<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashTransferRequest extends FormRequest
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
            'bank_number_recipient' => 'required|numeric',
            'account_number_recipient' => 'required|numeric',
            'branch_number_recipient' => 'required|numeric',
            'bank_number_sender' => 'required|numeric',
            'account_number_sender' => 'required|numeric',
            'branch_number_sender' => 'required|numeric',
            'transfer_value' => 'required|numeric|min:0.01'
        ];
    }
}
