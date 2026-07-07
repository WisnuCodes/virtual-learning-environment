@extends('layouts.app')

@section('content')
<div style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1.2px, transparent 1.2px); background-size: 32px 32px;">
    <div style="max-width: 1300px; margin: 0 auto; padding: 40px 5%;">

        <!-- Header & Search Section -->
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; gap: 30px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <div style="display: inline-flex; align-items: center; gap: 8px; background: #000; color: #fff; padding: 6px 14px; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px; box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                    <i class="fa-solid fa-vault"></i> Database Pusat
                </div>
                <h1 style="font-size: 48px; font-weight: 900; color: #000; margin: 0; letter-spacing: -3px; text-transform: uppercase; line-height: 1;">
                    Direktori <span style="color: var(--accent-primary);">Sertifikat</span>
                </h1>
                <p style="color: #475569; font-size: 15px; font-weight: 600; margin-top: 10px; max-width: 500px;">
                    Otoritas verifikasi pusat untuk validasi keaslian sertifikat digital RuangKelas Academy.
                </p>
            </div>
            
            <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column; align-items: flex-end;">
                <form action="{{ route('admin.certificates') }}" method="GET" style="display: flex; gap: 0; width: 100%; max-width: 450px; position: relative;">
                    <div style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 18px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kode, Nama Siswa, atau Judul Kursus..." 
                        style="flex: 1; padding: 18px 20px 18px 50px; border: 4px solid #000; font-weight: 800; font-size: 14px; outline: none; box-shadow: 8px 8px 0px 0px #000; transition: 0.2s;"
                        onfocus="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='10px 10px 0px 0px var(--accent-primary)'"
                        onblur="this.style.transform='translate(0, 0)'; this.style.boxShadow='8px 8px 0px 0px #000'">
                    <button type="submit" style="display: none;">CARI</button>
                </form>
            </div>
        </div>

        <!-- Stats Bento Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-bottom: 50px;">
            <div style="background: #fff; border: 4px solid #000; padding: 30px; box-shadow: 10px 10px 0px 0px #000; position: relative; overflow: hidden;">
                <div style="font-size: 12px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Total Sertifikat</div>
                <div style="font-size: 42px; font-weight: 900; color: #000;">{{ sprintf('%03d', \App\Models\Certificate::count()) }}</div>
                <i class="fa-solid fa-file-contract" style="position: absolute; right: -15px; bottom: -15px; font-size: 100px; opacity: 0.05; transform: rotate(-15deg);"></i>
            </div>
            
            <div style="background: var(--accent-primary); border: 4px solid #000; padding: 30px; box-shadow: 10px 10px 0px 0px #000; position: relative; overflow: hidden;">
                <div style="font-size: 12px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Bulan Ini</div>
                <div style="font-size: 42px; font-weight: 900; color: #fff;">{{ sprintf('%03d', \App\Models\Certificate::whereMonth('created_at', now()->month)->count()) }}</div>
                <i class="fa-solid fa-chart-line" style="position: absolute; right: -15px; bottom: -15px; font-size: 100px; opacity: 0.2; transform: rotate(-15deg);"></i>
            </div>

            <div style="background: #fff; border: 4px solid #000; padding: 30px; box-shadow: 10px 10px 0px 0px #000; position: relative; overflow: hidden;">
                <div style="font-size: 12px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Status Sistem</div>
                <div style="display: flex; align-items: center; gap: 10px; font-size: 24px; font-weight: 900; color: #000; margin-top: 15px;">
                    <div style="width: 12px; height: 12px; background: #22c55e; border-radius: 50%; animation: pulse 2s infinite;"></div>
                    OPERASIONAL
                </div>
                <style>@keyframes pulse { 0% { transform: scale(1); opacity: 1; } 50% { transform: scale(1.5); opacity: 0.5; } 100% { transform: scale(1); opacity: 1; } }</style>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #ecfdf5; border: 3px solid #000; padding: 15px 20px; margin-bottom: 30px; font-weight: 700; color: #065f46; box-shadow: 6px 6px 0px 0px #000;">
                <i class="fa-solid fa-circle-check" style="margin-right: 10px;"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Main Data Table -->
        <div style="background: #fff; border: 4px solid #000; box-shadow: 15px 15px 0px 0px #000; overflow: hidden; border-radius: 4px;">
            <div style="padding: 20px; background: #f8fafc; border-bottom: 4px solid #000; display: flex; justify-content: space-between; align-items: center;">
                <div style="font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">Daftar Rekor Sertifikat</div>
                <div style="font-size: 11px; font-weight: 800; color: #64748b;">MENAMPILKAN {{ $certificates->count() }} DARI {{ $certificates->total() }} DATA</div>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #fff; border-bottom: 3px solid #000;">
                        <th style="padding: 20px; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; color: #000; width: 30%;">Informasi Siswa</th>
                        <th style="padding: 20px; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; color: #000; width: 30%;">Program Pelatihan</th>
                        <th style="padding: 20px; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; color: #000;">Identifikasi</th>
                        <th style="padding: 20px; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; color: #000; text-align: right;">Opsi Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certificates as $cert)
                        <tr style="border-bottom: 2px solid #e2e8f0; transition: 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 20px;">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div style="width: 42px; height: 42px; background: #000; color: #fff; border: 2px solid #000; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 16px; box-shadow: 3px 3px 0px 0px var(--accent-primary);">
                                        {{ substr($cert->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 800; color: #000; font-size: 15px; margin-bottom: 2px;">{{ $cert->user->name }}</div>
                                        <div style="font-size: 12px; color: #64748b; font-weight: 600;">{{ $cert->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 20px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <img src="{{ $cert->course->thumbnail }}" alt="Course" style="width: 50px; height: 35px; object-fit: cover; border: 2px solid #000;">
                                    <div>
                                        <div style="font-weight: 700; color: #000; font-size: 14px; line-height: 1.2;">{{ $cert->course->title }}</div>
                                        <div style="font-size: 10px; color: var(--accent-primary); font-weight: 800; text-transform: uppercase; margin-top: 4px;">Verified Academy</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 20px;">
                                <div style="background: #f1f5f9; border: 2px solid #000; padding: 8px 12px; display: inline-block;">
                                    <code style="font-weight: 900; color: #000; font-size: 13px;">{{ $cert->certificate_code }}</code>
                                </div>
                                <div style="font-size: 11px; color: #94a3b8; font-weight: 700; margin-top: 6px;">{{ $cert->created_at->format('M d, Y') }}</div>
                            </td>
                            <td style="padding: 20px; text-align: right;">
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <a href="{{ route('certificate.verify', $cert->certificate_code) }}" target="_blank" 
                                        style="background: var(--accent-primary); color: #fff; border: 2px solid #000; padding: 10px 18px; font-size: 11px; font-weight: 900; text-transform: uppercase; text-decoration: none; box-shadow: 4px 4px 0px 0px #000; display: inline-flex; align-items: center; gap: 8px; transition: 0.1s;"
                                        onmouseover="this.style.transform='translate(-1px, -1px)'; this.style.boxShadow='5px 5px 0px 0px #000'"
                                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='4px 4px 0px 0px #000'">
                                        AUDIT <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 80px; text-align: center;">
                                <div style="font-size: 18px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px;">
                                    <i class="fa-solid fa-database" style="display: block; font-size: 40px; margin-bottom: 15px;"></i>
                                    Rekor Tidak Ditemukan
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 40px; display: flex; justify-content: center;">
            {{ $certificates->links() }}
        </div>
    </div>
</div>
@endsection
