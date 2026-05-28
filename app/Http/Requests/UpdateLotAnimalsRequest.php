<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLotAnimalsRequest extends FormRequest
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
        /*****VALIDAR INEXISTENTE  */
        return [
            'lot_number'        => 'required|numeric|min:1',
            'id_picket'         => 'required|exists:pickets,id',
            'lot_description'   => 'nullable|string|max:255',
            'origin'            => 'nullable|string|max:255',
            'entry_date'        => 'nullable|date',
            'quantity_animals'  => 'nullable|integer|min:0',
            'average_weight'    => 'nullable|decimal:0,9999.99',
            'destination'       => 'nullable|string|max:255',
            'exit_date'         => 'nullable|date',
            'status'            => 'nullable|string|max:1',
        ];
    }
}
