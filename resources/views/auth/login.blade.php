@extends('layouts.app')

@section('content')
    <style>
        body { overflow: hidden !important; }
        @media (max-width: 1024px) { body { overflow: auto !important; } }
    </style>
    <div class="auth-wrapper" style="height: calc(100vh - 73px);">
        <!-- Left Side: Information & Visuals -->
        <div class="auth-side-info">
            <div class="auth-info-content">
                <h1>Kuasai Keahlian Baru Bersama <span>RuangKelas.</span></h1>
                <p>Platform pembelajaran modern untuk mengasah potensi Anda dengan ribuan materi pilihan dari instruktur berpengalaman.</p>
                
                <div class="auth-feature-list">
                    <div class="auth-feature-item">
                        <i class="fa-solid fa-bolt"></i>
                        Akses Selamanya ke Materi Kursus
                    </div>
                    <div class="auth-feature-item">
                        <i class="fa-solid fa-certificate"></i>
                        Sertifikat Verifikasi Resmi
                    </div>
                    <div class="auth-feature-item">
                        <i class="fa-solid fa-users"></i>
                        Komunitas Pembelajar Aktif
                    </div>
                </div>

                <!-- Subtle Background Text -->
                <div
                    style="position: absolute; bottom: -50px; left: -20px; font-size: 150px; color: rgba(255,255,255,0.03); font-weight: 900; pointer-events: none; z-index: -1; transform: rotate(-5deg); white-space: nowrap;">
                    LEARN PRO
                </div>
            </div>
        </div>

        <!-- Right Side: The Form -->
        <div class="auth-side-form">
            <div class="auth-card">
                <div
                    style="position: absolute; top: -15px; left: 20px; background: #000; color: #fff; padding: 4px 12px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; border: 2px solid #000; box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                    <i class="fa-solid fa-lock" style="color: var(--accent-primary); margin-right: 6px;"></i> Keamanan
                </div>

                <h2>Masuk ke Akun</h2>
                <p class="subtitle">Silakan masukkan email dan kata sandi Anda.</p>

                @if ($errors->any())
                    <div
                        style="background: #fff; border: 3px solid #000; color: #e11d48; padding: 15px; margin-bottom: 25px; font-size: 12px; font-weight: 900; text-transform: uppercase; box-shadow: 4px 4px 0px 0px #e11d48; display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 18px;"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <a href="{{ route('auth.google.redirect') }}" class="btn-google-auth">
                    <i class="fa-brands fa-google"></i>
                    MASUK DENGAN GOOGLE
                </a>

                <div style="position: relative; text-align: center; margin: 10px 0;">
                    <hr style="border: none; border-top: 2px dashed #cbd5e1;">
                    <span
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; padding: 0 15px; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; white-space: nowrap;">
                        Atau gunakan email
                    </span>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="auth-input-group">
                        <label>Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="contoh@email.com">
                    </div>

                    <div class="auth-input-group" style="margin-bottom: 25px;">
                        <label>Kata Sandi</label>
                        <input type="password" name="password" required placeholder="••••••••••••">
                    </div>

                    <div class="auth-input-group" style="margin-bottom: 15px;">
                        <label>Verifikasi CAPTCHA</label>
                        <div style="display: flex; align-items: stretch; gap: 8px;">
                            <div style="position: relative; flex: 1; border: 2px solid #000; height: 40px; background: #fff; overflow: hidden;">
                                <img id="login-captcha-image" src="{{ route('login.captcha') }}?v={{ time() }}" alt="CAPTCHA"
                                    style="width: 100%; height: 100%; object-fit: cover; filter: contrast(110%);">
                                <button type="button" id="refresh-login-captcha"
                                    style="position: absolute; right: 0; top: 0; height: 100%; width: 35px; background: #000; color: var(--accent-primary); border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s;"
                                    onmouseover="this.style.background='var(--accent-primary)'; this.style.color='#000'"
                                    onmouseout="this.style.background='#000'; this.style.color='var(--accent-primary)'">
                                    <i class="fa-solid fa-rotate-right" style="font-size: 12px;"></i>
                                </button>
                            </div>
                            <input type="text" name="captcha" value="{{ old('captcha') }}" required autocomplete="off"
                                placeholder="KODE" 
                                style="width: 110px; margin-bottom: 0; text-align: center; font-weight: 900; letter-spacing: 2px; text-transform: uppercase;">
                        </div>
                    </div>

                    <button type="submit" class="btn-auth" style="padding: 15px; font-size: 14px;">
                        MASUK SEKARANG <i class="fa-solid fa-arrow-right"
                            style="margin-left: 10px; color: #000; font-size: 12px;"></i>
                    </button>

                    <div class="auth-footer" style="padding-top: 10px; border-top: 2px dashed #cbd5e1; margin-top: 15px;">
                        <span style="opacity: 0.7; text-transform: uppercase; font-size: 11px; font-weight: 800;">Belum punya
                            akun?</span>
                        <a href="{{ route('register') }}" style="margin-left: 5px;">DAFTAR SEKARANG</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('refresh-login-captcha')?.addEventListener('click', function() {
            const image = document.getElementById('login-captcha-image');
            if (!image) return;
            image.src = "{{ route('login.captcha') }}?v=" + Date.now();
        });

    </script>
@endsection
