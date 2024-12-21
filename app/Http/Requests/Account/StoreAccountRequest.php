<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'branch_id'           => 'required|numeric',
            'account_number'      => 'required|string|unique:accounts,account_number',
            'account_holder_name' => 'required|string',
            'is_default'          => 'required|numeric',
            'status'              => 'required|numeric',
            'note'                => 'nullable|string',
            'amount'              => 'required|string',
            'cheque_number'       => 'nullable|string'
        ];
    }
}
