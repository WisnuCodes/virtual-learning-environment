<div
    style="padding: 15px 24px 8px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
    Kontrol Sistem
</div>

<a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <i class="fa-solid fa-gauge-high"></i> Dashboard Utama
</a>

<div
    style="padding: 15px 24px 8px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
    Konfigurasi Platform
</div>

<div
    class="sidebar-dropdown {{ request()->is('admin/settings*') || request()->is('admin/announcements*') ? 'active' : '' }}">
    <div class="sidebar-link">
        <i class="fa-solid fa-sliders"></i>
        Kontrol Platform
        <i class="fa-solid fa-chevron-right chevron"></i>
    </div>
</div>
<div class="sidebar-submenu">
    <a href="{{ route('admin.announcements.index') }}"
        class="submenu-link {{ request()->routeIs('admin.announcements.index') ? 'active' : '' }}">
        <i class="fa-solid fa-satellite-dish" style="font-size: 10px; margin-right: 8px;"></i> Pengumuman
    </a>
    <a href="{{ route('admin.settings.index') }}"
        class="submenu-link {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
        <i class="fa-solid fa-gear" style="font-size: 10px; margin-right: 8px;"></i> Pengaturan Global
    </a>
    <a href="{{ route('banners.index') }}"
        class="submenu-link {{ request()->routeIs('banners.index') ? 'active' : '' }}">
        <i class="fa-solid fa-bullhorn" style="font-size: 10px; margin-right: 8px;"></i> Banner Promo
    </a>
</div>

<div
    style="padding: 15px 24px 8px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
    Infrastruktur Inti
</div>

<div class="sidebar-dropdown {{ request()->is('admin/users*') ? 'active' : '' }}">
    <div class="sidebar-link">
        <i class="fa-solid fa-user-gear"></i>
        Manajemen Pengguna
        <i class="fa-solid fa-chevron-right chevron"></i>
    </div>
</div>
<div class="sidebar-submenu">
    <a href="{{ route('admin.users') }}" class="submenu-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <i class="fa-solid fa-address-book" style="font-size: 10px; margin-right: 8px;"></i> Daftar Pengguna
    </a>
</div>

<div class="sidebar-dropdown {{ request()->is('admin/withdrawals*') ? 'active' : '' }}">
    <div class="sidebar-link">
        <i class="fa-solid fa-money-bill-transfer"></i>
        Manajemen Keuangan
        <i class="fa-solid fa-chevron-right chevron"></i>
    </div>
</div>
<div class="sidebar-submenu">
    <a href="{{ route('admin.payments') }}"
        class="submenu-link {{ request()->routeIs('admin.payments') ? 'active' : '' }}">
        <i class="fa-solid fa-receipt" style="font-size: 10px; margin-right: 8px;"></i> Verifikasi Pembayaran
    </a>
    <a href="{{ route('admin.withdrawals') }}"
        class="submenu-link {{ request()->routeIs('admin.withdrawals') ? 'active' : '' }}">
        <i class="fa-solid fa-money-bill-wave" style="font-size: 10px; margin-right: 8px;"></i> Permintaan Payout
    </a>
    <a href="{{ route('admin.finance') }}"
        class="submenu-link {{ request()->routeIs('admin.finance') ? 'active' : '' }}">
        <i class="fa-solid fa-clock-rotate-left" style="font-size: 10px; margin-right: 8px;"></i> Arus Kas (Historis)
    </a>
</div>

<a href="{{ route('admin.certificates') }}" class="sidebar-link {{ request()->routeIs('admin.certificates') ? 'active' : '' }}">
    <i class="fa-solid fa-certificate"></i> Daftar Sertifikat
</a>

<div
    class="sidebar-dropdown {{ request()->is('admin/courses*') || request()->is('admin/categories*') || request()->is('admin/verification*') ? 'active' : '' }}">
    <div class="sidebar-link">
        <i class="fa-solid fa-layer-group"></i>
        Manajemen Kursus
        <i class="fa-solid fa-chevron-right chevron"></i>
    </div>
</div>
<div class="sidebar-submenu">
    <a href="{{ route('admin.verification') }}"
        class="submenu-link {{ request()->routeIs('admin.verification') ? 'active' : '' }}">
        <i class="fa-solid fa-shield-halved" style="font-size: 10px; margin-right: 8px;"></i> Antrian Verifikasi
    </a>
    <a href="{{ route('admin.courses') }}"
        class="submenu-link {{ request()->routeIs('admin.courses') ? 'active' : '' }}">
        <i class="fa-solid fa-boxes-stacked" style="font-size: 10px; margin-right: 8px;"></i> Daftar Kursus Global
    </a>
    <a href="{{ route('admin.categories') }}"
        class="submenu-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
        <i class="fa-solid fa-sitemap" style="font-size: 10px; margin-right: 8px;"></i> Manajemen Kategori
    </a>
</div>

<div
    style="padding: 15px 24px 8px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
    Pusat Akun
</div>

<div class="sidebar-dropdown {{ request()->routeIs('profile') ? 'active' : '' }}">
    <div class="sidebar-link">
        <i class="fa-solid fa-user-gear"></i>
        Pengaturan Akun
        <i class="fa-solid fa-chevron-right chevron"></i>
    </div>
</div>
<div class="sidebar-submenu">
    <a href="{{ route('profile') }}" class="submenu-link {{ request()->routeIs('profile') ? 'active' : '' }}">
        <i class="fa-solid fa-address-card" style="font-size: 10px; margin-right: 8px;"></i> Profil Akun
    </a>
</div>

<div
    style="padding: 15px 24px 8px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
    Navigasi Sistem
</div>

<a href="{{ route('courses.index') }}" class="sidebar-link {{ request()->routeIs('courses.index') ? 'active' : '' }}">
    <i class="fa-solid fa-network-wired"></i> Indeks Pembelajaran
</a>

<a href="{{ route('forum.index') }}" class="sidebar-link {{ request()->routeIs('forum.*') ? 'active' : '' }}">
    <i class="fa-solid fa-comments"></i> Forum Diskusi
</a>

<a href="{{ route('about') }}" class="sidebar-link {{ request()->routeIs('about') ? 'active' : '' }}">
    <i class="fa-solid fa-users"></i> Tentang Kami
</a>
