<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVaccineAnimalsRequest extends FormRequest
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
            'trade_name'        => 'string|max:255',
            'stock_lot'         => 'nullable|string|max:255',
            'validity'          => 'nullable|date',
            'purchase_date'     => 'nullable|date',
            'manufacturer'      => 'nullable|string|max:255',
            'purpose'           => 'nullable|string|max:255',
            'dosage'            => 'nullable|string|max:255',
            'interval_days'     => 'nullable|string|max:255',
            'application_method' => 'nullable|string|max:255',
            'supplier_name'     => 'nullable|string|max:255',
            'path_tax_document' => 'nullable|string|max:255',
            'path_prescription' => 'nullable|string|max:255',
            'professional_name' => 'nullable|string|max:255',
            'professional_register_number' => 'nullable|string|max:255',
            'status'            => 'string|max:1|in:A,I', //active, inactive
        ];
    }
}
