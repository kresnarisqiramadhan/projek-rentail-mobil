<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * RegisterRequest — VR-07, FR-A01, FR-A04
 */
class RegisterRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // VR-07
            'password'              => [
                'required',
                'string',
                'min:8',                    // FR-A04: min 8 chars
                'regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/', // FR-A04: must contain letter + number
                'confirmed',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'        => 'Email sudah digunakan.',
            'email.email'         => 'Format email tidak valid.',
            'password.min'        => 'Password minimal 8 karakter.',
            'password.regex'      => 'Password harus kombinasi huruf dan angka.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
        ];
    }
}
