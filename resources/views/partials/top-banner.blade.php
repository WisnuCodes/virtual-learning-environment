@php
    $activeBanner = \App\Models\Banner::where('is_active', true)->first();
@endphp

@if($activeBanner)
<div id="premium-top-banner" class="premium-banner-wrapper">
    <div class="banner-container">
        <!-- Static Left -->
        <div class="banner-left">
            <div class="banner-badge-premium">
                <span class="badge-inner">{{ $activeBanner->badge_text }}</span>
            </div>
            <span class="banner-emoji">{{ $activeBanner->emoji }}</span>
        </div>

        <!-- Scrolling Middle -->
        <div class="banner-scrolling-area">
            <div class="banner-marquee-track">
                <span class="banner-msg"><span class="banner-title">{{ $activeBanner->title }}</span> {{ $activeBanner->message }}</span>
                <span class="banner-msg"><span class="banner-title">{{ $activeBanner->title }}</span> {{ $activeBanner->message }}</span>
            </div>
        </div>

        <!-- Static Right -->
        <div class="banner-right">
            @if($activeBanner->button_link)
            <a href="{{ $activeBanner->button_link }}" class="banner-cta-btn">
                {{ $activeBanner->button_text }} <i class="fa-solid fa-bolt"></i>
            </a>
            @endif
            <button class="banner-close-trigger" onclick="document.getElementById('premium-top-banner').classList.add('hide-banner')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</div>
@endif

<style>
    .premium-banner-wrapper {
        background: #0f172a;
        color: #fff;
        padding: 8px 5%;
        border-bottom: 3px solid #000;
        position: sticky;
        top: 73px;
        z-index: 99;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
    }

    .premium-banner-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent 0%, rgba(16, 185, 129, 0.1) 50%, transparent 100%);
        animation: banner-shimmer 3s infinite linear;
    }

    @keyframes banner-shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .premium-banner-wrapper.hide-banner {
        transform: translateY(-100%);
        opacity: 0;
        pointer-events: none;
        margin-bottom: -50px;
    }

    .banner-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 1;
        gap: 20px;
    }

    .banner-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .banner-badge-premium {
        background: #f43f5e;
        color: #fff;
        padding: 4px 12px;
        font-weight: 950;
        font-size: 11px;
        letter-spacing: 1px;
        border: 2px solid #000;
        box-shadow: 4px 4px 0px #000;
        transform: rotate(-2deg);
        animation: badge-bounce 2s infinite ease-in-out;
    }

    @keyframes badge-bounce {
        0%, 100% { transform: rotate(-2deg) scale(1); }
        50% { transform: rotate(2deg) scale(1.05); }
    }

    .banner-scrolling-area {
        flex: 1;
        overflow: hidden;
        display: flex;
        align-items: center;
        mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
    }

    .banner-marquee-track {
        display: flex;
        align-items: center;
        gap: 80px;
        white-space: nowrap;
        animation: banner-scroll-seamless 25s linear infinite;
        padding-left: 20px;
    }

    .banner-msg {
        color: #f1f5f9;
        font-weight: 700;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .banner-title {
        color: #fbbf24;
        text-transform: uppercase;
        font-weight: 950;
        background: #000;
        padding: 2px 6px;
        border: 1px solid #fbbf24;
    }

    .banner-emoji {
        font-size: 18px;
        flex-shrink: 0;
        animation: emoji-shake 1.5s infinite ease-in-out;
    }

    @keyframes emoji-shake {
        0%, 100% { transform: rotate(0); }
        25% { transform: rotate(-15deg); }
        75% { transform: rotate(15deg); }
    }

    @keyframes banner-scroll-seamless {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .banner-right {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-shrink: 0;
    }

    .banner-cta-btn {
        background: #10b981;
        color: #000;
        padding: 6px 18px;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        border: 2px solid #000;
        box-shadow: 4px 4px 0px #000;
        transition: all 0.2s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .banner-cta-btn:hover {
        background: #fff;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px #000;
        color: #000;
    }

    .banner-cta-btn:active {
        transform: translate(2px, 2px);
        box-shadow: 0px 0px 0px #000;
    }

    .banner-close-trigger {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        font-size: 16px;
        transition: 0.2s;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .banner-close-trigger:hover {
        color: #fff;
        transform: rotate(90deg);
    }

    @media (max-width: 900px) {
        .banner-msg {
            display: none;
        }
        .banner-container {
            justify-content: center;
        }
    }
</style>
