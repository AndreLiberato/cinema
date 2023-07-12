<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilmeUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['string', 'required', 'max:64', Rule::unique('filme', 'titulo')->ignore($this->input('titulo'), 'titulo')],
            'diretor' => ['string', 'required', 'max:128'],
            'genero' => ['string', 'required', 'max:32'],
            'classificacao_indicativa' => ['string', 'required', 'max:32'],
            'duracao' => ['required'],
            'sinopse' => ['string', 'required', 'max:1500'],
            'copyrights' => ['string', 'required', 'max:32']
        ];
    }
}
