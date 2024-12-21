<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title'       => 'required|string',
            'address'     => 'required|string',
            'description' => 'required|string',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
