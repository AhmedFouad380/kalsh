<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProviderRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:providers,email,' . $this->id,
            'phone' => 'required|min:8|unique:providers,phone,' . $this->id,
            'password' => ['nullable', 'confirmed', Rule::requiredIf($this->routeIs('providers.store'))],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg'],
        ];
    }
}
