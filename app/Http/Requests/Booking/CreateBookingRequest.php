<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isCustomer();
    }

    public function rules(): array
    {
        return [
            'vehicle_id'     => ['required', 'integer', 'exists:vehicles,id'],
            'start_date'     => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'end_date'       => ['required', 'date', 'date_format:Y-m-d', 'after:start_date'],
            'payment_method' => ['required', 'in:bank,qris'],
        ];
    }

    public function messages(): array
    {
        return [
            'vehicle_id.required'        => 'Kendaraan wajib dipilih.',
            'vehicle_id.exists'          => 'Kendaraan tidak ditemukan.',
            'start_date.required'        => 'Tanggal mulai sewa wajib diisi.',
            'start_date.after_or_equal'  => 'Tanggal mulai harus >= hari ini.',
            'end_date.required'          => 'Tanggal kembali wajib diisi.',
            'end_date.after'             => 'Durasi sewa minimal 1 hari. Tanggal kembali harus setelah tanggal mulai.',
            'payment_method.required'    => 'Metode pembayaran wajib dipilih.',
            'payment_method.in'          => 'Metode pembayaran tidak valid.',
        ];
    }
}
