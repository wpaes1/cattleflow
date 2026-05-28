<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFarmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
           'farm_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state_registration' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'total_area' => 'nullable|numeric',
        ];
    }
}
