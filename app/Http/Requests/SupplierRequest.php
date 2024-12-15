<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'document' => 'required|string|max:14',
            'phone' => 'required|string|max:30',
            'street' => 'required|string|max:255',
            'number' => 'required|numeric',
            'district' => 'required|string|max:255',
            'mailcode' => 'required|string|max:255',
            'complement' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'country' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.string' => 'O campo Nome deve ser um texto.',
            'name.max' => 'O campo Nome deve ter no máximo 255 caracteres.',

            'email.required' => 'O campo E-mail é obrigatório.',
            'email.string' => 'O campo E-mail deve ser um texto.',
            'email.max' => 'O campo E-mail deve ter no máximo 255 caracteres.',

            'document.required' => 'O campo Documento é obrigatório.',
            'document.string' => 'O campo Documento deve ser um texto.',
            'document.max' => 'O campo Documento deve ter no máximo 14 caracteres.',

            'phone.required' => 'O campo Telefone é obrigatório.',
            'phone.string' => 'O campo Telefone deve ser um texto.',
            'phone.max' => 'O campo Telefone deve ter no máximo 30 caracteres.',

            'street.required' => 'O campo Rua é obrigatório.',
            'street.string' => 'O campo Rua deve ser um texto.',
            'street.max' => 'O campo Rua deve ter no máximo 255 caracteres.',

            'number.required' => 'O campo Número é obrigatório.',
            'number.numeric' => 'O campo Número deve ser numérico.',

            'district.required' => 'O campo Bairro é obrigatório.',
            'district.string' => 'O campo Bairro deve ser um texto.',
            'district.max' => 'O campo Bairro deve ter no máximo 255 caracteres.',

            'mailcode.required' => 'O campo CEP é obrigatório.',
            'mailcode.string' => 'O campo CEP deve ser um texto.',
            'mailcode.max' => 'O campo CEP deve ter no máximo 255 caracteres.',

            'complement.string' => 'O campo Complemento deve ser um texto.',
            'complement.max' => 'O campo Complemento deve ter no máximo 255 caracteres.',

            'city.required' => 'O campo Cidade é obrigatório.',
            'city.string' => 'O campo Cidade deve ser um texto.',
            'city.max' => 'O campo Cidade deve ter no máximo 255 caracteres.',

            'state.required' => 'O campo Estado é obrigatório.',
            'state.string' => 'O campo Estado deve ser um texto.',
            'state.max' => 'O campo Estado deve ter no máximo 2 caracteres.',

            'country.required' => 'O campo País é obrigatório.',
            'country.string' => 'O campo País deve ser um texto.',
            'country.max' => 'O campo País deve ter no máximo 255 caracteres.',
        ];
    }
}
