<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'first_name' => 'regex:/^([^0-9]*)$/u',
            'last_name' => 'regex:/^([^0-9]*)$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:32',
        ];
    }
}
