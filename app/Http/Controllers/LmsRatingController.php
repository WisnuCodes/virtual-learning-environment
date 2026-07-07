<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LmsRating;
use Illuminate\Support\Facades\Auth;

class LmsRatingController extends Controller
{
    public function index()
    {
        $lmsRatings = LmsRating::with('user')->latest()->paginate(20);
        $avgLmsRating = LmsRating::avg('rating') ?: 0;
        $totalLmsRatings = LmsRating::count();
        
        return view('lms-ratings.index', compact('lmsRatings', 'avgLmsRating', 'totalLmsRatings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        LmsRating::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return back()->with('success_rating', 'Terima kasih atas penilaian Anda terhadap platform kami!');
    }

    public function destroy(LmsRating $lmsRating)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus penilaian.');
        }

        $lmsRating->delete();

        return back()->with('success', 'Penilaian berhasil dihapus.');
    }
}
