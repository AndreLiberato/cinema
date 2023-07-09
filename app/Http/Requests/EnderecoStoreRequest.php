<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnderecoStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'estado' => ['string', 'required', 'max:32'],
            'cidade' => ['string', 'required', 'max:64'],
            'rua' => ['string', 'required', 'max:128'],
            'numero' => ['integer', 'required'],
            'cinema_id' => ['numeric', 'integer', 'sometimes', 'exists:cinema,id']
        ];
    }
}
