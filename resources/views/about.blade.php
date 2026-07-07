@extends('layouts.app')

@section('content')

<style>
    /* ===== ABOUT PAGE — Neobrutalism Style ===== */

    /* Hero */
    .about-exec-hero {
        background-color: var(--bg-primary);
        padding: 100px 5% 80px;
        border-bottom: 3px solid #000;
        position: relative;
        overflow: hidden;
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 24px 24px;
    }

    .about-exec-hero::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(var(--accent-primary-rgb), 0.03));
        pointer-events: none;
    }

    /* Team Section */
    .team-wrapper {
        background-color: var(--bg-secondary);
    }

    .team-container {
        padding: 60px 5%;
        max-width: 1300px;
        margin: 0 auto;
    }

    .team-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 40px;
        border-bottom: 3px solid #000;
        padding-bottom: 20px;
    }

    .team-title {
        font-size: 28px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -0.5px;
        color: #000;
        margin: 0;
    }

    /* Member Cards */
    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 40px;
    }

    .member-card {
        background: #fff;
        border: 2px solid #000;
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
        position: relative;
        box-shadow: 6px 6px 0px 0px #000;
        cursor: pointer;
    }

    .member-card:hover {
        box-shadow: 10px 10px 0px 0px var(--accent-primary);
        transform: translate(-4px, -4px);
    }

    .member-card-header {
        padding: 28px 24px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        border-bottom: 2px solid #000;
        background: #f8fafc;
    }

    .member-avatar {
        width: 60px;
        height: 60px;
        background: #000;
        color: #fff;
        font-size: 22px;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #000;
        flex-shrink: 0;
    }

    .avatar-1 { box-shadow: 4px 4px 0px 0px var(--accent-primary); }
    .avatar-2 { box-shadow: 4px 4px 0px 0px #06b6d4; background: #0f172a; }
    .avatar-3 { box-shadow: 4px 4px 0px 0px #f59e0b; background: #1e293b; }

    .member-info .member-name {
        font-size: 16px;
        font-weight: 900;
        color: #000;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .member-info .member-nim {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .member-role-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fff;
        color: #000;
        font-size: 10px;
        font-weight: 900;
        padding: 4px 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 2px solid #000;
        box-shadow: 2px 2px 0px 0px var(--accent-primary);
    }

    .member-card-body {
        padding: 20px 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .member-excerpt {
        font-size: 13px;
        color: #475569;
        line-height: 1.7;
        font-weight: 600;
        border-left: 4px solid #000;
        padding-left: 14px;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .member-skills-row {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 20px;
    }

    .skill-chip {
        background: #e2e8f0;
        color: #000;
        font-size: 10px;
        font-weight: 900;
        padding: 4px 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 2px solid #000;
    }

    .member-card-footer-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 2px dashed #000;
    }

    .member-view-btn {
        background: #000;
        color: #fff;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        padding: 10px 18px;
        letter-spacing: 1px;
        border: 2px solid #000;
        box-shadow: 3px 3px 0px 0px var(--accent-primary);
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .member-view-btn:hover {
        background: #fff;
        color: #000;
        transform: translate(-2px, -2px);
        box-shadow: 5px 5px 0px 0px var(--accent-primary);
    }

    /* ======= MODAL ======= */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.25s ease, visibility 0.25s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-box {
        background: #fff;
        border: 3px solid #000;
        width: 100%;
        max-width: 600px;
        box-shadow: 12px 12px 0px 0px #000;
        transform: translateY(30px);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-overlay.active .modal-box {
        transform: translateY(0);
    }

    .modal-top-bar {
        background: #000;
        color: #fff;
        padding: 14px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
        border-bottom: 3px solid #000;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .modal-top-bar-left {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-close-btn {
        background: #fff;
        color: #000;
        border: none;
        width: 30px;
        height: 30px;
        font-size: 16px;
        font-weight: 900;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
        border: 2px solid #fff;
    }

    .modal-close-btn:hover {
        background: var(--accent-primary);
        border-color: var(--accent-primary);
        color: #fff;
    }

    .modal-profile-section {
        padding: 28px 28px 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        border-bottom: 2px solid #000;
        background: #f8fafc;
    }

    .modal-avatar-lg {
        width: 80px;
        height: 80px;
        background: #000;
        color: #fff;
        font-size: 28px;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #000;
        flex-shrink: 0;
    }

    .modal-member-meta .modal-name {
        font-size: 20px;
        font-weight: 900;
        color: #000;
        text-transform: uppercase;
        letter-spacing: -0.5px;
        margin-bottom: 4px;
    }

    .modal-member-meta .modal-nim {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .modal-body-content {
        padding: 24px 28px 28px;
    }

    .modal-section-label {
        font-size: 10px;
        font-weight: 900;
        color: #000;
        text-transform: uppercase;
        letter-spacing: 2px;
        background: #e2e8f0;
        display: inline-block;
        padding: 4px 10px;
        border: 2px solid #000;
        margin-bottom: 12px;
        margin-top: 20px;
    }

    .modal-section-label:first-child {
        margin-top: 0;
    }

    .modal-description {
        font-size: 14px;
        color: #475569;
        line-height: 1.8;
        font-weight: 600;
        background: #fff;
        border: 2px solid #000;
        padding: 16px 20px;
        border-left: 6px solid var(--accent-primary);
        box-shadow: 4px 4px 0px 0px #000;
    }

    .modal-skills-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .modal-skill-tag {
        background: #fff;
        color: #000;
        font-size: 10px;
        font-weight: 900;
        padding: 6px 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 2px solid #000;
        box-shadow: 3px 3px 0px 0px #000;
    }

    .modal-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .modal-stat-box {
        background: #fff;
        border: 2px solid #000;
        padding: 14px 12px;
        text-align: center;
        box-shadow: 4px 4px 0px 0px #000;
    }

    .modal-stat-val {
        font-size: 24px;
        font-weight: 900;
        color: #000;
        line-height: 1;
        margin-bottom: 4px;
    }

    .modal-stat-lbl {
        font-size: 9px;
        font-weight: 900;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .about-exec-hero { padding: 60px 5% 40px; }
        .team-container { padding: 40px 5%; }
        .team-header { flex-direction: column; align-items: flex-start; gap: 15px; }
        .team-grid { grid-template-columns: 1fr; }
        .modal-stats-grid { grid-template-columns: repeat(3, 1fr); }
        .modal-profile-section { flex-direction: column; text-align: center; }
        .modal-box { max-height: 95vh; }
    }
</style>

<!-- ===== HERO ===== -->
<section class="about-exec-hero">
    <div style="max-width: 1300px; margin: 0 auto; position: relative; z-index: 10;">
        <div style="display: flex; gap: 15px; margin-bottom: 30px;">
            <div class="hero-label">
                <i class="fa-solid fa-users" style="color: var(--accent-primary);"></i> TIM PENGEMBANG
            </div>
            <div class="hero-label" style="background: #000; color: #fff; box-shadow: 4px 4px 0px 0px #cbd5e1;">
                <i class="fa-solid fa-id-badge" style="color: var(--accent-primary);"></i> PROFIL ANGGOTA
            </div>
        </div>

        <h1 style="font-size: 64px; font-weight: 900; color: #000; line-height: 0.9; letter-spacing: -3px; text-transform: uppercase; margin-bottom: 25px;">
            Tentang<br><span style="color: var(--accent-primary);">Kami.</span>
        </h1>

        <p style="max-width: 600px; border-left: 6px solid var(--accent-primary); padding-left: 25px; background: rgba(255,255,255,0.8); font-size: 16px; color: #475569; font-weight: 700; line-height: 1.6; border: 2px solid #000; border-left: 6px solid var(--accent-primary); padding: 20px 20px 20px 25px; box-shadow: 4px 4px 0px 0px #000;">
            Platform <strong>RuangKelas</strong> dibangun oleh tim mahasiswa berdedikasi yang berkomitmen 
            menghadirkan pengalaman belajar online terbaik untuk komunitas Indonesia.
        </p>
    </div>

    <!-- Decorative -->
    <div style="position: absolute; bottom: -20px; right: 5%; font-size: 180px; color: rgba(0,0,0,0.03); font-weight: 900; pointer-events: none; z-index: 1; text-transform: uppercase;">
        TEAM
    </div>
    <div style="position: absolute; top: 40px; right: 5%; width: 150px; height: 150px; border: 2px solid rgba(0,0,0,0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; pointer-events: none;">
        <div style="width: 100px; height: 100px; border: 1px dashed rgba(0,0,0,0.1); border-radius: 50%;"></div>
    </div>
</section>

<!-- ===== TEAM SECTION ===== -->
<div class="team-wrapper">
    <main class="team-container">
        <div class="team-header">
            <div>
                <div style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; background: #e2e8f0; display: inline-block; padding: 4px 8px; border: 2px solid #000;">
                    <i class="fa-solid fa-database" style="margin-right: 6px;"></i> Daftar Anggota
                </div>
                <h2 class="team-title">Daftar Anggota</h2>
            </div>
            <div style="font-size: 12px; font-weight: 900; color: #000; background: #fff; border: 2px solid #000; padding: 8px 15px; box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                <span style="font-size: 16px;">003</span> ANGGOTA TERDAFTAR
            </div>
        </div>

        <div class="team-grid">

            {{-- ===== MEMBER 1: WISNU ===== --}}
            <article class="member-card" onclick="openModal('wisnu')" tabindex="0"
                role="button" onkeydown="if(event.key==='Enter') openModal('wisnu')">
                <div class="member-card-header">
                    <div class="member-avatar avatar-1">WN</div>
                    <div class="member-info">
                        <div class="member-name">Wisnu Nugraha</div>
                        <div class="member-nim">NIM: 2350081029</div>
                        <span class="member-role-tag">
                            <i class="fa-solid fa-code"></i> Lead Developer
                        </span>
                    </div>
                </div>
                <div class="member-card-body">
                    <p class="member-excerpt">
                        Bertanggung jawab atas arsitektur sistem dan pengembangan fitur utama platform LMS-Pro.
                    </p>
                    <div class="member-skills-row">
                        <span class="skill-chip">Laravel</span>
                        <span class="skill-chip">PHP</span>
                        <span class="skill-chip">MySQL</span>
                        <span class="skill-chip">JS</span>
                    </div>
                    <div class="member-card-footer-bar">
                        <span style="font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
                            <i class="fa-solid fa-circle" style="color: #10b981; font-size: 8px;"></i> Anggota Aktif
                        </span>
                        <button class="member-view-btn">
                            LIHAT PROFIL <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </article>

            {{-- ===== MEMBER 2: RAYZAN ===== --}}
            <article class="member-card" onclick="openModal('rayzan')" tabindex="0"
                role="button" onkeydown="if(event.key==='Enter') openModal('rayzan')">
                <div class="member-card-header">
                    <div class="member-avatar avatar-2">RF</div>
                    <div class="member-info">
                        <div class="member-name">Rayzan Fazri Ramdany</div>
                        <div class="member-nim">NIM: 2350081029</div>
                        <span class="member-role-tag" style="box-shadow: 2px 2px 0px 0px #06b6d4;">
                            <i class="fa-solid fa-server"></i> Backend Dev
                        </span>
                    </div>
                </div>
                <div class="member-card-body">
                    <p class="member-excerpt">
                        Spesialis dalam merancang logika bisnis, sistem autentikasi, dan manajemen database.
                    </p>
                    <div class="member-skills-row">
                        <span class="skill-chip">PHP</span>
                        <span class="skill-chip">SQL</span>
                        <span class="skill-chip">Auth</span>
                        <span class="skill-chip">API</span>
                    </div>
                    <div class="member-card-footer-bar">
                        <span style="font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
                            <i class="fa-solid fa-circle" style="color: #10b981; font-size: 8px;"></i> Anggota Aktif
                        </span>
                        <button class="member-view-btn" style="box-shadow: 3px 3px 0px 0px #06b6d4;">
                            LIHAT PROFIL <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </article>

            {{-- ===== MEMBER 3: ALFAESAL ===== --}}
            <article class="member-card" onclick="openModal('alfaesal')" tabindex="0"
                role="button" onkeydown="if(event.key==='Enter') openModal('alfaesal')">
                <div class="member-card-header">
                    <div class="member-avatar avatar-3">AI</div>
                    <div class="member-info">
                        <div class="member-name">Alfaesal Akbar Iriawan</div>
                        <div class="member-nim">NIM: 2350081029</div>
                        <span class="member-role-tag" style="box-shadow: 2px 2px 0px 0px #f59e0b;">
                            <i class="fa-solid fa-palette"></i> UI/UX Designer
                        </span>
                    </div>
                </div>
                <div class="member-card-body">
                    <p class="member-excerpt">
                        Bertanggung jawab atas tampilan, pengalaman pengguna, dan seluruh komponen frontend interaktif.
                    </p>
                    <div class="member-skills-row">
                        <span class="skill-chip">Figma</span>
                        <span class="skill-chip">HTML</span>
                        <span class="skill-chip">CSS</span>
                        <span class="skill-chip">UX</span>
                    </div>
                    <div class="member-card-footer-bar">
                        <span style="font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
                            <i class="fa-solid fa-circle" style="color: #10b981; font-size: 8px;"></i> Anggota Aktif
                        </span>
                        <button class="member-view-btn" style="box-shadow: 3px 3px 0px 0px #f59e0b;">
                            LIHAT PROFIL <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </article>

        </div>
    </main>
</div>

{{-- ============================================================ --}}
{{-- MODAL: WISNU --}}
{{-- ============================================================ --}}
<div class="modal-overlay" id="modal-wisnu" onclick="closeModalOnOverlay(event,'wisnu')">
    <div class="modal-box">
        <div class="modal-top-bar">
            <div class="modal-top-bar-left">
                <i class="fa-solid fa-id-card" style="color: var(--accent-primary);"></i>
                PROFIL ANGGOTA — WISNU NUGRAHA
            </div>
            <button class="modal-close-btn" onclick="closeModal('wisnu')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="modal-profile-section">
            <div class="modal-avatar-lg avatar-1">WN</div>
            <div class="modal-member-meta">
                <div class="modal-name">Wisnu Nugraha</div>
                <div class="modal-nim">NIM: 2350081029</div>
                <span class="member-role-tag">
                    <i class="fa-solid fa-code"></i> Lead Developer
                </span>
            </div>
        </div>
        <div class="modal-body-content">
            <div class="modal-section-label">
                <i class="fa-solid fa-user" style="color: var(--accent-primary); margin-right: 6px;"></i> Tentang
            </div>
            <p class="modal-description">
                Wisnu Nugraha adalah mahasiswa yang bersemangat di bidang pengembangan perangkat lunak dengan 
                fokus pada full-stack development. Ia berperan sebagai Lead Developer dalam proyek LMS-Pro, 
                bertanggung jawab atas arsitektur sistem, pengembangan fitur utama, serta memastikan 
                kualitas kode seluruh tim. Memiliki passion kuat di bidang teknologi web modern dan 
                selalu berusaha menghadirkan solusi inovatif.
            </p>

            <div class="modal-section-label">
                <i class="fa-solid fa-microchip" style="color: var(--accent-primary); margin-right: 6px;"></i> Keahlian
            </div>
            <div class="modal-skills-grid">
                <span class="modal-skill-tag">Laravel</span>
                <span class="modal-skill-tag">PHP</span>
                <span class="modal-skill-tag">MySQL</span>
                <span class="modal-skill-tag">JavaScript</span>
                <span class="modal-skill-tag">REST API</span>
                <span class="modal-skill-tag">Git</span>
            </div>

            <div class="modal-section-label" style="margin-top: 20px;">
                <i class="fa-solid fa-chart-bar" style="color: var(--accent-primary); margin-right: 6px;"></i> Statistik Kontribusi
            </div>
            <div class="modal-stats-grid">
                <div class="modal-stat-box" style="box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                    <div class="modal-stat-val">8+</div>
                    <div class="modal-stat-lbl">Fitur</div>
                </div>
                <div class="modal-stat-box" style="box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                    <div class="modal-stat-val">120+</div>
                    <div class="modal-stat-lbl">Commit</div>
                </div>
                <div class="modal-stat-box" style="box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                    <div class="modal-stat-val">3K+</div>
                    <div class="modal-stat-lbl">Lines Code</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL: RAYZAN --}}
{{-- ============================================================ --}}
<div class="modal-overlay" id="modal-rayzan" onclick="closeModalOnOverlay(event,'rayzan')">
    <div class="modal-box" style="box-shadow: 12px 12px 0px 0px #06b6d4;">
        <div class="modal-top-bar">
            <div class="modal-top-bar-left">
                <i class="fa-solid fa-id-card" style="color: #06b6d4;"></i>
                PROFIL ANGGOTA — RAYZAN FAZRI RAMDANY
            </div>
            <button class="modal-close-btn" onclick="closeModal('rayzan')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="modal-profile-section">
            <div class="modal-avatar-lg avatar-2">RF</div>
            <div class="modal-member-meta">
                <div class="modal-name">Rayzan Fazri Ramdany</div>
                <div class="modal-nim">NIM: 2350081029</div>
                <span class="member-role-tag" style="box-shadow: 2px 2px 0px 0px #06b6d4;">
                    <i class="fa-solid fa-server"></i> Backend Developer
                </span>
            </div>
        </div>
        <div class="modal-body-content">
            <div class="modal-section-label">
                <i class="fa-solid fa-user" style="color: #06b6d4; margin-right: 6px;"></i> Tentang
            </div>
            <p class="modal-description" style="border-left-color: #06b6d4;">
                Rayzan Fazri Ramdany adalah seorang Backend Developer yang andal dengan keahlian dalam 
                merancang dan mengimplementasikan logika bisnis aplikasi. Dalam proyek LMS-Pro, Rayzan 
                bertanggung jawab atas pengembangan sistem autentikasi, manajemen database, serta integrasi 
                berbagai komponen backend yang memastikan platform berjalan optimal dan aman.
            </p>

            <div class="modal-section-label">
                <i class="fa-solid fa-microchip" style="color: #06b6d4; margin-right: 6px;"></i> Keahlian
            </div>
            <div class="modal-skills-grid">
                <span class="modal-skill-tag">PHP</span>
                <span class="modal-skill-tag">Laravel</span>
                <span class="modal-skill-tag">Database Design</span>
                <span class="modal-skill-tag">SQL</span>
                <span class="modal-skill-tag">Authentication</span>
                <span class="modal-skill-tag">API Integration</span>
            </div>

            <div class="modal-section-label" style="margin-top: 20px;">
                <i class="fa-solid fa-chart-bar" style="color: #06b6d4; margin-right: 6px;"></i> Statistik Kontribusi
            </div>
            <div class="modal-stats-grid">
                <div class="modal-stat-box" style="box-shadow: 4px 4px 0px 0px #06b6d4;">
                    <div class="modal-stat-val" style="color: #06b6d4;">6+</div>
                    <div class="modal-stat-lbl">Fitur</div>
                </div>
                <div class="modal-stat-box" style="box-shadow: 4px 4px 0px 0px #06b6d4;">
                    <div class="modal-stat-val" style="color: #06b6d4;">90+</div>
                    <div class="modal-stat-lbl">Commit</div>
                </div>
                <div class="modal-stat-box" style="box-shadow: 4px 4px 0px 0px #06b6d4;">
                    <div class="modal-stat-val" style="color: #06b6d4;">2K+</div>
                    <div class="modal-stat-lbl">Lines Code</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL: ALFAESAL --}}
{{-- ============================================================ --}}
<div class="modal-overlay" id="modal-alfaesal" onclick="closeModalOnOverlay(event,'alfaesal')">
    <div class="modal-box" style="box-shadow: 12px 12px 0px 0px #f59e0b;">
        <div class="modal-top-bar">
            <div class="modal-top-bar-left">
                <i class="fa-solid fa-id-card" style="color: #f59e0b;"></i>
                PROFIL ANGGOTA — ALFAESAL AKBAR IRIAWAN
            </div>
            <button class="modal-close-btn" onclick="closeModal('alfaesal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="modal-profile-section">
            <div class="modal-avatar-lg avatar-3">AI</div>
            <div class="modal-member-meta">
                <div class="modal-name">Alfaesal Akbar Iriawan</div>
                <div class="modal-nim">NIM: 2350081029</div>
                <span class="member-role-tag" style="box-shadow: 2px 2px 0px 0px #f59e0b;">
                    <i class="fa-solid fa-palette"></i> UI/UX Designer
                </span>
            </div>
        </div>
        <div class="modal-body-content">
            <div class="modal-section-label">
                <i class="fa-solid fa-user" style="color: #f59e0b; margin-right: 6px;"></i> Tentang
            </div>
            <p class="modal-description" style="border-left-color: #f59e0b;">
                Alfaesal Akbar Iriawan adalah UI/UX Designer berbakat yang bertanggung jawab atas tampilan 
                dan pengalaman pengguna dalam platform LMS-Pro. Ia memastikan setiap halaman memiliki desain 
                yang intuitif, konsisten, dan menarik secara visual. Alfaesal juga turut berkontribusi dalam 
                pengembangan frontend komponen-komponen interaktif serta riset UX untuk memahami kebutuhan pengguna.
            </p>

            <div class="modal-section-label">
                <i class="fa-solid fa-microchip" style="color: #f59e0b; margin-right: 6px;"></i> Keahlian
            </div>
            <div class="modal-skills-grid">
                <span class="modal-skill-tag">UI Design</span>
                <span class="modal-skill-tag">UX Research</span>
                <span class="modal-skill-tag">HTML & CSS</span>
                <span class="modal-skill-tag">Figma</span>
                <span class="modal-skill-tag">Prototyping</span>
                <span class="modal-skill-tag">Responsive</span>
            </div>

            <div class="modal-section-label" style="margin-top: 20px;">
                <i class="fa-solid fa-chart-bar" style="color: #f59e0b; margin-right: 6px;"></i> Statistik Kontribusi
            </div>
            <div class="modal-stats-grid">
                <div class="modal-stat-box" style="box-shadow: 4px 4px 0px 0px #f59e0b;">
                    <div class="modal-stat-val" style="color: #f59e0b;">15+</div>
                    <div class="modal-stat-lbl">Halaman</div>
                </div>
                <div class="modal-stat-box" style="box-shadow: 4px 4px 0px 0px #f59e0b;">
                    <div class="modal-stat-val" style="color: #f59e0b;">50+</div>
                    <div class="modal-stat-lbl">Komponen</div>
                </div>
                <div class="modal-stat-box" style="box-shadow: 4px 4px 0px 0px #f59e0b;">
                    <div class="modal-stat-val" style="color: #f59e0b;">100%</div>
                    <div class="modal-stat-lbl">Responsif</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openModal(name) {
        const modal = document.getElementById('modal-' + name);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(name) {
        const modal = document.getElementById('modal-' + name);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    function closeModalOnOverlay(event, name) {
        if (event.target === event.currentTarget) {
            closeModal(name);
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.active').forEach(modal => {
                modal.classList.remove('active');
            });
            document.body.style.overflow = '';
        }
    });
</script>
@endpush

@endsection
