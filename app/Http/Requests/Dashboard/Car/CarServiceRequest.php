<?php

namespace App\Http\Requests\Dashboard\Car;

use App\Models\CarService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarServiceRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:car_services,id',
            'cost' => 'required|numeric|min:0',
            'distance_cost' => 'required|numeric|min:0',
            'type' => ['required', Rule::in(CarService::TYPE)],
        ];
    }
}
