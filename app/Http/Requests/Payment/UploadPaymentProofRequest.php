<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UploadPaymentProofRequest
 * Enforces VR-06: JPG/JPEG/PNG/PDF, max 5 MB
 */
class UploadPaymentProofRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isCustomer();
    }

    public function rules(): array
    {
        return [
            'payment_proof' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf', // VR-06: whitelist formats
                'max:5120',               // VR-06: max 5 MB (5120 KB)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_proof.required' => 'Bukti pembayaran wajib diunggah.',
            'payment_proof.mimes'    => 'Format file tidak valid. Gunakan JPG, JPEG, PNG, atau PDF.',
            'payment_proof.max'      => 'Ukuran file maksimal 5 MB.',
        ];
    }
}
