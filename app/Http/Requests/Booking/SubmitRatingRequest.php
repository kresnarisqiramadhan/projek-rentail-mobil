<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class SubmitRatingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isCustomer();
    }

    public function rules(): array
    {
        return [
            'score'   => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'score.required' => 'Penilaian (bintang) wajib diisi.',
            'score.min'      => 'Penilaian minimal 1 bintang.',
            'score.max'      => 'Penilaian maksimal 5 bintang.',
        ];
    }
}
