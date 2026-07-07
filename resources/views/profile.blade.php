@extends('layouts.app')

@section('content')
    <style>
        .profile-container {
            background-color: var(--bg-secondary);
            min-height: calc(100vh - 73px);
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
            padding: 40px 5%;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
            background: #000;
            padding: 20px 30px;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
        }

        .profile-avatar-large {
            width: 80px;
            height: 80px;
            background: var(--accent-primary);
            border: 3px solid #000;
            box-shadow: 4px 4px 0px 0px #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 900;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .profile-avatar-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-title h1 {
            font-size: 28px;
            font-weight: 900;
            color: #fff;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .profile-title p {
            font-size: 13px;
            color: #f1f5f9;
            margin: 0;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .security-badge {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            padding: 4px 10px;
            font-size: 10px;
            font-weight: 900;
            box-shadow: 2px 2px 0px 0px var(--accent-primary);
        }

        .profile-content {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 40px;
            align-items: start;
        }

        .profile-card {
            background: #fff;
            border: 3px solid #000;
            padding: 30px;
            box-shadow: 8px 8px 0px 0px #000;
        }

        .profile-card-header {
            font-size: 16px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: var(--accent-primary);
            border: 2px solid #000;
            padding: 15px;
            text-align: center;
            box-shadow: 4px 4px 0px 0px #000;
            transition: all 0.2s ease;
        }

        .stat-box:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #000;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 4px;
            text-shadow: 2px 2px 0px #000;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: #fff;
            border: 1px solid #000;
            display: inline-block;
            padding: 2px 8px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 900;
            color: #000;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-left: 4px solid var(--accent-primary);
            padding-left: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            font-weight: 700;
            color: #000;
            background: #fff;
            border: 2px solid #000;
            outline: none;
            transition: all 0.2s ease;
            font-family: inherit;
            box-shadow: inset 2px 2px 0px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            transform: translate(-2px, -2px);
        }

        .btn-update {
            background: var(--accent-primary);
            color: #fff;
            border: 3px solid #000;
            padding: 14px 30px;
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 6px 6px 0px 0px #000;
        }

        .btn-update:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px 0px #000;
        }

        .btn-update:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        .alert-success {
            background: #10b981;
            border: 3px solid #000;
            color: #fff;
            padding: 15px 20px;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 6px 6px 0px 0px #000;
        }

        .alert-danger {
            background: #e11d48;
            border: 3px solid #000;
            color: #fff;
            padding: 15px 20px;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 6px 6px 0px 0px #000;
        }

        @media (max-width: 900px) {
            .profile-content {
                grid-template-columns: 1fr;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-title p {
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    </style>

    <div class="profile-container">
        <div style="max-width: 1200px; margin: 0 auto;">

            <div class="profile-header">
                <div class="profile-avatar-large">
                    @if ($user->profile_photo_url)
                        <img src="{{ $user->profile_photo_url }}" alt="Foto Profil" class="profile-avatar-image">
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="profile-title">
                    <h1>{{ Auth::user()->name }}</h1>
                    <p>
                        <i class="fa-solid fa-envelope"></i> {{ Auth::user()->email }}
                        <span class="security-badge"><i class="fa-solid fa-shield-halved"
                                style="color: var(--accent-primary);"></i> LEVEL AKSES:
                            {{ strtoupper(Auth::user()->role) }}</span>
                    </p>
                </div>
            </div>

            @if (session('success'))
                <div class="alert-success">
                    <div
                        style="background: #fff; color: #10b981; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; border: 2px solid #000;">
                        <i class="fa-solid fa-check"></i></div>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert-danger">
                    <div
                        style="background: #fff; color: #e11d48; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; border: 2px solid #000;">
                        <i class="fa-solid fa-xmark"></i></div>
                    {{ session('error') }}
                </div>
            @endif

            <div class="profile-content">

                <!-- Left Sidebar: Stats & Info -->
                <div class="profile-card">
                    <div class="profile-card-header">
                        <i class="fa-solid fa-chart-pie" style="color: var(--accent-primary);"></i> Data Aktivitas
                    </div>

                    <div class="profile-stats">
                        @foreach ($stats as $stat)
                            <div class="stat-box" style="background: {{ $stat['color'] }};">
                                <div class="stat-value">{{ $stat['value'] }}</div>
                                <div class="stat-label">{{ $stat['label'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div
                        style="font-size: 12px; font-weight: 800; color: #000; text-transform: uppercase; background: #f8fafc; border: 2px solid #000; padding: 15px;">
                        <div
                            style="display: flex; justify-content: space-between; margin-bottom: 12px; border-bottom: 2px dashed #cbd5e1; padding-bottom: 8px;">
                            <span style="color: #64748b;">Akun Dibuat:</span>
                            <span>{{ Auth::user()->created_at->format('d M Y') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: #64748b;">Status Sistem:</span>
                            <span style="color: var(--accent-primary);"><i class="fa-solid fa-circle-dot"
                                    style="font-size: 10px; margin-right: 4px;"></i> AKTIF</span>
                        </div>
                    </div>
                </div>

                <!-- Right Form: Settings -->
                <div class="profile-card" style="box-shadow: 8px 8px 0px 0px var(--accent-primary);">
                    <div class="profile-card-header">
                        <i class="fa-solid fa-user-gear" style="color: var(--accent-primary);"></i> Parameter Identitas
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" name="profile_photo" class="form-control"
                                accept=".jpg,.jpeg,.png,.webp">
                            <div style="margin-top: 8px; font-size: 11px; font-weight: 700; color: #64748b;">
                                Format: JPG, PNG, WEBP. Maksimal 2MB.
                            </div>
                            @error('profile_photo')
                                <span
                                    style="color: #e11d48; font-size: 11px; font-weight: 900; background: #ffe4e6; border: 1px solid #e11d48; padding: 2px 6px; margin-top: 6px; display: inline-block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                    class="form-control" required>
                                @error('name')
                                    <span
                                        style="color: #e11d48; font-size: 11px; font-weight: 900; background: #ffe4e6; border: 1px solid #e11d48; padding: 2px 6px; margin-top: 6px; display: inline-block;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                    class="form-control" required>
                                @error('email')
                                    <span
                                        style="color: #e11d48; font-size: 11px; font-weight: 900; background: #ffe4e6; border: 1px solid #e11d48; padding: 2px 6px; margin-top: 6px; display: inline-block;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="profile-card-header" style="margin-top: 40px;">
                            <i class="fa-solid fa-lock" style="color: var(--accent-primary);"></i> Keamanan Akun
                        </div>

                        <div
                            style="background: #f1f5f9; border: 2px solid #000; padding: 12px 15px; font-size: 11px; font-weight: 800; color: #000; margin-bottom: 25px; display: flex; gap: 10px; align-items: flex-start; text-transform: uppercase;">
                            <i class="fa-solid fa-circle-exclamation" style="color: #f59e0b; font-size: 16px;"></i>
                            Jika tidak ingin mengubah kata sandi, kosongkan kolom di bawah ini.
                        </div>

                        <div class="form-group">
                            <label>Kata Sandi Saat Ini</label>
                            <input type="password" name="current_password" class="form-control"
                                placeholder="OTORISASI PERUBAHAN">
                            @error('current_password')
                                <span
                                    style="color: #e11d48; font-size: 11px; font-weight: 900; background: #ffe4e6; border: 1px solid #e11d48; padding: 2px 6px; margin-top: 6px; display: inline-block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <div class="form-group">
                                <label>Kata Sandi Baru</label>
                                <input type="password" name="new_password" class="form-control"
                                    placeholder="MIN. 8 KARAKTER">
                                @error('new_password')
                                    <span
                                        style="color: #e11d48; font-size: 11px; font-weight: 900; background: #ffe4e6; border: 1px solid #e11d48; padding: 2px 6px; margin-top: 6px; display: inline-block;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Verifikasi Kata Sandi Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control"
                                    placeholder="ULANGI KATA SANDI">
                            </div>
                        </div>

                        <div style="margin-top: 40px; text-align: right;">
                            <button type="submit" class="btn-update">
                                <i class="fa-solid fa-floppy-disk"></i> SIMPAN PERUBAHAN
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
