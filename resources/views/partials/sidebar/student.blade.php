<div
    style="padding: 15px 24px 8px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
    Pusat Akademik
</div>

<a href="{{ route('my-learning') }}" class="sidebar-link {{ request()->routeIs('my-learning') ? 'active' : '' }}">
    <i class="fa-solid fa-graduation-cap"></i> Kursus Saya
</a>

<div class="sidebar-dropdown {{ request()->routeIs('courses.index') ? 'active' : '' }}">
    <div class="sidebar-link">
        <i class="fa-solid fa-layer-group"></i>
        Eksplorasi Kursus
        <i class="fa-solid fa-chevron-right chevron"></i>
    </div>
</div>
<div class="sidebar-submenu">
    <a href="{{ route('courses.index') }}" class="submenu-link {{ request()->routeIs('courses.index') ? 'active' : '' }}">
        <i class="fa-solid fa-database" style="font-size: 10px; margin-right: 8px;"></i> Indeks Pembelajaran
    </a>
</div>

<div
    style="padding: 15px 24px 8px; font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
    Komunitas & Info
</div>

<a href="{{ route('forum.index') }}" class="sidebar-link {{ request()->routeIs('forum.*') ? 'active' : '' }}">
    <i class="fa-solid fa-comments"></i> Forum Diskusi
</a>

<a href="{{ route('about') }}" class="sidebar-link {{ request()->routeIs('about') ? 'active' : '' }}">
    <i class="fa-solid fa-users"></i> Tentang Kami
</a>

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
    <a href="{{ route('certificates.index') }}" class="submenu-link {{ request()->routeIs('certificates.index') ? 'active' : '' }}">
        <i class="fa-solid fa-file-shield" style="font-size: 10px; margin-right: 8px;"></i> Sertifikat Terverifikasi
    </a>
</div>
