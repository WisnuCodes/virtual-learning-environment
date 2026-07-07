<div
    style="padding: 15px 24px 8px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
    Panel Operasional
</div>

<a href="{{ route('instructor.dashboard') }}"
    class="sidebar-link {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}">
    <i class="fa-solid fa-gauge-high"></i> Ringkasan Strategis
</a>

<div
    class="sidebar-dropdown {{ request()->is('instructor/courses*') || request()->routeIs('instructor.earnings') ? 'active' : '' }}">
    <div class="sidebar-link">
        <i class="fa-solid fa-folder-tree"></i>
        Manajemen Kursus
        <i class="fa-solid fa-chevron-right chevron"></i>
    </div>
</div>
<div class="sidebar-submenu">
    <a href="{{ route('instructor.courses.create') }}"
        class="submenu-link {{ request()->routeIs('instructor.courses.create') ? 'active' : '' }}">
        <i class="fa-solid fa-square-plus" style="font-size: 10px; margin-right: 8px;"></i> Buat Kursus Baru
    </a>
    <a href="{{ route('instructor.earnings') }}"
        class="submenu-link {{ request()->routeIs('instructor.earnings') ? 'active' : '' }}">
        <i class="fa-solid fa-chart-line" style="font-size: 10px; margin-right: 8px;"></i> Audit Pendapatan
    </a>
    <a href="{{ route('instructor.reviews') }}"
        class="submenu-link {{ request()->routeIs('instructor.reviews') ? 'active' : '' }}">
        <i class="fa-solid fa-star" style="font-size: 10px; margin-right: 8px;"></i> Ulasan Siswa
    </a>
    <a href="{{ route('banners.index') }}"
        class="submenu-link {{ request()->routeIs('banners.index') ? 'active' : '' }}">
        <i class="fa-solid fa-bullhorn" style="font-size: 10px; margin-right: 8px;"></i> Banner Promo
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

<div class="sidebar-dropdown {{ request()->routeIs('courses.index') || request()->routeIs('my-learning') ? 'active' : '' }}">
    <div class="sidebar-link">
        <i class="fa-solid fa-terminal"></i>
        Akses Portal
        <i class="fa-solid fa-chevron-right chevron"></i>
    </div>
</div>
<div class="sidebar-submenu">
    <a href="{{ route('my-learning') }}" class="submenu-link">
        <i class="fa-solid fa-shield-halved" style="font-size: 10px; margin-right: 8px;"></i> Kursus Saya
    </a>
    <a href="{{ route('courses.index') }}" class="submenu-link {{ request()->routeIs('courses.index') ? 'active' : '' }}">
        <i class="fa-solid fa-database" style="font-size: 10px; margin-right: 8px;"></i> Indeks Pembelajaran
    </a>
    <a href="{{ route('forum.index') }}" class="submenu-link {{ request()->routeIs('forum.*') ? 'active' : '' }}">
        <i class="fa-solid fa-comments" style="font-size: 10px; margin-right: 8px;"></i> Forum Diskusi
    </a>
    <a href="{{ route('about') }}" class="submenu-link {{ request()->routeIs('about') ? 'active' : '' }}">
        <i class="fa-solid fa-users" style="font-size: 10px; margin-right: 8px;"></i> Tentang Kami
    </a>
</div>
