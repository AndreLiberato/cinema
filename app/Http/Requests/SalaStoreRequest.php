<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'numero' => ['integer', 'required'],
            'tipo' => ['string', 'required', 'max:32'],
            'capacidade' => ['integer', 'required'],
            'cinema_id' => ['integer', 'required', 'exists:cinema,id']
        ];
    }
}
