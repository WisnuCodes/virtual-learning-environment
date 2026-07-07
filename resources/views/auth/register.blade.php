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
                <h1>Mulai Perjalanan Belajar Anda <span>Hari Ini.</span></h1>
                <p>Bergabunglah dengan ribuan siswa lainnya dan dapatkan akses ke materi pembelajaran terbaik untuk masa depan Anda.</p>
                
                <div class="auth-feature-list">
                    <div class="auth-feature-item">
                        <i class="fa-solid fa-rocket"></i>
                        Kurikulum Terupdate & Relevan
                    </div>
                    <div class="auth-feature-item">
                        <i class="fa-solid fa-graduation-cap"></i>
                        Instruktur Profesional di Bidangnya
                    </div>
                    <div class="auth-feature-item">
                        <i class="fa-solid fa-clock"></i>
                        Belajar Kapan Saja & Di Mana Saja
                    </div>
                </div>

                <!-- Subtle Background Text -->
                <div
                    style="position: absolute; bottom: -50px; left: -20px; font-size: 150px; color: rgba(255,255,255,0.03); font-weight: 900; pointer-events: none; z-index: -1; transform: rotate(-5deg); white-space: nowrap;">
                    JOIN NOW
                </div>
            </div>
        </div>

        <!-- Right Side: The Form -->
        <div class="auth-side-form">
            <div class="auth-card">
                <div
                    style="position: absolute; top: -15px; left: 20px; background: #000; color: #fff; padding: 4px 12px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; border: 2px solid #000; box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                    <i class="fa-solid fa-user-plus" style="color: var(--accent-primary); margin-right: 6px;"></i> Pendaftaran
                </div>

                <h2>Buat Akun Baru</h2>
                <p class="subtitle">Daftar sekarang untuk mulai belajar.</p>

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
                    DAFTAR DENGAN GOOGLE
                </a>

                <div style="position: relative; text-align: center; margin: 10px 0;">
                    <hr style="border: none; border-top: 2px dashed #cbd5e1;">
                    <span
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; padding: 0 15px; font-size: 10px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 2px; white-space: nowrap;">
                        Atau gunakan email
                    </span>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="auth-grid" style="gap: 10px;">
                        <div class="auth-input-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                                placeholder="Nama Anda">
                        </div>

                        <div class="auth-input-group">
                            <label>Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                placeholder="contoh@email.com">
                        </div>
                    </div>

                    <div class="auth-input-group">
                        <label>Kata Sandi</label>
                        <input type="password" name="password" required placeholder="Minimal 8 karakter">
                    </div>

                    <div class="auth-input-group" style="margin-bottom: 25px;">
                        <label>Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi">
                    </div>

                    <div class="auth-input-group" style="margin-bottom: 15px;">
                        <label>Verifikasi CAPTCHA</label>
                        <div style="display: flex; align-items: stretch; gap: 8px;">
                            <div style="position: relative; flex: 1; border: 2px solid #000; height: 40px; background: #fff; overflow: hidden;">
                                <img id="register-captcha-image" src="{{ route('login.captcha') }}?v={{ time() }}" alt="CAPTCHA"
                                    style="width: 100%; height: 100%; object-fit: cover; filter: contrast(110%);">
                                <button type="button" id="refresh-register-captcha"
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
                        DAFTAR SEKARANG <i class="fa-solid fa-user-check"
                            style="margin-left: 10px; color: #000; font-size: 12px;"></i>
                    </button>

                    <div class="auth-footer" style="padding-top: 8px; border-top: 2px dashed #cbd5e1; margin-top: 12px;">
                        <span style="opacity: 0.7; text-transform: uppercase; font-size: 9px; font-weight: 800;">Sudah punya
                            akun?</span>
                        <a href="{{ route('login') }}" style="margin-left: 5px; font-size: 9px;">MASUK DI SINI</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('refresh-register-captcha')?.addEventListener('click', function() {
            const image = document.getElementById('register-captcha-image');
            if (!image) return;
            image.src = "{{ route('login.captcha') }}?v=" + Date.now();
        });

    </script>
@endsection
