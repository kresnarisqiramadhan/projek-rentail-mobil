<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class ModifyBookingDatesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isCustomer();
    }

    public function rules(): array
    {
        return [
            'start_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'end_date'   => ['required', 'date', 'date_format:Y-m-d', 'after:start_date'],
        ];
    }

    public function messages(): array
    {
        return [
            'start_date.after_or_equal' => 'Tanggal mulai harus >= hari ini.',
            'end_date.after'            => 'Durasi sewa minimal 1 hari. Tanggal kembali harus setelah tanggal mulai.',
        ];
    }
}
