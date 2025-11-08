<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'password' => ['nullable', 'string', 'min:3', 'max:255'],
            'current_password' => ['required', 'current_password'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto válido.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',

            'current_password.required' => 'Você precisa informar sua senha atual.',
            'current_password.current_password' => 'Senha inválida, informe a senha correta.',

            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O email deve ser um texto válido.',
            'email.email' => 'Informe um email válido.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este email já está sendo usado por outro usuário.',
        ];
    }
}
