<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    /**
     * Pastikan hanya admin yang dapat mengakses controller ini.
     */
    private function checkRole()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Aksi tidak diizinkan. Akses Admin diperlukan.');
        }
    }

    public function index()
    {
        $this->checkRole();
        $siteLogo = Setting::where('key', 'site_logo')->first();
        return view('admin.settings.index', compact('siteLogo'));
    }

    public function update(Request $request)
    {
        $this->checkRole();

        $request->validate([
            'site_logo' => 'nullable|file|max:2048', // Ditambahkan 'file' untuk keamanan ekstra
        ]);

        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            
            // Pastikan direktori tujuan ada (penting untuk server Windows/Laragon)
            $destinationPath = public_path('storage/logos');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $filename = 'site_logo_' . time() . '.' . $file->getClientOriginalExtension();

            // Gunakan move() untuk menghindari ketergantungan pada ekstensi 'fileinfo' PHP
            $file->move($destinationPath, $filename);
            $logoUrl = asset('storage/logos/' . $filename);

            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $logoUrl]
            );
        }

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}
