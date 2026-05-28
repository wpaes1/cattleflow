<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalsRequest extends FormRequest
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
            'id_lot_animal'     => 'required|exists:lot_animals,id',
            'earring_number'    => 'nullable|string|max:10',
            'age'               => 'nullable|string|max:255',
            'sex'               => 'nullable|string|max:1|in:M,F',
            'entry_weight'      => 'nullable|decimal:0,9999.99',
            'breed'             => 'nullable|string|max:255',
            'sisbov_mapa_br'    => 'nullable|string|max:255',
            'status'            => 'nullable|string|max:1',
        ];
    }
}
