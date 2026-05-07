<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    // ── Register ─────────────────────────────────────────

    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * FR-A01: Register customer
     * VR-07: email unique + valid format (enforced in RegisterRequest)
     * FR-A04: password policy (enforced in RegisterRequest)
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // NFR-SEC-03: Bcrypt
            'role'     => UserRole::CUSTOMER,
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat!');
    }

    // ── Login ─────────────────────────────────────────────

    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * FR-A02: Login
     * Error message must NOT specify which field is wrong (TC-A02-03)
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Kredensial tidak valid.'])->onlyInput('email');
        }

        $user = Auth::user();

        // FR-F03, BRL-17: Block inactive accounts
        if (!$user->is_active) {
            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda telah dinonaktifkan. Hubungi admin untuk informasi lebih lanjut.']);
        }

        $request->session()->regenerate();

        // FR-A02: Redirect by role
        if ($user->isAdmin()) {
            return redirect()->intended(route('filament.admin.pages.dashboard'));
        }

        return redirect()->intended(route('home'));
    }

    // ── Logout ────────────────────────────────────────────

    /**
     * FR-A06: Logout — invalidate session
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // ── Profile ───────────────────────────────────────────

    /**
     * FR-A05: View/Update profile
     */
    public function profile(): View
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = Auth::user();
        $data = ['name' => $validated['name']];

        if ($request->hasFile('profile_photo')) {
            $path          = $request->file('profile_photo')->store('profile_photos', 'public');
            $data['profile_photo'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
