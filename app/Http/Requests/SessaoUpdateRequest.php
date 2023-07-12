<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessaoUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'filme_id' => ['integer', 'required', 'exists:filme,id'],
            'sala_id' => ['integer', 'required', 'exists:sala,id'],
            'idioma_dublagem_id' => ['integer', 'required', 'exists:idioma,id'],
            'idioma_legenda_id' => ['integer', 'required', 'exists:idioma,id'],
            'data_hora_inicio' => ['required'],
            'data_hora_fim' => ['required']
        ];
    }
}
