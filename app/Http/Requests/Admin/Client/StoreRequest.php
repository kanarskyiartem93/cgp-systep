<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'first_name' => 'required|string|min:2|max:256',
            'last_name' => 'required|string|min:2|max:256',
            'email' => 'required|unique:clients|email',
            'phone' => ['required', 'regex:/^\+[0-9]{10,12}/'],
            'address' => 'required|string|min:10|max:256',
            'companies' => 'nullable|array',
            'companies.*' => 'nullable|integer|exists:companies,id',
        ];
    }
}
