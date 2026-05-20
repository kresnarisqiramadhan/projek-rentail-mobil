<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            Auth::login($user);
            return redirect()->intended(route('home'));
        }

        $newUser = User::create([
            'name'      => $googleUser->getName(),
            'email'     => $googleUser->getEmail(),
            'password'  => Hash::make(Str::random(32)),
            'role'      => UserRole::CUSTOMER,
            'is_active' => true,
            'google_id' => $googleUser->getId(),
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun Google berhasil didaftarkan. Silakan login menggunakan Google atau email.');
    }
}
