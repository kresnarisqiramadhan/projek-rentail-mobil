<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = auth()->user()->loadCount(['orders', 'ratings']);
        return view('profile', compact('user'));
    }

    public function rentals(): View
    {
        $orders = auth()->user()->orders()
            ->with(['vehicle', 'vehicle.photos'])
            ->latest()
            ->paginate(10);

        return view('profile.rentals', compact('orders'));
    }

    public function favorites(): View
    {
        return view('profile.favorites');
    }

    public function settings(): View
    {
        return view('profile.settings', ['user' => auth()->user()]);
    }
}
