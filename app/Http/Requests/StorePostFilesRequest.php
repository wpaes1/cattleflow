<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostFilesRequest extends FormRequest
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
            'id_post'         => 'required|exists:animal_posts,id',
            'path'            => 'nullable|string|max:255',
            'type'            => 'nullable|string|max:1|in:I,V,A', // I para imagem, V para vídeo, Audio
        ];
    }
}
