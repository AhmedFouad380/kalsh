<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|max:12|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:6|confirmed',
            'device_token' => 'nullable',
        ];
    }
}
