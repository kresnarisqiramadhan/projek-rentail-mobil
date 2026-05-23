<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RatingController extends Controller
{
    public function vote(Request $request, Rating $rating): RedirectResponse
    {
        $user = auth()->user();
        $type = $request->input('type'); // 'like' atau 'dislike'

        if (!in_array($type, ['like', 'dislike'])) {
            return back()->with('error', 'Aksi tidak valid.');
        }

        $existingVote = $rating->votes()->where('user_id', $user->id)->first();

        if ($existingVote) {
            if ($existingVote->type === $type) {
                // Klik lagi tombol yang sama → hapus vote
                $existingVote->delete();
            } else {
                // Ganti jenis vote
                $existingVote->update(['type' => $type]);
            }
        } else {
            $rating->votes()->create([
                'user_id' => $user->id,
                'type' => $type,
            ]);
        }

        return back();
    }
}
