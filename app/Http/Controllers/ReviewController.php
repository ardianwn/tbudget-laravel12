<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Tourism;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Tourism $tourism)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10',
        ]);

        $review = $tourism->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'content' => $request->content,
        ]);

        // Update tourism average rating
        $averageRating = $tourism->reviews()->avg('rating');
        $tourism->update(['rating' => $averageRating]);

        return back()->with('success', 'Ulasan berhasil ditambahkan!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus ulasan ini.');
        }

        $tourism = $review->tourism;
        $review->delete();

        // Update tourism average rating
        $averageRating = $tourism->reviews()->avg('rating');
        $tourism->update(['rating' => $averageRating ?? 0]);

        return back()->with('success', 'Ulasan berhasil dihapus!');
    }
}
