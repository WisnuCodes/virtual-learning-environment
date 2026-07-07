@extends('layouts.app')

@section('content')
<style>
    .verify-page {
        min-height: calc(100vh - 73px);
        background-color: #f0f4f8;
        background-image: 
            radial-gradient(#000 1.5px, transparent 1.5px),
            linear-gradient(rgba(16, 185, 129, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(16, 185, 129, 0.05) 1px, transparent 1px);
        background-size: 30px 30px, 60px 60px, 60px 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        font-family: 'Poppins', sans-serif;
    }

    .cert-neo-container {
        position: relative;
        width: 100%;
        max-width: 650px;
        animation: slideUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .cert-neo-card {
        background: #fff;
        border: 4px solid #000;
        padding: 60px 50px;
        position: relative;
        z-index: 2;
        box-shadow: 20px 20px 0px 0px #000;
        text-align: center;
    }

    .cert-neo-card::before {
        content: '';
        position: absolute;
        top: -15px;
        left: -15px;
        right: -15px;
        bottom: -15px;
        border: 2px dashed #000;
        z-index: -1;
        opacity: 0.2;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--accent-primary);
        color: #fff;
        padding: 10px 24px;
        border: 3px solid #000;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 14px;
        box-shadow: 6px 6px 0px 0px #000;
        margin-bottom: 40px;
        transform: rotate(-1deg);
        transition: 0.3s;
    }

    .status-badge:hover {
        transform: rotate(0deg) scale(1.05);
    }

    .cert-header-title {
        font-size: 42px;
        font-weight: 900;
        color: #000;
        text-transform: uppercase;
        line-height: 0.9;
        margin-bottom: 10px;
        letter-spacing: -2px;
    }

    .cert-header-subtitle {
        font-size: 13px;
        font-weight: 800;
        color: #000;
        opacity: 0.6;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 50px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 25px;
        margin-bottom: 50px;
        text-align: left;
    }

    .info-box {
        background: #fff;
        border: 3px solid #000;
        padding: 25px;
        position: relative;
        transition: 0.2s;
    }

    .info-box:hover {
        box-shadow: 8px 8px 0px 0px var(--accent-primary);
        transform: translate(-4px, -4px);
    }

    .info-box .label {
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--accent-primary);
        margin-bottom: 6px;
        display: block;
    }

    .info-box .value {
        font-size: 22px;
        font-weight: 900;
        color: #000;
        line-height: 1.2;
    }

    .dual-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .action-group {
        display: flex;
        gap: 20px;
    }

    .btn-neo {
        flex: 1;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 14px;
        border: 3px solid #000;
        transition: 0.2s;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-neo-primary {
        background: #000;
        color: #fff;
        box-shadow: 8px 8px 0px 0px var(--accent-primary);
    }

    .btn-neo-primary:hover {
        background: var(--accent-primary);
        transform: translate(2px, 2px);
        box-shadow: 4px 4px 0px 0px #000;
    }

    .btn-neo-secondary {
        background: #fff;
        color: #000;
        box-shadow: 8px 8px 0px 0px #000;
    }

    .btn-neo-secondary:hover {
        background: #f8fafc;
        transform: translate(2px, 2px);
        box-shadow: 4px 4px 0px 0px #000;
    }

    /* Decorative elements */
    .decor-shape {
        position: absolute;
        z-index: 1;
        pointer-events: none;
    }

    .star { top: -40px; right: -40px; font-size: 60px; color: #fbbf24; animation: rotate 10s linear infinite; }
    .circle { bottom: -30px; left: -50px; width: 100px; height: 100px; border: 15px solid var(--accent-primary); border-radius: 50%; opacity: 0.5; }

    @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

    @media (max-width: 600px) {
        .cert-neo-card { padding: 40px 25px; }
        .cert-header-title { font-size: 30px; }
        .dual-info { grid-template-columns: 1fr; }
        .action-group { flex-direction: column; }
    }
</style>

<div class="verify-page">
    <div class="cert-neo-container">
        <!-- Decor -->
        <div class="decor-shape star">★</div>
        <div class="decor-shape circle"></div>

        <div class="cert-neo-card">
            <div class="status-badge">
                <i class="fa-solid fa-shield-check"></i> Verified Certificate
            </div>

            <h1 class="cert-header-title">Sertifikat Valid</h1>
            <p class="cert-header-subtitle">Verified by <span style="color: var(--accent-primary);">ruang</span>kelas.</p>

            <div class="info-grid">
                <div class="info-box">
                    <span class="label">Penerima Sertifikat</span>
                    <div class="value" style="font-size: 28px;">{{ $certificate->user->name }}</div>
                </div>

                <div class="info-box">
                    <span class="label">Program Pelatihan</span>
                    <div class="value">{{ $certificate->course->title }}</div>
                </div>

                <div class="dual-info">
                    <div class="info-box">
                        <span class="label">ID Sertifikat</span>
                        <div class="value" style="font-size: 14px; font-family: monospace;">{{ $certificate->certificate_code }}</div>
                    </div>
                    <div class="info-box">
                        <span class="label">Tanggal Terbit</span>
                        <div class="value" style="font-size: 16px;">{{ $certificate->created_at->format('d F Y') }}</div>
                    </div>
                </div>
            </div>

            <div class="action-group">
                <a href="{{ route('home') }}" class="btn-neo btn-neo-primary">
                    <i class="fa-solid fa-house"></i> Beranda
                </a>
                <button onclick="window.print()" class="btn-neo btn-neo-secondary">
                    <i class="fa-solid fa-print"></i> Cetak Bukti
                </button>
            </div>

            <div style="margin-top: 50px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #000; opacity: 0.4;">
                Sertifikat ini dijamin keasliannya oleh sistem keamanan <strong>ruangkelas.</strong>
            </div>
        </div>
    </div>
</div>
@endsection

