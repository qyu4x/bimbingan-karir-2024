<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasienRegisterRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:100'],
            'nama' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_ktp' => ['required', 'max:16'],
            'no_hp' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }
}
