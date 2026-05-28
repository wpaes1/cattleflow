<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePicketRequest extends FormRequest
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
            'picket_description' => 'required|string|max:255',
            'id_farm' => 'required|exists:farms,id',
            'width' => 'nullable|numeric|min:0',
            'depth' => 'nullable|numeric|min:0',
        ];
    }
}
