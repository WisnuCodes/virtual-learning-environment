<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $banners = Banner::with('user')->latest()->get();
        } else {
            $banners = Banner::where('user_id', $user->id)->latest()->get();
        }
        
        $activeBanner = Banner::where('is_active', true)->first();
        
        return view('banners.index', compact('banners', 'activeBanner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'badge_text' => 'nullable|string|max:20',
            'emoji' => 'nullable|string|max:10',
            'title' => 'nullable|string|max:50',
            'button_text' => 'nullable|string|max:30',
            'button_link' => 'nullable|string', // Changed to string to allow relative routes
        ]);

        Banner::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'badge_text' => $request->badge_text ?: 'HOT!',
            'emoji' => $request->emoji ?: '🚨',
            'title' => $request->title ?: 'PERHATIAN:',
            'button_text' => $request->button_text ?: 'AMBIL SEKARANG',
            'button_link' => $request->button_link,
            'is_active' => false,
        ]);

        return back()->with('success', 'Banner berhasil dibuat.');
    }

    public function toggle(Banner $banner)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $banner->user_id !== $user->id) {
            abort(403);
        }

        if (!$banner->is_active) {
            // Matikan semua banner aktif lainnya
            Banner::where('is_active', true)->update(['is_active' => false]);
            $banner->is_active = true;
        } else {
            $banner->is_active = false;
        }

        $banner->save();

        return back()->with('success', 'Status banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $banner->user_id !== $user->id) {
            abort(403);
        }

        $banner->delete();
        return back()->with('success', 'Banner berhasil dihapus.');
    }
}
