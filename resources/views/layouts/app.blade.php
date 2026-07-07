<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangKelas - Kuasai Keahlian Anda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Video.js for Professional Video Experience -->
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    @stack('styles')
</head>

<body class="{{ !session('has_visited') || request()->has('force_load') ? 'preloader-active' : '' }}">
    @if(!session('has_visited') || request()->has('force_load'))
        @php session(['has_visited' => true]); @endphp
        @include('partials.preloader')
    @endif

    <nav class="navbar">
        <div style="display: flex; align-items: center; gap: 20px;">
            @auth
                <div class="desktop-only" style="margin-right: -5px;">
                    <button onclick="document.getElementById('profile-sidebar').classList.toggle('active')"
                        class="nav-command-btn">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                </div>
            @endauth

            <a href="{{ route('home', ['force_load' => 1]) }}" class="logo"
                style="display: flex; align-items: center; gap: 12px; text-decoration: none;">
                @php $siteLogo = \App\Models\Setting::where('key', 'site_logo')->first(); @endphp
                @if ($siteLogo && $siteLogo->value)
                    <style>
                        @media (min-width: 769px) {
                            .mobile-logo-img {
                                display: none !important;
                            }
                        }
                    </style>
                    <img src="{{ $siteLogo->value }}" alt="Site Logo" class="mobile-logo-img"
                        style="height: 48px; width: auto; object-fit: contain;">
                @endif
                <div>ruang<span>kelas.</span></div>
            </a>
        </div>

        <div class="nav-links">
            <a href="{{ route('courses.index') }}" class="nav-btn-explore {{ request()->routeIs('courses.index') ? 'active' : '' }}">
                <i class="fa-solid fa-compass"></i>
                <span>Jelajahi Kursus</span>
            </a>

            @auth
                <!-- Notification Bell -->
                <div class="nav-notification-wrapper" id="notification-center">
                    <button class="nav-btn-explore notification-trigger" id="notif-bell">
                        <i class="fa-solid fa-bell"></i>
                        <span class="notif-badge" id="notif-count" style="display: none;">0</span>
                    </button>
                    <div class="notif-dropdown" id="notif-dropdown">
                        <div class="notif-header">
                            <span>Notifikasi</span>
                            <button id="mark-all-read">Tandai semua dibaca</button>
                        </div>
                        <div class="notif-list" id="notif-list">
                            <div class="notif-empty">Memuat notifikasi...</div>
                        </div>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('about') }}" class="nav-btn-explore {{ request()->routeIs('about') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Tentang Kami</span>
                </a>
                <a href="{{ route('forum.index') }}" class="nav-btn-explore {{ request()->routeIs('forum.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-comments"></i>
                    <span>Forum</span>
                </a>
                <a href="{{ route('login') }}" class="nav-portal-btn">
                    <i class="fa-solid fa-unlock"></i> Masuk
                </a>
            @endguest
        </div>
    </nav>

    @include('partials.top-banner')

    @auth
        <!-- Mobile Bottom Navigation (Self-contained) -->
        <style>
            @media (min-width: 769px) {
                .mobile-bottom-nav {
                    display: none !important;
                }
            }
        </style>
        <nav class="mobile-bottom-nav">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Beranda</span>
            </a>

            @if (Auth::user()->role === 'student')
                <a href="{{ route('my-learning') }}" class="{{ request()->routeIs('my-learning') ? 'active' : '' }}">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Belajar</span>
                </a>
                <a href="{{ route('forum.index') }}" class="{{ request()->routeIs('forum.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-comments"></i>
                    <span>Forum</span>
                </a>
                <a href="{{ route('home') }}" class="mobile-nav-explore">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Jelajah</span>
                </a>
            @elseif(Auth::user()->role === 'instructor')
                <a href="{{ route('instructor.dashboard') }}"
                    class="{{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Panel</span>
                </a>
                <a href="{{ route('instructor.earnings') }}"
                    class="{{ request()->routeIs('instructor.earnings') ? 'active' : '' }}">
                    <i class="fa-solid fa-wallet"></i>
                    <span>Pendapatan</span>
                </a>
                <a href="{{ route('instructor.courses.create') }}"
                    class="{{ request()->routeIs('instructor.courses.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-plus-circle"></i>
                    <span>Buat</span>
                </a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Admin</span>
                </a>
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fa-solid fa-users-gear"></i>
                    <span>Pengguna</span>
                </a>
                <a href="{{ route('admin.verification') }}"
                    class="{{ request()->routeIs('admin.verification') ? 'active' : '' }}">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Verifikasi</span>
                </a>
                <a href="{{ route('admin.courses') }}" class="{{ request()->routeIs('admin.courses') ? 'active' : '' }}">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Kursus</span>
                </a>
            @endif

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                style="color: #ef4444;">
                <i class="fa-solid fa-power-off"></i>
                <span>Keluar</span>
            </a>
            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>

        <!-- Sidebar -->
        <div id="profile-sidebar" class="sidebar">
            @php
                $rawSidebarName = (string) (Auth::user()->name ?? '');
                $rawSidebarEmail = (string) (Auth::user()->email ?? '');
                $sidebarName = preg_replace('/\s+/', ' ', trim($rawSidebarName)) ?: 'Pengguna';
                $sidebarName = mb_convert_case($sidebarName, MB_CASE_TITLE, 'UTF-8');
                $sidebarEmail = strtolower(trim($rawSidebarEmail));
                $sidebarInitial = strtoupper(mb_substr($sidebarName, 0, 1, 'UTF-8'));
                $sidebarPhotoUrl = Auth::user()->profile_photo_url;
            @endphp
            <div
                style="padding: 20px; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; background: #fff;">
                <div style="display: flex; align-items: center; gap: 12px; min-width: 0; flex: 1;">
                    @if ($sidebarPhotoUrl)
                        <img src="{{ $sidebarPhotoUrl }}" alt="Foto Profil"
                            style="width: 36px; min-width: 36px; height: 36px; border: 1px solid var(--border-color); border-radius: 8px; object-fit: cover; background: #fff;">
                    @else
                        <div
                            style="width: 36px; min-width: 36px; height: 36px; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 8px; color: var(--accent-primary); display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 800;">
                            {{ $sidebarInitial }}
                        </div>
                    @endif
                    <div style="min-width: 0; flex: 1;">
                        <div
                            style="font-weight: 700; color: var(--text-primary); font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $sidebarName }}
                        </div>
                        <div
                            style="color: var(--text-secondary); font-size: 12px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $sidebarEmail }}
                        </div>
                    </div>
                </div>
                <button onclick="document.getElementById('profile-sidebar').classList.remove('active')"
                    style="background: transparent; border: none; width: 30px; min-width: 30px; height: 30px; color: var(--text-secondary); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.2s; margin-left: 8px;"
                    onmouseover="this.style.color='var(--text-primary)'"
                    onmouseout="this.style.color='var(--text-secondary)'"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="sidebar-content" style="padding: 15px 0; flex-grow: 1; overflow-y: auto;">
                @if (Auth::user()->role === 'admin')
                    @include('partials.sidebar.admin')
                @elseif (Auth::user()->role === 'instructor')
                    @include('partials.sidebar.instructor')
                @else
                    @include('partials.sidebar.student')
                @endif
            </div>

            <div style="width: 100%; border-top: 1px solid var(--border-color); padding: 15px 0; background: #fff;">
                <a href="{{ route('logout') }}" class="sidebar-link" style="color: #ef4444;"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket" style="color: #ef4444;"></i> Keluar Akun
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <div id="sidebar-overlay" onclick="document.getElementById('profile-sidebar').classList.remove('active')"></div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dropdowns = document.querySelectorAll('.sidebar-dropdown');
                dropdowns.forEach(dropdown => {
                    dropdown.addEventListener('click', function() {
                        this.classList.toggle('active');
                    });
                });
            });
        </script>
    @endauth
    </div>
    </nav>

    <main>
        @auth @include('partials.announcements') @endauth

        <!-- Global Neo-Brutalist Toasts -->
        <div id="toast-container"
            style="position: fixed; top: 100px; right: 30px; z-index: 9999; display: flex; flex-direction: column; gap: 15px; pointer-events: none;">
            @if (session('success') || session('success_rating'))
                <div class="nb-toast success">
                    <div class="nb-toast-icon"><i class="fa-solid fa-check"></i></div>
                    <div class="nb-toast-content">
                        <div class="nb-toast-title">Success!</div>
                        <div class="nb-toast-message">{{ session('success') ?? session('success_rating') }}</div>
                    </div>
                    <button class="nb-toast-close" onclick="this.parentElement.remove()"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if (session('error'))
                <div class="nb-toast error">
                    <div class="nb-toast-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="nb-toast-content">
                        <div class="nb-toast-title">Error!</div>
                        <div class="nb-toast-message">{{ session('error') }}</div>
                    </div>
                    <button class="nb-toast-close" onclick="this.parentElement.remove()"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="nb-toast error">
                    <div class="nb-toast-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="nb-toast-content">
                        <div class="nb-toast-title">Validation Error!</div>
                        <div class="nb-toast-message">{{ $errors->first() }}</div>
                    </div>
                    <button class="nb-toast-close" onclick="this.parentElement.remove()"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
            @endif
        </div>

        <style>
            .nb-toast {
                background: #fff;
                border: 4px solid #000;
                padding: 15px 20px;
                display: flex;
                align-items: center;
                gap: 15px;
                min-width: 320px;
                max-width: 450px;
                position: relative;
                pointer-events: auto;
                animation: toastIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            }

            .nb-toast.success {
                box-shadow: 8px 8px 0px 0px #22c55e;
            }

            .nb-toast.error {
                box-shadow: 8px 8px 0px 0px #ef4444;
            }

            .nb-toast-icon {
                width: 40px;
                height: 40px;
                border: 3px solid #000;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                background: #000;
                color: #fff;
            }

            .nb-toast.success .nb-toast-icon {
                background: #22c55e;
            }

            .nb-toast.error .nb-toast-icon {
                background: #ef4444;
            }

            .nb-toast-content {
                flex-grow: 1;
            }

            .nb-toast-title {
                font-weight: 950;
                text-transform: uppercase;
                font-size: 14px;
                margin-bottom: 2px;
                letter-spacing: 1px;
            }

            .nb-toast-message {
                font-size: 12px;
                font-weight: 700;
                color: #475569;
                line-height: 1.4;
            }

            .nb-toast-close {
                background: transparent;
                border: none;
                cursor: pointer;
                font-size: 16px;
                color: #94a3b8;
                transition: 0.2s;
            }

            .nb-toast-close:hover {
                color: #000;
                transform: rotate(90deg);
            }

            @keyframes toastIn {
                from {
                    transform: translateX(120%);
                }

                to {
                    transform: translateX(0);
                }
            }

            @keyframes toastOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }

                to {
                    transform: translateX(120%);
                    opacity: 0;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toasts = document.querySelectorAll('.nb-toast');
                toasts.forEach(toast => {
                    setTimeout(() => {
                        toast.style.animation = 'toastOut 0.4s ease-in forwards';
                        setTimeout(() => toast.remove(), 400);
                    }, 5000);
                });
            });

            // Global Neo-Brutalist Confirmation
            function nbConfirm(message, callback) {
                const modal = document.createElement('div');
                modal.className = 'nb-confirm-overlay';
                modal.innerHTML = `
                    <div class="nb-confirm-modal">
                        <div class="nb-confirm-icon"><i class="fa-solid fa-circle-question"></i></div>
                        <h3 class="nb-confirm-title">Konfirmasi Tindakan</h3>
                        <p class="nb-confirm-message">${message}</p>
                        <div class="nb-confirm-actions">
                            <button class="nb-confirm-btn cancel">Batal</button>
                            <button class="nb-confirm-btn confirm">Ya, Lanjutkan</button>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);

                const confirmBtn = modal.querySelector('.confirm');
                const cancelBtn = modal.querySelector('.cancel');

                confirmBtn.onclick = () => {
                    modal.classList.add('closing');
                    setTimeout(() => {
                        modal.remove();
                        callback();
                    }, 300);
                };

                cancelBtn.onclick = () => {
                    modal.classList.add('closing');
                    setTimeout(() => modal.remove(), 300);
                };
            }
        </script>

        <style>
            .nb-confirm-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(4px);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                animation: fadeIn 0.2s ease-out;
            }

            .nb-confirm-modal {
                background: #fff;
                border: 4px solid #000;
                padding: 40px;
                max-width: 400px;
                width: 90%;
                text-align: center;
                box-shadow: 15px 15px 0px 0px var(--accent-primary);
                animation: popIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            .nb-confirm-overlay.closing {
                opacity: 0;
                transition: 0.3s;
            }

            .nb-confirm-overlay.closing .nb-confirm-modal {
                transform: scale(0.9);
                opacity: 0;
                transition: 0.3s;
            }

            .nb-confirm-icon {
                font-size: 50px;
                color: #000;
                margin-bottom: 20px;
            }

            .nb-confirm-title {
                font-weight: 950;
                text-transform: uppercase;
                letter-spacing: -1px;
                font-size: 20px;
                margin-bottom: 10px;
            }

            .nb-confirm-message {
                font-weight: 700;
                color: #64748b;
                font-size: 14px;
                margin-bottom: 30px;
                line-height: 1.5;
            }

            .nb-confirm-actions {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }

            .nb-confirm-btn {
                padding: 12px;
                font-weight: 950;
                text-transform: uppercase;
                border: 3px solid #000;
                cursor: pointer;
                transition: 0.2s;
                font-size: 13px;
            }

            .nb-confirm-btn.cancel {
                background: #fff;
                color: #000;
            }

            .nb-confirm-btn.confirm {
                background: #000;
                color: #fff;
                box-shadow: 4px 4px 0px 0px var(--accent-primary);
            }

            .nb-confirm-btn:hover {
                transform: translate(-2px, -2px);
            }

            .nb-confirm-btn.cancel:hover {
                box-shadow: 4px 4px 0px 0px #cbd5e1;
            }

            .nb-confirm-btn.confirm:hover {
                box-shadow: 6px 6px 0px 0px var(--accent-primary);
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes popIn {
                from {
                    transform: scale(0.8);
                    opacity: 0;
                }

                to {
                    transform: scale(1);
                    opacity: 1;
                }
            }
        </style>

        @yield('content')
    </main>

    @auth
        <script>
            // Notification Center Logic
            const notifBell = document.getElementById('notif-bell');
            const notifDropdown = document.getElementById('notif-dropdown');
            const notifCount = document.getElementById('notif-count');
            const notifList = document.getElementById('notif-list');
            const markAllRead = document.getElementById('mark-all-read');

            if (notifBell) {
                notifBell.addEventListener('click', (e) => {
                    e.stopPropagation();
                    notifDropdown.classList.toggle('active');
                    if (notifDropdown.classList.contains('active')) {
                        fetchNotifications();
                    }
                });
            }

            document.addEventListener('click', (e) => {
                if (notifDropdown && !notifDropdown.contains(e.target) && e.target !== notifBell) {
                    notifDropdown.classList.remove('active');
                }
            });

            async function fetchNotifications() {
                try {
                    const response = await fetch('{{ route('notifications.get') }}');
                    const data = await response.json();
                    
                    if (data.count > 0) {
                        notifCount.innerText = data.count;
                        notifCount.style.display = 'flex';
                    } else {
                        notifCount.style.display = 'none';
                    }

                    if (data.notifications.length > 0) {
                        notifList.innerHTML = data.notifications.map(n => `
                            <a href="${n.link || '#'}" class="notif-item ${n.read_at ? '' : 'unread'}" onclick="markAsRead('${n.id}')">
                                <div class="notif-icon">
                                    <i class="${n.icon || 'fa-solid fa-bell'}"></i>
                                </div>
                                <div class="notif-content">
                                    <div class="notif-title">${n.title}</div>
                                    <div class="notif-text">${n.message}</div>
                                    <span class="notif-time">${n.created_at_human}</span>
                                </div>
                            </a>
                        `).join('');
                    } else {
                        notifList.innerHTML = '<div class="notif-empty">Belum ada notifikasi.</div>';
                    }
                } catch (err) {
                    console.error('Failed to fetch notifications:', err);
                }
            }

            async function markAsRead(id) {
                await fetch(`/notifications/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            }

            if (markAllRead) {
                markAllRead.addEventListener('click', async () => {
                    await fetch('{{ route('notifications.markAllRead') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    fetchNotifications();
                });
            }

            // Initial check
            fetchNotifications();
            // Polling for real-time feel
            setInterval(fetchNotifications, 60000);
        </script>
    @endauth
    @stack('scripts')
</body>

</html>
