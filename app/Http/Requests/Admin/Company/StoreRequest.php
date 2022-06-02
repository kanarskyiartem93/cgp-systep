<?php

namespace App\Http\Requests\Admin\Company;

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
            'name' => 'required|string|min:2|max:256|unique:companies',
            'address' => 'required|string|min:10|max:256',
            'city' => 'required|string|min:2|max:256',
            'country' => 'required|string|min:2|max:256',
            'phone' => ['required', 'regex:/^\+[0-9]{10,12}/'],
            'clients' => 'nullable|array',
            'clients.*' => 'nullable|integer|exists:clients,id',
        ];
    }
}
