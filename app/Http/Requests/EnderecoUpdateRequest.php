<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'id' => ['integer', 'required', 'exists:endereco,id'],
            'estado' => ['string', 'required', 'max:32'],
            'cidade' => ['string', 'required', 'max:64'],
            'rua' => ['string', 'required', 'max:128'],
            'numero' => ['integer', 'required'],
        ];
    }
}
