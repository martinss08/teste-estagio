<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|min:3|max:150',
            'descricao' => 'max:255',
            'status_id' => 'required|exists:tarefa_status,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.min'      => 'O título deve ter no mínimo 3 caracteres.',
            'titulo.max'      => 'O título não pode ter mais que 255 caracteres.',

            'descricao.max'   => 'A descrição não pode ter mais que 250 caracteres.',
        
            'status_id.required' => 'Por favor, selecione o satus'
        ];
    }
}
