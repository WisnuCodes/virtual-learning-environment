@php
    $userRole = Auth::user()->role;
    $activeAnnouncements = \App\Models\Announcement::where('is_active', true)
        ->where(function ($query) use ($userRole) {
            $query->where('target_role', 'all')->orWhere('target_role', $userRole);
        })
        ->where(function ($query) {
            $query->whereNull('starts_at')->orWhere('starts_at', '<=', now());
        })
        ->where(function ($query) {
            $query->whereNull('ends_at')->orWhere('ends_at', '>=', now());
        })
        ->latest()
        ->get();
@endphp

@if ($activeAnnouncements->isNotEmpty())
    <div id="ann-global-container"
        style="position: fixed; top: 0; left: 0; width: 100%; z-index: 999999; pointer-events: none; padding-top: 25px;">
        <style>
            @keyframes announcement-drop {
                0% { transform: translateY(-100%) scale(0.95); opacity: 0; }
                100% { transform: translateY(0) scale(1); opacity: 1; }
            }

            .premium-ann-card {
                pointer-events: auto;
                background: #ffffff;
                border: 2px solid #000000;
                width: 90%;
                max-width: 700px;
                margin: 0 auto 15px;
                display: flex;
                flex-direction: column;
                animation: announcement-drop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) both;
                box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.2), 10px 10px 0px #000000;
                position: relative;
            }

            .ann-top-strip {
                height: 6px;
                width: 100%;
            }

            .ann-main-content {
                padding: 25px 35px;
                display: flex;
                gap: 25px;
                align-items: flex-start;
            }

            .ann-visual-icon {
                width: 56px;
                height: 56px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                flex-shrink: 0;
                border: 2px solid #000;
            }

            .ann-text-group {
                flex-grow: 1;
            }

            .ann-system-label {
                font-size: 10px;
                font-weight: 900;
                color: #64748b;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 5px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .ann-system-label span {
                width: 8px;
                height: 8px;
                border-radius: 50%;
            }

            .ann-display-title {
                font-size: 22px;
                font-weight: 900;
                color: #000;
                margin: 0 0 10px;
                text-transform: uppercase;
                letter-spacing: -0.5px;
                line-height: 1.1;
            }

            .ann-display-message {
                font-size: 15px;
                color: #334155;
                margin: 0;
                line-height: 1.6;
                font-weight: 500;
                word-break: break-word;
                overflow-wrap: break-word;
            }

            .ann-close-anchor {
                position: absolute;
                top: 15px;
                right: 15px;
                background: #f1f5f9;
                border: 2px solid #000;
                width: 32px;
                height: 32px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: 0.2s;
                color: #000;
                font-size: 16px;
            }

            .ann-close-anchor:hover {
                background: #ef4444;
                color: #fff;
                transform: rotate(90deg);
            }

            .ann-footer-meta {
                background: #f8fafc;
                border-top: 1px solid #e2e8f0;
                padding: 10px 35px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .meta-item {
                font-size: 10px;
                font-weight: 800;
                color: #94a3b8;
                text-transform: uppercase;
            }

            .ann-type-desc {
                font-size: 11px;
                font-weight: 900;
                padding: 2px 10px;
                color: #fff;
                border-radius: 0;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-top: 5px;
                display: inline-block;
            }
        </style>

        @foreach ($activeAnnouncements as $ann)
            @php
                $accentColor = '#3b82f6';
                $icon = 'fa-satellite-dish';
                $typeText = 'PENGUMUMAN';
                $roleLabel = $ann->target_role === 'all' ? 'SEMUA PENGGUNA' : strtoupper($ann->target_role);

                if ($ann->type === 'critical') {
                    $accentColor = '#e11d48';
                    $icon = 'fa-circle-exclamation';
                    $typeText = 'PERINGATAN KRITIS';
                } elseif ($ann->type === 'warning') {
                    $accentColor = '#f59e0b';
                    $icon = 'fa-triangle-exclamation';
                    $typeText = 'INFORMASI PENTING';
                } elseif ($ann->type === 'success') {
                    $accentColor = '#10b981';
                    $icon = 'fa-circle-check';
                    $typeText = 'BERHASIL';
                }
            @endphp
            <div class="premium-ann-card" id="ann-card-{{ $ann->id }}">
                <div class="ann-top-strip" style="background: {{ $accentColor }};"></div>

                <button class="ann-close-anchor"
                    onclick="document.getElementById('ann-card-{{ $ann->id }}').remove()" title="Close Alert">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <div class="ann-main-content">
                    <div class="ann-visual-icon" style="color: {{ $accentColor }}; border-color: {{ $accentColor }};">
                        <i class="fa-solid {{ $icon }}"></i>
                    </div>

                    <div class="ann-text-group">
                        <div class="ann-system-label">
                            <span style="background: {{ $accentColor }};"></span> STATUS SISTEM:
                            <div class="ann-type-desc" style="background: {{ $accentColor }};">
                                {{ $typeText }}
                            </div>
                        </div>
                        <h4 class="ann-display-title">{{ $ann->title }}</h4>
                        <p class="ann-display-message">{!! nl2br(e($ann->message)) !!}</p>
                    </div>
                </div>

                <div class="ann-footer-meta">
                    <div class="meta-item">
                        <i class="fa-solid fa-users" style="margin-right: 5px;"></i> TARGET: {{ $roleLabel }}
                    </div>
                    <div class="meta-item">
                        <i class="fa-regular fa-clock" style="margin-right: 5px;"></i> DIPUBLIKASIKAN {{ $ann->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
