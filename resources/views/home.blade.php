@extends('layouts.app')

@section('content')
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 12px; }
        ::-webkit-scrollbar-track { background: #fff; border-left: 3px solid #000; }
        ::-webkit-scrollbar-thumb { background: #000; border: 3px solid #fff; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent-primary); }

        /* Enhanced Neo-Brutalist Styles */
        .nb-hero {
            background-color: var(--bg-primary);
            padding: 80px 5% 60px;
            border-bottom: 4px solid #000;
            position: relative;
            overflow: hidden;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .nb-hero::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: var(--accent-primary);
            border: 4px solid #000;
            border-radius: 50%;
            z-index: 1;
        }

        .hero-container {
            max-width: 1300px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 60px;
            align-items: center;
        }

        .hero-badge-row {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .nb-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #000;
            background: #fff;
            border: 3px solid #000;
            padding: 8px 16px;
            box-shadow: 4px 4px 0px 0px #000;
        }

        .nb-badge.accent {
            background: #fef08a; /* Yellow */
        }

        .nb-badge.blue {
            background: #bae6fd; /* Blue */
        }

        .nb-hero h1 {
            font-size: 42px;
            font-weight: 950;
            color: #000;
            line-height: 0.9;
            letter-spacing: -1.5px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .nb-hero h1 span {
            color: var(--accent-primary);
            -webkit-text-stroke: 2px #000;
        }

        .nb-hero p {
            font-size: 14px;
            color: #000;
            line-height: 1.4;
            max-width: 450px;
            margin-bottom: 30px;
            font-weight: 700;
            background: #fff;
            border: 3px solid #000;
            padding: 15px;
            box-shadow: 4px 4px 0px 0px #000;
        }

        .nb-btn-group {
            display: flex;
            gap: 20px;
        }

        /* Floating Shapes Animation */
        .floating-shape {
            position: absolute;
            z-index: 0;
            opacity: 0.1;
            pointer-events: none;
            animation: floatShape 8s ease-in-out infinite;
        }

        @keyframes floatShape {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(15deg); }
        }

        /* Premium Navbar Override - Match Global */
        .navbar {
            box-shadow: none !important;
            border-bottom: 3px solid #000 !important;
        }

        .hero-badge-row {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .nb-btn-primary {
            background: var(--accent-primary);
            color: #fff;
            border: 3px solid #000;
            padding: 15px 30px;
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 6px 6px 0px 0px #000;
            text-decoration: none;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .nb-btn-primary:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000;
            color: #fff;
        }

        .nb-btn-outline {
            background: #fff;
            color: #000;
            border: 3px solid #000;
            padding: 15px 30px;
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 6px 6px 0px 0px #000;
            text-decoration: none;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .nb-btn-outline:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000;
            background: #f8fafc;
        }

        /* Hero Visual Column */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .visual-box {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border: 4px solid #000;
            padding: 30px;
            box-shadow: 15px 15px 0px 0px var(--accent-primary);
            position: relative;
            z-index: 5;
        }

        .visual-box::after {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            width: 100%;
            height: 100%;
            border: 4px solid #000;
            background: #bae6fd;
            z-index: -1;
        }

        .stat-card {
            background: #fff;
            border: 3px solid #000;
            padding: 15px;
            position: absolute;
            box-shadow: 6px 6px 0px 0px #000;
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stat-1 { top: -20px; right: -20px; background: #fef08a; }
        .stat-2 { bottom: -10px; left: -40px; background: #ecfdf5; }

        /* Marquee */
        .marquee-container {
            background: #000;
            color: #fff;
            padding: 15px 0;
            border-top: 4px solid #000;
            border-bottom: 4px solid #000;
            overflow: hidden;
            white-space: nowrap;
        }

        .marquee-content {
            display: inline-block;
            animation: marquee 30s linear infinite;
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .marquee-content span {
            margin: 0 40px;
        }

        /* Segment Bar */
        .segment-bar {
            background: #fff;
            border-bottom: 3px solid #000;
            padding: 15px 5%;
            position: sticky;
            top: 73px;
            z-index: 100;
        }

        .segment-container {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .segment-label {
            font-size: 11px;
            font-weight: 950;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .segment-list {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: 5px;
        }

        .segment-list::-webkit-scrollbar { display: none; }

        .segment-pill {
            padding: 6px 15px;
            font-size: 11px;
            font-weight: 950;
            color: #000;
            background: #fff;
            border: 2px solid #000;
            text-decoration: none;
            text-transform: uppercase;
            white-space: nowrap;
            transition: 0.2s;
            box-shadow: 3px 3px 0px 0px #000;
        }

        .segment-pill:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px #000;
            background: #f8fafc;
        }

        .segment-pill.active {
            background: var(--accent-primary);
            color: #fff;
            box-shadow: 3px 3px 0px #000;
            transform: translate(-1px, -1px);
        }

        /* Knowledge Index Grid */
        .index-wrapper {
            background-color: var(--bg-secondary);
            padding: 60px 0;
        }

        .index-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 5%;
        }

        .index-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
            border-bottom: 4px solid #000;
            padding-bottom: 20px;
        }

        .index-title {
            font-size: 24px;
            font-weight: 950;
            text-transform: uppercase;
            color: #000;
            margin: 0;
            letter-spacing: -1px;
        }

        .asset-card {
            background: #fff;
            border: 3px solid #000;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 6px 6px 0px 0px #000;
        }

        .asset-card:hover {
            box-shadow: 14px 14px 0px 0px var(--accent-primary);
            transform: translate(-6px, -6px);
        }

        .asset-thumb {
            height: 150px;
            overflow: hidden;
            position: relative;
            background: #000;
            border-bottom: 3px solid #000;
        }

        .asset-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.95;
            transition: 0.5s;
        }

        .asset-card:hover .asset-thumb img {
            transform: scale(1.08) rotate(1deg);
        }

        .asset-tag {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #fff;
            color: #000;
            font-size: 9px;
            font-weight: 900;
            padding: 4px 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 10;
            border: 2px solid #000;
            box-shadow: 2px 2px 0px 0px #000;
        }

        .asset-body {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .asset-author {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            background: #f1f5f9;
            padding: 6px 10px;
            border: 2px solid #000;
        }

        .author-box {
            width: 20px;
            height: 20px;
            background: #000;
            color: #fff;
            font-size: 10px;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 2px 2px 0px 0px var(--accent-primary);
        }

        .author-name {
            font-size: 10px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
        }

        .asset-title {
            font-size: 15px;
            font-weight: 900;
            color: #000;
            line-height: 1.2;
            margin-bottom: 15px;
            text-decoration: none;
            display: block;
            text-transform: uppercase;
            min-height: 36px;
        }

        .asset-price-bar {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 2px dashed #000;
        }

        .asset-price {
            font-size: 18px;
            font-weight: 950;
            color: #000;
            background: #fff;
            padding: 4px 12px;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
        }

        .asset-btn {
            background: #000;
            color: #fff;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            padding: 10px 16px;
            text-decoration: none;
            letter-spacing: 1px;
            transition: 0.2s;
            border: 2px solid #000;
            box-shadow: 3px 3px 0px 0px var(--accent-primary);
        }

        .asset-btn:hover {
            background: #fff;
            color: #000;
            transform: translate(-3px, -3px);
            box-shadow: 7px 7px 0px 0px var(--accent-primary);
        }

        /* Sticker Styles */
        .nb-sticker {
            position: absolute;
            background: var(--accent-primary);
            color: #000;
            padding: 5px 12px;
            font-size: 10px;
            font-weight: 950;
            text-transform: uppercase;
            border: 2px solid #000;
            box-shadow: 3px 3px 0px #000;
            z-index: 20;
            transform: rotate(-10deg);
            pointer-events: none;
        }

        .asset-card:nth-child(3n) .nb-sticker { background: #bae6fd; transform: rotate(5deg); }
        .asset-card:nth-child(4n) .nb-sticker { background: #fef08a; transform: rotate(-5deg); }

        @media (max-width: 1024px) {
            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 80px;
            }
            .nb-hero h1 { font-size: 56px; }
            .nb-hero p { margin-left: auto; margin-right: auto; }
            .nb-btn-group { justify-content: center; }
            .hero-visual { padding-top: 40px; }
            .hero-badge-row { justify-content: center; }
            .grid-4 { grid-template-columns: repeat(2, 1fr) !important; }
            .grid-footer { grid-template-columns: 1fr 1fr !important; }
        }

        @media (max-width: 768px) {
            .nb-hero h1 { font-size: 42px; letter-spacing: -2px; }
            .index-header { flex-direction: column; align-items: flex-start; gap: 20px; }
            .nb-btn-group { flex-direction: column; width: 100%; gap: 15px; }
            .nb-btn-primary, .nb-btn-outline { width: 100%; justify-content: center; box-sizing: border-box; }
            .stat-1 { right: 0; transform: scale(0.85); transform-origin: top right; }
            .stat-2 { left: 0; transform: scale(0.85); transform-origin: bottom left; }
            .search-container { margin-left: auto; margin-right: auto; }
            .search-input { width: 100%; box-sizing: border-box; }
            .grid-4 { grid-template-columns: 1fr !important; }
            .grid-2 { grid-template-columns: 1fr !important; text-align: center; }
            .grid-footer { grid-template-columns: 1fr !important; }
            .why-choose-us { grid-template-columns: 1fr !important; }
            .why-choose-us-content { text-align: left; }
            .footer-bottom { flex-direction: column; gap: 15px; text-align: center; justify-content: center !important; }
            .asset-price-bar { flex-direction: column; gap: 10px; align-items: stretch; text-align: center; }
            .asset-btn { width: 100%; box-sizing: border-box; }
        }
        /* Testimonial Slider */
        .testimonial-wrapper {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding: 20px 0;
        }

        .testimonial-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            gap: 30px;
        }

        .testimonial-card {
            min-width: 100%;
            background: #fff;
            border: 4px solid #000;
            padding: 40px;
            box-shadow: 10px 10px 0px 0px var(--accent-primary);
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 40px;
            align-items: center;
        }

        .testimonial-user-box {
            width: 180px;
            height: 180px;
            border: 4px solid #000;
            background: #f1f5f9;
            box-shadow: 6px 6px 0px 0px #000;
            overflow: hidden;
        }

        .testimonial-quote {
            font-size: 24px;
            font-weight: 950;
            line-height: 1.3;
            color: #000;
            margin-bottom: 25px;
            position: relative;
            text-transform: uppercase;
        }

        .testimonial-quote::before {
            content: '"';
            font-size: 80px;
            position: absolute;
            top: -40px;
            left: -20px;
            opacity: 0.1;
            color: var(--accent-primary);
        }

        .slider-controls {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
        }

        .slider-btn {
            width: 50px;
            height: 50px;
            background: #fff;
            border: 3px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 4px 4px 0px 0px #000;
            transition: 0.2s;
        }

        .slider-btn:hover {
            background: var(--accent-primary);
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #000;
        }

        @media (max-width: 768px) {
            .testimonial-card {
                grid-template-columns: 1fr;
                text-align: center;
                padding: 30px;
            }
            .testimonial-user-box {
                margin: 0 auto;
            }
        }
    </style>

    <!-- Partner Marquee (Top) -->
    <div style="background: #fff; border-bottom: 4px solid #000; padding: 20px 0; overflow: hidden; white-space: nowrap;">
        <div class="marquee-content" style="animation-duration: 40s;">
            @foreach(['GOOGLE', 'MICROSOFT', 'AMAZON', 'META', 'TESLA', 'ADOBE', 'SAMSUNG', 'INTEL'] as $partner)
                <span style="font-size: 24px; font-weight: 950; color: #cbd5e1; margin: 0 60px;">{{ $partner }}</span>
            @endforeach
        </div>
    </div>

    <section class="nb-hero" style="position: relative; overflow: hidden; background-attachment: fixed;">
        <!-- Floating Elements -->
        <div class="floating-shape" style="top: 5%; right: 10%; color: var(--accent-primary); font-size: 140px; animation-duration: 10s;"><i class="fa-solid fa-code"></i></div>
        <div class="floating-shape" style="bottom: 10%; left: 5%; color: #bae6fd; font-size: 110px; animation-delay: 1s; animation-duration: 12s;"><i class="fa-solid fa-graduation-cap"></i></div>
        <div class="floating-shape" style="top: 40%; left: 40%; color: #fef08a; font-size: 70px; animation-delay: 2s; animation-duration: 9s;"><i class="fa-solid fa-terminal"></i></div>
        <div class="floating-shape" style="bottom: 30%; right: 20%; color: #fda4af; font-size: 90px; animation-delay: 3s; animation-duration: 11s;"><i class="fa-solid fa-cubes"></i></div>

        <div class="hero-container" style="position: relative; z-index: 10;">
            <div>
                <div class="hero-badge-row">
                    <div class="nb-badge accent">
                        <i class="fa-solid fa-bolt"></i> Fast Learning
                    </div>
                    <div class="nb-badge blue">
                        <i class="fa-solid fa-shield-check"></i> Certified
                    </div>
                    <div class="nb-badge">
                        <i class="fa-solid fa-globe"></i> Global Access
                    </div>
                </div>
                
                <h1>Kuasai <br><span style="color: var(--accent-primary); position: relative; display: inline-block;">Masa Depan <span style="position: absolute; bottom: 5px; left: 0; width: 100%; height: 8px; background: var(--accent-primary); opacity: 0.2; z-index: -1;"></span></span> <br>Digital Anda.</h1>
                
                <p>Eksplorasi ribuan materi pembelajaran premium yang dirancang oleh pakar industri. Bangun keahlianmu hari ini dengan kurikulum paling progresif di Indonesia.</p>
                
                <div style="margin-bottom: 50px; position: relative; max-width: 500px;" class="search-container">
                    <form action="{{ route('home') }}" method="GET">
                        <input type="text" name="search" class="search-input" placeholder="Cari kursus impianmu..." style="width: 100%; padding: 20px 30px; border: 3px solid #000; font-weight: 900; font-size: 16px; box-shadow: 6px 6px 0px 0px #000; outline: none; box-sizing: border-box;">
                        <button type="submit" style="position: absolute; right: 10px; top: 10px; background: #000; color: #fff; border: none; padding: 10px 20px; font-weight: 900; cursor: pointer; text-transform: uppercase; font-size: 12px; transition: 0.2s;">Search</button>
                    </form>
                </div>

                <div class="nb-btn-group">
                    <a href="{{ route('courses.index') }}" class="nb-btn-primary">
                        MULAI BELAJAR <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                    <a href="{{ route('register') }}" class="nb-btn-outline">
                        BERGABUNG SEKARANG <i class="fa-solid fa-user-plus"></i>
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="visual-box">
                    <div style="font-size: 14px; font-weight: 900; margin-bottom: 20px; text-transform: uppercase;">
                        <i class="fa-solid fa-circle" style="color: #ef4444; font-size: 10px;"></i> Platform Live Status
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <div style="height: 12px; background: #000; width: 100%;"></div>
                        <div style="height: 12px; background: #000; width: 80%;"></div>
                        <div style="height: 12px; background: #000; width: 90%;"></div>
                    </div>
                    <div style="margin-top: 30px; display: flex; align-items: flex-end; justify-content: space-between;">
                        <div style="width: 60px; height: 60px; background: var(--accent-primary); border: 3px solid #000; box-shadow: 4px 4px 0px 0px #000;"></div>
                        <div style="font-size: 24px; font-weight: 950; text-transform: uppercase;">100% Quality</div>
                    </div>
                </div>

                <!-- Floating Stats -->
                <div class="stat-card stat-1">
                    <i class="fa-solid fa-users" style="font-size: 20px;"></i>
                    <div>
                        <div style="font-size: 18px; font-weight: 900;">12K+</div>
                        <div style="font-size: 10px; font-weight: 800; text-transform: uppercase;">Active Students</div>
                    </div>
                </div>
                <div class="stat-card stat-2">
                    <i class="fa-solid fa-star" style="color: #fbbf24; font-size: 20px;"></i>
                    <div>
                        <div style="font-size: 18px; font-weight: 900;">{{ number_format($avgLmsRating, 1) }}/5</div>
                        <div style="font-size: 10px; font-weight: 800; text-transform: uppercase;">LMS Platform Rating</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative elements -->
        <div style="position: absolute; bottom: 40px; left: 5%; font-size: 120px; font-weight: 950; color: rgba(0,0,0,0.05); text-transform: uppercase; z-index: 1; pointer-events: none; letter-spacing: -5px;">
            PROGRESS
        </div>
    </section>

    <div class="marquee-container" style="background: #fbbf24; border-bottom: none;">
        <div class="marquee-content" style="color: #000;">
            @for($i=0; $i<10; $i++)
                <span><i class="fa-solid fa-star"></i> BEST SELLER 2026</span>
                <span><i class="fa-solid fa-star"></i> TRUSTED PLATFORM</span>
                <span><i class="fa-solid fa-star"></i> INDUSTRY READY</span>
                <span><i class="fa-solid fa-star"></i> 24/7 SUPPORT</span>
            @endfor
        </div>
    </div>
    <div class="marquee-container">
        <div class="marquee-content" style="animation-direction: reverse;">
            @for($i=0; $i<10; $i++)
                <span><i class="fa-solid fa-circle-check"></i> KURIKULUM TERUPDATE</span>
                <span><i class="fa-solid fa-circle-check"></i> MENTOR PROFESIONAL</span>
                <span><i class="fa-solid fa-circle-check"></i> SERTIFIKAT DIGITAL</span>
                <span><i class="fa-solid fa-circle-check"></i> AKSES SELAMANYA</span>
            @endfor
        </div>
    </div>

    <!-- Success Stories / Testimonial Slider -->
    <section style="padding: 80px 5%; background: #f8fafc; border-bottom: 3px solid #000; overflow: hidden; position: relative;">
        <div style="max-width: 1100px; margin: 0 auto; position: relative; z-index: 10;">
            <div style="text-align: center; margin-bottom: 50px;">
                <div style="font-size: 11px; font-weight: 900; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">Success Stories</div>
                <h2 style="font-size: 42px; font-weight: 950; text-transform: uppercase; letter-spacing: -2px;">Apa Kata <span style="color: var(--accent-primary);">Alumni Kami?</span></h2>
            </div>

            <div class="testimonial-wrapper">
                <div class="testimonial-track" id="testimonialTrack">
                    @php
                        $testimonials = [
                            [
                                'name' => 'Budi Santoso',
                                'role' => 'Fullstack Developer @ GoTo',
                                'quote' => 'Kurikulum di RuangKelas sangat berorientasi pada industri. Saya belajar dari nol hingga bisa menembus tech unicorn dalam 6 bulan!',
                                'color' => '#bae6fd',
                                'initial' => 'B'
                            ],
                            [
                                'name' => 'Siti Aminah',
                                'role' => 'UI/UX Designer @ Bukalapak',
                                'quote' => 'Mentor-mentornya sangat sabar dan detail. Review tugasnya benar-benar membantu saya mengasah insting desain saya.',
                                'color' => '#fef08a',
                                'initial' => 'S'
                            ],
                            [
                                'name' => 'Andi Wijaya',
                                'role' => 'Data Analyst @ Shopee',
                                'quote' => 'Akses selamanya sangat membantu saya untuk me-refresh materi saat saya butuh di pekerjaan sehari-hari. Investasi terbaik!',
                                'color' => '#ecfdf5',
                                'initial' => 'A'
                            ]
                        ];
                    @endphp

                    @foreach($testimonials as $t)
                        <div class="testimonial-card">
                            <div class="testimonial-user-box" style="background: {{ $t['color'] }};">
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 80px; font-weight: 950; color: #000; opacity: 0.5;">
                                    {{ $t['initial'] }}
                                </div>
                            </div>
                            <div class="testimonial-content">
                                <div style="color: #fbbf24; font-size: 20px; margin-bottom: 15px;">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                                <div class="testimonial-quote">
                                    {{ $t['quote'] }}
                                </div>
                                <div>
                                    <h4 style="font-weight: 950; font-size: 20px; text-transform: uppercase; margin: 0;">{{ $t['name'] }}</h4>
                                    <p style="font-weight: 800; color: var(--accent-primary); font-size: 13px; margin-top: 4px;">{{ $t['role'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="slider-controls">
                    <button class="slider-btn" onclick="moveSlider(-1)"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="slider-btn" onclick="moveSlider(1)"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
        <!-- Decorative bg text -->
        <div style="position: absolute; top: 20px; right: -50px; font-size: 150px; font-weight: 950; color: rgba(0,0,0,0.03); text-transform: uppercase; transform: rotate(5deg); pointer-events: none;">STORY</div>
    </section>

    <script>
        let currentSlide = 0;
        const track = document.getElementById('testimonialTrack');
        const totalSlides = {{ count($testimonials) }};

        function moveSlider(direction) {
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            updateSlider();
        }

        function updateSlider() {
            const offset = currentSlide * -100;
            track.style.transform = `translateX(${offset}%)`;
        }

        // Auto play
        let slideInterval = setInterval(() => {
            moveSlider(1);
        }, 8000);

        // Stop auto play on user interaction
        document.querySelectorAll('.slider-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                clearInterval(slideInterval);
            });
        });
    </script>

    <!-- How it Works Section -->
    <section style="padding: 50px 5%; background: #fff; border-bottom: 3px solid #000;">
        <div style="max-width: 1100px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 40px;">
                <div style="font-size: 11px; font-weight: 900; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">Workflow</div>
                <h2 style="font-size: 32px; font-weight: 950; text-transform: uppercase; letter-spacing: -1px;">Cara Memulai <span style="background: var(--bg-secondary); padding: 0 8px; border: 3px solid #000; box-shadow: 4px 4px 0px 0px var(--accent-primary);">Belajar</span></h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;" class="grid-4">
                @php
                    $steps = [
                        ['icon' => 'fa-user-plus', 'title' => 'Buat Akun', 'desc' => 'Daftar secara gratis dalam hitungan detik.', 'color' => '#bae6fd'],
                        ['icon' => 'fa-magnifying-glass', 'title' => 'Pilih Kursus', 'desc' => 'Temukan kurikulum yang sesuai passionmu.', 'color' => '#fef08a'],
                        ['icon' => 'fa-credit-card', 'title' => 'Transaksi', 'desc' => 'Akses instan setelah pembayaran terverifikasi.', 'color' => '#ecfdf5'],
                        ['icon' => 'fa-graduation-cap', 'title' => 'Belajar', 'desc' => 'Tingkatkan skill dan dapatkan sertifikat.', 'color' => '#fde68a']
                    ];
                @endphp

                @foreach($steps as $index => $step)
                    <div style="background: #fff; border: 4px solid #000; padding: 25px; box-shadow: 6px 6px 0px 0px #000; position: relative;">
                        <div style="position: absolute; top: -15px; left: 15px; background: #000; color: #fff; font-weight: 950; padding: 4px 10px; font-size: 16px; border: 2px solid #000;">0{{ $index + 1 }}</div>
                        <div style="width: 45px; height: 45px; background: {{ $step['color'] }}; border: 3px solid #000; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-bottom: 20px; box-shadow: 3px 3px 0px 0px #000;">
                            <i class="fa-solid {{ $step['icon'] }}"></i>
                        </div>
                        <h4 style="font-weight: 950; text-transform: uppercase; font-size: 16px; margin-bottom: 10px;">{{ $step['title'] }}</h4>
                        <p style="font-weight: 700; color: #475569; font-size: 12px; margin: 0;">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Global Stats Section -->
    <section style="padding: 30px 5%; background: #000; border-bottom: 3px solid #000;">
        <div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;" class="grid-4">
            <div style="text-align: center;">
                <div style="font-size: 28px; font-weight: 950; color: #fff;">150+</div>
                <div style="font-size: 10px; font-weight: 800; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 1px;">Kursus Pilihan</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 28px; font-weight: 950; color: #fff;">12,000+</div>
                <div style="font-size: 10px; font-weight: 800; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 1px;">Siswa Berhasil</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 28px; font-weight: 950; color: #fff;">45+</div>
                <div style="font-size: 10px; font-weight: 800; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 1px;">Partner Industri</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 28px; font-weight: 950; color: #fff;">98%</div>
                <div style="font-size: 10px; font-weight: 800; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 1px;">Kepuasan Alumni</div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us / Features -->
    <section style="padding: 50px 5%; background: #fff; border-bottom: 3px solid #000;">
        <div style="max-width: 1100px; margin: 0 auto;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;" class="why-choose-us">
                <div>
                    <div style="width: 100%; aspect-ratio: 1.4; background: #f8fafc; border: 3px solid #000; box-shadow: 8px 8px 0px 0px var(--accent-primary); display: flex; align-items: center; justify-content: center; position: relative;">
                        <i class="fa-solid fa-rocket" style="font-size: 80px; color: #000; transform: rotate(-15deg);"></i>
                        <div style="position: absolute; bottom: 15px; right: 15px; background: #fff; border: 2px solid #000; padding: 8px; font-weight: 950; font-size: 12px; box-shadow: 3px 3px 0px 0px var(--accent-primary);">ACCELERATED</div>
                    </div>
                </div>
                <div class="why-choose-us-content">
                    <div style="font-size: 11px; font-weight: 900; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">Core Features</div>
                    <h2 style="font-size: 32px; font-weight: 950; text-transform: uppercase; letter-spacing: -1px; margin-bottom: 25px;">Kenapa Harus <br><span style="background: #fff; padding: 0 10px; border: 3px solid #000; box-shadow: 4px 4px 0px 0px var(--accent-primary);">RuangKelas</span>?</h2>
                    
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        <div style="display: flex; gap: 20px;">
                            <div style="min-width: 50px; height: 50px; background: #fef08a; border: 3px solid #000; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 4px 4px 0px 0px #000;">
                                <i class="fa-solid fa-infinity"></i>
                            </div>
                            <div>
                                <h4 style="font-weight: 900; text-transform: uppercase; margin-bottom: 5px;">Akses Selamanya</h4>
                                <p style="font-weight: 700; color: #64748b; font-size: 14px; margin: 0;">Satu kali bayar, akses materi seumur hidup tanpa biaya langganan.</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 20px;">
                            <div style="min-width: 50px; height: 50px; background: #bae6fd; border: 3px solid #000; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 4px 4px 0px 0px #000;">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <div>
                                <h4 style="font-weight: 900; text-transform: uppercase; margin-bottom: 5px;">Sertifikat Resmi</h4>
                                <p style="font-weight: 700; color: #64748b; font-size: 14px; margin: 0;">Dapatkan sertifikat kompetensi yang diakui oleh mitra industri kami.</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 20px;">
                            <div style="min-width: 50px; height: 50px; background: #fde68a; border: 3px solid #000; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 4px 4px 0px 0px #000;">
                                <i class="fa-solid fa-code"></i>
                            </div>
                            <div>
                                <h4 style="font-weight: 900; text-transform: uppercase; margin-bottom: 5px;">Kurikulum Berbasis Proyek</h4>
                                <p style="font-weight: 700; color: #64748b; font-size: 14px; margin: 0;">Belajar dengan praktek langsung membangun portofolio riil.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="segment-bar">
        <div class="segment-container">
            <div class="segment-label">
                <i class="fa-solid fa-filter" style="color: var(--accent-primary);"></i> Filter Kategori:
            </div>
            <div class="segment-list" id="segmentScroll">
                <a href="{{ route('home') }}" class="segment-pill {{ !request()->has('category') ? 'active' : '' }}">Semua Kursus</a>
                @foreach ($categories as $cat)
                    <a href="{{ route('home', ['category' => $cat->slug]) }}"
                        class="segment-pill {{ request()->category === $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="index-wrapper">
        <main class="index-container" id="index">
            <div class="index-header">
                <div>
                    <div style="font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; background: #e2e8f0; display: inline-block; padding: 4px 12px; border: 3px solid #000; box-shadow: 3px 3px 0px 0px #000;">
                        <i class="fa-solid fa-layer-group"></i> Catalog
                    </div>
                    <h2 class="index-title">Katalog Kursus</h2>
                </div>
                <div style="font-size: 14px; font-weight: 900; color: #000; background: #fff; border: 3px solid #000; padding: 12px 24px; box-shadow: 6px 6px 0px 0px var(--accent-primary);">
                    <span style="font-size: 20px;">{{ sprintf('%02d', $courses->count()) }}</span> ASSETS DISCOVERED
                </div>
            </div>

            @if ($courses->isEmpty())
                <div style="text-align: center; padding: 100px 20px; border: 4px dashed #000; background: #fff; box-shadow: 10px 10px 0px 0px #000;">
                    <div style="width: 100px; height: 100px; border: 4px solid #000; display: inline-flex; align-items: center; justify-content: center; font-size: 48px; color: #000; margin-bottom: 30px; background: #f1f5f9; box-shadow: 6px 6px 0px 0px var(--accent-primary);">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h3 style="font-size: 24px; font-weight: 950; text-transform: uppercase; margin-bottom: 15px;">Data Not Found</h3>
                    <p style="color: #475569; font-weight: 700; max-width: 400px; margin: 0 auto;">Belum ada kursus yang tersedia di kategori ini. Silakan cek kembali nanti.</p>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                    @foreach ($courses as $course)
                        <article class="asset-card">
                            @if($loop->first || $loop->iteration % 4 == 0)
                                <div class="nb-sticker" style="top: -10px; right: -10px;">BEST SELLER</div>
                            @endif
                            @if($loop->iteration == 2)
                                <div class="nb-sticker" style="top: -10px; right: -10px; background: #fda4af;">NEW</div>
                            @endif
                            <div class="asset-thumb">
                                <div class="asset-tag">
                                    {{ $course->category->name }}
                                </div>
                                <a href="{{ route('courses.show', $course->slug) }}">
                                    <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}">
                                </a>
                            </div>

                            <div class="asset-body">
                                <div class="asset-author">
                                    <div class="author-box">{{ substr($course->user->name, 0, 1) }}</div>
                                    <span class="author-name">{{ $course->user->name }}</span>
                                </div>
                                
                                <a href="{{ route('courses.show', $course->slug) }}" class="asset-title">
                                    {{ $course->title }}
                                </a>

                                @php
                                    $avg = round($course->reviews()->avg('rating'), 1) ?: 0;
                                    $count = $course->reviews()->count();
                                @endphp
                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 25px;">
                                    <div style="background: #fbbf24; color: #000; padding: 4px 10px; font-weight: 900; font-size: 13px; border: 2px solid #000; box-shadow: 3px 3px 0px 0px #000;">
                                        <i class="fa-solid fa-star"></i> {{ $avg }}
                                    </div>
                                    <span style="font-size: 12px; font-weight: 900; color: #64748b;">({{ $count }} REVIEWS)</span>
                                </div>

                                <div class="asset-price-bar">
                                    <div class="asset-price">
                                        @php
                                            $isDiscountActive = $course->discount_price > 0 && (!$course->discount_until || $course->discount_until > now());
                                        @endphp
                                        @if ($isDiscountActive)
                                            <div style="font-size: 14px; color: #94a3b8; text-decoration: line-through; margin-bottom: 5px; font-weight: 800;">
                                                Rp{{ number_format($course->price, 0, ',', '.') }}</div>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <span>Rp{{ number_format($course->discount_price, 0, ',', '.') }}</span>
                                                <span style="background: #ef4444; color: #fff; font-size: 10px; padding: 3px 8px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #000;">SAVE {{ round((($course->price - $course->discount_price) / $course->price) * 100) }}%</span>
                                            </div>
                                        @elseif ($course->price == 0)
                                            <span style="color: var(--accent-primary);">FREE</span>
                                        @else
                                            Rp{{ number_format($course->price, 0, ',', '.') }}
                                        @endif
                                    </div>
                                    <a href="{{ route('courses.show', $course->slug) }}" class="asset-btn">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </main>
    </div>

    <!-- Featured Instructors Section -->
    <section style="padding: 50px 5%; background: #f8fafc; border-bottom: 3px solid #000;">
        <div style="max-width: 1100px; margin: 0 auto;">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px;">
                <div>
                    <div style="font-size: 11px; font-weight: 900; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">Expert Mentors</div>
                    <h2 style="font-size: 32px; font-weight: 950; text-transform: uppercase; letter-spacing: -1px;">Instruktur <span style="color: var(--accent-primary);">Terbaik</span></h2>
                </div>
                <div style="font-weight: 800; text-transform: uppercase; border-bottom: 3px solid #000; padding-bottom: 4px; font-size: 12px;">
                    Learn from the pros
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;" class="grid-4">
                @php
                    $instructors = \App\Models\User::where('role', 'instructor')->take(4)->get();
                @endphp
                @foreach($instructors as $inst)
                    <div style="background: #fff; border: 4px solid #000; padding: 20px; box-shadow: 6px 6px 0px 0px #000; text-align: center;">
                        <div style="width: 80px; height: 80px; border: 3px solid #000; margin: 0 auto 15px; overflow: hidden; background: #e2e8f0; box-shadow: 3px 3px 0px 0px var(--accent-primary);">
                            @if($inst->profile_photo_url)
                                <img src="{{ $inst->profile_photo_url }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: 900; color: #94a3b8;">
                                    {{ substr($inst->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <h4 style="font-weight: 950; text-transform: uppercase; font-size: 18px; margin-bottom: 5px;">{{ $inst->name }}</h4>
                        <p style="font-size: 12px; font-weight: 800; color: var(--accent-primary); text-transform: uppercase; margin-bottom: 15px;">Professional Mentor</p>
                        <div style="font-size: 11px; font-weight: 700; color: #64748b; line-height: 1.4;">
                            Spesialis dalam pengembangan kurikulum digital dan teknologi modern.
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section style="padding: 50px 5%; background: #fff; border-bottom: 3px solid #000;">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 35px;">
                <div style="font-size: 11px; font-weight: 900; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">Questions</div>
                <h2 style="font-size: 32px; font-weight: 950; text-transform: uppercase; letter-spacing: -1px;">Sering <span style="background: #fff; padding: 0 8px; border: 3px solid #000; box-shadow: 4px 4px 0px 0px var(--accent-primary);">Ditanyakan</span></h2>
            </div>

            <div style="display: flex; flex-direction: column; gap: 20px;">
                @php
                    $faqs = [
                        ['q' => 'Apa itu RuangKelas?', 'a' => 'RuangKelas adalah platform Learning Management System (LMS) modern yang dirancang untuk membantu Anda menguasai berbagai keahlian digital melalui kursus dari instruktur ahli.'],
                        ['q' => 'Bagaimana cara mendapatkan sertifikat?', 'a' => 'Sertifikat akan diberikan secara otomatis setelah Anda menyelesaikan semua materi pembelajaran dan lulus ujian/tugas yang ada pada kursus tersebut.'],
                        ['q' => 'Apakah materi bisa diakses selamanya?', 'a' => 'Ya! Setelah Anda membeli atau mendaftar pada suatu kursus, Anda mendapatkan akses selamanya (Lifetime Access) ke materi tersebut.'],
                        ['q' => 'Apakah ada dukungan mentor?', 'a' => 'Tentu. Anda dapat berinteraksi dengan mentor melalui kolom review, diskusi, atau feedback pada tugas-tugas yang diberikan.'],
                    ];
                @endphp

                @foreach($faqs as $index => $faq)
                    <div class="faq-item" style="border: 3px solid #000; background: #fff; box-shadow: 5px 5px 0px 0px #000;">
                        <button onclick="toggleFaq({{ $index }})" style="width: 100%; padding: 20px 25px; border: none; background: none; display: flex; justify-content: space-between; align-items: center; cursor: pointer; text-align: left;">
                            <span style="font-size: 16px; font-weight: 950; text-transform: uppercase;">{{ $faq['q'] }}</span>
                            <i class="fa-solid fa-plus faq-icon-{{ $index }}" style="font-size: 16px; transition: 0.3s;"></i>
                        </button>
                        <div id="faq-content-{{ $index }}" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background: #f8fafc; border-top: 0 solid #000;">
                            <div style="padding: 20px; font-weight: 700; color: #475569; line-height: 1.6; border-top: 3px solid #000; font-size: 13px;">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        function toggleFaq(id) {
            const content = document.getElementById(`faq-content-${id}`);
            const icon = document.querySelector(`.faq-icon-${id}`);
            if (content.style.maxHeight === '0px' || content.style.maxHeight === '') {
                content.style.maxHeight = content.scrollHeight + "px";
                icon.style.transform = "rotate(45deg)";
            } else {
                content.style.maxHeight = "0px";
                icon.style.transform = "rotate(0deg)";
            }
        }
    </script>

    <!-- Newsletter Section -->
    <section style="padding: 60px 5%; background: var(--accent-primary); border-bottom: 4px solid #000; position: relative; overflow: hidden;">
        <div style="max-width: 1300px; margin: 0 auto; position: relative; z-index: 10; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;" class="grid-2">
            <div>
                <h2 style="font-size: 36px; font-weight: 950; text-transform: uppercase; color: #fff; line-height: 0.9; margin-bottom: 20px; -webkit-text-stroke: 1px #000;">Jangan Ketinggalan <br>Update Terbaru!</h2>
                <p style="font-size: 16px; font-weight: 800; color: #000; line-height: 1.5;">Dapatkan info promo, rilis kursus baru, dan tips karir eksklusif langsung di emailmu.</p>
            </div>
            <div>
                <div style="background: #fff; border: 4px solid #000; padding: 30px; box-shadow: 10px 10px 0px 0px #000;">
                    <form onsubmit="event.preventDefault(); alert('Terima kasih! Email Anda telah terdaftar.');">
                        <div style="margin-bottom: 15px;">
                            <input type="email" placeholder="Masukkan Alamat Email..." style="width: 100%; padding: 15px; border: 3px solid #000; font-weight: 900; outline: none; font-size: 14px;" required>
                        </div>
                        <button type="submit" class="nb-btn-primary" style="width: 100%; border-width: 3px; background: #000; color: #fff;">Berlangganan</button>
                    </form>
                </div>
            </div>
        </div>
        <div style="position: absolute; top: -30px; right: -30px; font-size: 140px; font-weight: 950; color: rgba(255,255,255,0.1); text-transform: uppercase; pointer-events: none;">NEWS</div>
    </section>

    <!-- LMS Testimonials & Rating Section -->
    <section style="background: #fff; padding: 50px 5%; border-top: 4px solid #000;">
        <div style="max-width: 1000px; margin: 0 auto;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: flex-start;" class="grid-2">
                <div>
                    <div style="font-size: 11px; font-weight: 900; color: var(--accent-primary); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">Platform Feedback</div>
                    <h2 style="font-size: 32px; font-weight: 950; text-transform: uppercase; margin-bottom: 20px; letter-spacing: -1px;">Apa Kata Mereka <br>Tentang <span style="color: var(--accent-primary);">RuangKelas</span>?</h2>
                    
                    <div style="background: #f8fafc; border: 3px solid #000; padding: 25px; box-shadow: 6px 6px 0px 0px #000; margin-bottom: 25px;">
                        <div style="font-size: 36px; font-weight: 950; line-height: 1; margin-bottom: 8px;">{{ number_format($avgLmsRating, 1) }}</div>
                        <div style="color: #fbbf24; font-size: 18px; margin-bottom: 8px;">
                            @for($i=1; $i<=5; $i++)
                                <i class="fa-{{ $i <= round($avgLmsRating) ? 'solid' : 'regular' }} fa-star"></i>
                            @endfor
                        </div>
                        <p style="font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 1px; font-size: 11px;">Rata-rata Rating dari {{ $totalLmsRatings }} Pengguna</p>
                    </div>

                    @auth
                        <div style="background: #fff; border: 3px solid #000; padding: 20px; box-shadow: 5px 5px 0px 0px var(--accent-primary);">
                            <h4 style="font-weight: 900; text-transform: uppercase; margin-bottom: 12px; font-size: 14px;">Berikan Penilaian Anda</h4>
                            @if(session('success_rating'))
                                <div style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 12px; margin-bottom: 20px; font-weight: 800; font-size: 12px;">
                                    {{ session('success_rating') }}
                                </div>
                            @endif
                            <form action="{{ route('lms-rating.store') }}" method="POST">
                                @csrf
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; font-weight: 900; text-transform: uppercase; font-size: 12px; margin-bottom: 8px;">Rating Platform (1-5)</label>
                                    <div style="display: flex; gap: 10px;">
                                        @for($i=1; $i<=5; $i++)
                                            <input type="radio" name="rating" value="{{ $i }}" id="rate-{{ $i }}" style="display: none;" required>
                                            <label for="rate-{{ $i }}" class="rate-label" style="cursor: pointer; width: 40px; height: 40px; border: 2px solid #000; display: flex; align-items: center; justify-content: center; font-weight: 900; transition: 0.2s;" onclick="highlightStars({{ $i }})">{{ $i }}</label>
                                        @endfor
                                    </div>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; font-weight: 900; text-transform: uppercase; font-size: 12px; margin-bottom: 8px;">Kesan & Pesan</label>
                                    <textarea name="comment" rows="3" class="form-control" style="border: 3px solid #000; border-radius: 0; box-shadow: 4px 4px 0px 0px #000; font-weight: 700; width: 100%; padding: 10px;" placeholder="Tuliskan pendapatmu tentang platform ini..."></textarea>
                                </div>
                                <button type="submit" class="nb-btn-primary" style="width: 100%; padding: 15px; justify-content: center;">Kirim Penilaian</button>
                            </form>
                        </div>
                        <script>
                            function highlightStars(val) {
                                document.querySelectorAll('.rate-label').forEach((el, idx) => {
                                    if (idx < val) {
                                        el.style.background = 'var(--accent-primary)';
                                        el.style.color = '#fff';
                                    } else {
                                        el.style.background = '#fff';
                                        el.style.color = '#000';
                                    }
                                });
                            }
                        </script>
                    @else
                        <div style="background: #f8fafc; border: 3px dashed #000; padding: 30px; text-align: center;">
                            <p style="font-weight: 800; color: #64748b; margin-bottom: 15px;">Silakan masuk untuk memberikan penilaian terhadap platform kami.</p>
                            <a href="{{ route('login') }}" class="nb-btn-outline" style="padding: 12px 25px; font-size: 13px;">Login Sekarang</a>
                        </div>
                    @endauth
                </div>

                <div style="display: flex; flex-direction: column; gap: 30px;">
                    @forelse($lmsRatings as $rating)
                        <div style="background: #fff; border: 3px solid #000; padding: 25px; box-shadow: 6px 6px 0px 0px #bae6fd;">
                            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                                <div style="width: 40px; height: 40px; background: #000; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 900; border: 2px solid #000;">
                                    {{ substr($rating->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight: 900; text-transform: uppercase; font-size: 14px;">{{ $rating->user->name }}</div>
                                    <div style="color: #fbbf24; font-size: 12px;">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="fa-{{ $i <= $rating->rating ? 'solid' : 'regular' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div style="margin-left: auto; display: flex; align-items: center; gap: 8px;">
                                    <div style="font-size: 11px; font-weight: 700; color: #94a3b8;">
                                        {{ $rating->created_at->diffForHumans() }}
                                    </div>
                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <form id="delete-rating-{{ $rating->id }}" action="{{ route('lms-rating.destroy', $rating->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="nbConfirm('Apakah Anda yakin ingin menghapus feedback dari {{ $rating->user->name }}?', () => document.getElementById('delete-rating-{{ $rating->id }}').submit())" style="background: #ef4444; color: #fff; border: 1px solid #000; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 2px 2px 0px 0px #000; font-size: 10px;">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <p style="font-weight: 600; color: #475569; font-size: 14px; line-height: 1.6; margin: 0; font-style: italic;">
                                "{{ $rating->comment ?: 'Tidak ada komentar.' }}"
                            </p>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 60px; border: 3px dashed #cbd5e1;">
                            <p style="font-weight: 800; color: #94a3b8;">Belum ada penilaian platform.</p>
                        </div>
                    @endforelse

                    @if($totalLmsRatings > 5)
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('lms-rating.index') }}" class="nb-btn-outline" style="width: 100%; justify-content: center; padding: 15px;">
                                LIHAT RIWAYAT PENILAIAN ({{ $totalLmsRatings }}) <i class="fa-solid fa-clock-rotate-left"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer style="background: #000; color: #fff; padding: 60px 5% 30px; border-top: 4px solid #000;">
        <div style="max-width: 1300px; margin: 0 auto;">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 40px;" class="grid-footer">
                <!-- Brand Info -->
                <div>
                    <div style="font-size: 24px; font-weight: 950; text-transform: uppercase; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <div style="background: var(--accent-primary); color: #fff; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border: 2px solid #fff; font-size: 16px;">RK</div>
                        RUANG<span style="color: var(--accent-primary);">KELAS</span>
                    </div>
                    <p style="color: #94a3b8; font-weight: 700; line-height: 1.5; margin-bottom: 20px; max-width: 320px; font-size: 13px;">
                        Platform pembelajaran digital terbaik untuk menguasai keahlian industri masa depan. Belajar dari para ahli dan bangun portofolio Anda.
                    </p>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div style="display: flex; align-items: center; gap: 10px; color: #cbd5e1; font-size: 13px; font-weight: 700;">
                            <i class="fa-solid fa-location-dot" style="color: var(--accent-primary);"></i> Jakarta, Indonesia
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; color: #cbd5e1; font-size: 13px; font-weight: 700;">
                            <i class="fa-solid fa-phone" style="color: var(--accent-primary);"></i> +62 812-3456-7890
                        </div>
                    </div>
                </div>

                <!-- Program -->
                <div>
                    <h4 style="font-weight: 950; text-transform: uppercase; margin-bottom: 20px; font-size: 14px; border-left: 3px solid var(--accent-primary); padding-left: 12px;">PROGRAM</h4>
                    <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 10px;">
                        <li><a href="#" style="color: #94a3b8; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Online Course</a></li>
                        <li><a href="#" style="color: #94a3b8; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Intensive Bootcamp</a></li>
                        <li><a href="#" style="color: #94a3b8; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Corporate Training</a></li>
                    </ul>
                </div>

                <!-- Ekosistem -->
                <div>
                    <h4 style="font-weight: 950; text-transform: uppercase; margin-bottom: 20px; font-size: 14px; border-left: 3px solid var(--accent-primary); padding-left: 12px;">EKOSISTEM</h4>
                    <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 10px;">
                        <li><a href="{{ route('forum.index') }}" style="color: #94a3b8; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Forum Diskusi</a></li>
                        <li><a href="#" style="color: #94a3b8; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Grup Belajar (Discord)</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 style="font-weight: 950; text-transform: uppercase; margin-bottom: 20px; font-size: 14px; border-left: 3px solid var(--accent-primary); padding-left: 12px;">SUPPORT</h4>
                    <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 10px;">
                        <li><a href="{{ route('help-center') }}" style="color: #94a3b8; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Pusat Bantuan</a></li>
                        <li><a href="{{ route('terms') }}" style="color: #94a3b8; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('privacy') }}" style="color: #94a3b8; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">Kebijakan Privasi</a></li>
                    </ul>
                    
                    <div style="margin-top: 20px; display: flex; gap: 10px; background: #fff; padding: 8px; border: 2px solid #000; box-shadow: 4px 4px 0px 0px var(--accent-primary); width: fit-content;">
                         <img src="https://upload.wikimedia.org/wikipedia/commons/b/be/Logo_Kementerian_Komunikasi_dan_Informatika_Indonesia.png" style="height: 18px; filter: grayscale(1);">
                         <img src="https://upload.wikimedia.org/wikipedia/id/archive/0/05/20220614130541%21Logo_PSE_Kemkominfo.png" style="height: 18px; filter: grayscale(1);">
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div style="padding-top: 30px; border-top: 2px solid #1e293b; display: flex; justify-content: space-between; align-items: center;" class="footer-bottom">
                <div style="color: #64748b; font-size: 11px; font-weight: 700;">
                    &copy; 2026 RUANGKELAS LMS PRO.
                </div>
                <div style="display: flex; gap: 15px;">
                    <a href="#" style="color: #fff; font-size: 16px; transition: 0.2s;" onmouseover="this.style.color='var(--accent-primary)'" onmouseout="this.style.color='#fff'"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" style="color: #fff; font-size: 16px; transition: 0.2s;" onmouseover="this.style.color='var(--accent-primary)'" onmouseout="this.style.color='#fff'"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="#" style="color: #fff; font-size: 16px; transition: 0.2s;" onmouseover="this.style.color='var(--accent-primary)'" onmouseout="this.style.color='#fff'"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // AJAX Category Switching with Neo-Brutalist Loading Effect
        document.querySelectorAll('.segment-pill').forEach(pill => {
            pill.addEventListener('click', function(e) {
                if (e.ctrlKey || e.metaKey || e.shiftKey || e.button !== 0) return;
                e.preventDefault();
                const url = this.getAttribute('href');

                document.querySelectorAll('.segment-pill').forEach(p => p.classList.remove('active'));
                this.classList.add('active');

                const indexContainer = document.getElementById('index');
                const coursesGrid = document.querySelector('.asset-card').parentElement;
                
                if(indexContainer) {
                    indexContainer.style.opacity = '0.5';
                    indexContainer.style.filter = 'grayscale(1)';
                }

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newContent = doc.getElementById('index');
                        const newGrid = doc.querySelector('.asset-card')?.parentElement || doc.querySelector('[style*="grid-template-columns"]');
                        
                        if (newContent) indexContainer.innerHTML = newContent.innerHTML;
                        if (newGrid) {
                            const currentGrid = document.querySelector('.asset-card')?.parentElement || document.querySelector('[style*="grid-template-columns"]');
                            if(currentGrid) currentGrid.innerHTML = newGrid.innerHTML;
                        } else {
                            // If no courses found in that category, refresh to show the empty state properly
                            window.location.reload();
                        }
                        
                        window.history.pushState({}, '', url);
                    })
                    .finally(() => {
                        if(indexContainer) {
                            indexContainer.style.opacity = '1';
                            indexContainer.style.filter = 'none';
                        }
                    });
            });
        });

        // Horizontal Scroll handling
        const slider = document.getElementById('segmentScroll');
        if(slider) {
            slider.addEventListener('wheel', (evt) => {
                evt.preventDefault();
                slider.scrollLeft += evt.deltaY;
            });
        }
    </script>
@endsection
