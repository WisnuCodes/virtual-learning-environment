@extends('layouts.app')

@section('content')
<div style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); display: flex; align-items: center; justify-content: center; padding: 40px 20px; font-family: 'Poppins', sans-serif; background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
    <div style="background: #fff; border: 4px solid #000; box-shadow: 15px 15px 0px 0px #ef4444; width: 600px; max-width: 100%; padding: 60px 40px; text-align: center; position: relative;">
        
        <div style="position: absolute; top: -30px; left: 50%; transform: translateX(-50%); width: 80px; height: 80px; background: #ef4444; color: #fff; border: 4px solid #000; display: flex; align-items: center; justify-content: center; font-size: 40px; box-shadow: 6px 6px 0px 0px #000;">
            <i class="fa-solid fa-hand"></i>
        </div>

        <div style="margin-top: 20px;">
            <h1 style="font-size: 120px; font-weight: 900; color: #000; line-height: 1; margin: 0; letter-spacing: -5px; position: relative;">
                403
                <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 20px; color: #ef4444; background: #fff; padding: 5px 15px; border: 3px solid #000; letter-spacing: 2px; text-transform: uppercase; white-space: nowrap;">Akses Ditolak</span>
            </h1>
            
            <div style="margin: 40px 0;">
                <p style="font-size: 18px; font-weight: 800; color: #000; text-transform: uppercase; letter-spacing: 1px; line-height: 1.4;">
                    {{ $exception->getMessage() ?: 'Aksi tidak diizinkan. Akses Admin diperlukan.' }}
                </p>
                <div style="width: 60px; height: 4px; background: #000; margin: 20px auto;"></div>
                <p style="font-size: 14px; color: #475569; font-weight: 600;">
                    Maaf, area ini merupakan zona terbatas. Identitas Anda tidak memiliki kredensial yang cukup untuk mengakses infrastruktur ini.
                </p>
            </div>

            <div style="display: flex; gap: 20px; justify-content: center;">
                <a href="{{ route('home') }}" style="flex: 1; background: #000; color: #fff; border: 3px solid #000; padding: 16px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px var(--accent-primary); transition: all 0.2s ease; text-decoration: none;" onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px var(--accent-primary)';" onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px var(--accent-primary)';">
                    <i class="fa-solid fa-house" style="margin-right: 10px;"></i> Beranda
                </a>
                <button onclick="history.back()" style="flex: 1; background: #fff; color: #000; border: 3px solid #000; padding: 16px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px #cbd5e1; transition: all 0.2s ease;" onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px #000';" onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px #cbd5e1';">
                    <i class="fa-solid fa-arrow-left" style="margin-right: 10px;"></i> Kembali
                </button>
            </div>
        </div>

        <div style="margin-top: 50px; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px;">
            RUANGKELAS. SECURE INFRASTRUCTURE &bull; 2026
        </div>
    </div>
</div>
@endsection
