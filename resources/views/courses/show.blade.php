@extends('layouts.app')

@section('content')
    <style>
        /* Asset Analysis Styles (Brutalist) */
        .asset-header-container {
            background-color: var(--bg-primary);
            padding: 60px 5% 80px;
            border-bottom: 3px solid #000;
            position: relative;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .asset-header-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 50px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .premium-badge-cat {
            display: inline-block;
            background: #fff;
            color: #000;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 8px 12px;
            border: 2px solid #000;
            margin-bottom: 25px;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
        }

        .asset-header-content h1 {
            font-size: 48px;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: -1.5px;
            color: #000;
            text-transform: uppercase;
        }

        .asset-header-content p.desc {
            color: #000;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.6;
            max-width: 700px;
            font-weight: 600;
            background: #fff;
            border: 2px solid #000;
            padding: 20px;
            box-shadow: 6px 6px 0px 0px #000;
        }

        .premium-instructor-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 15px;
            background: #000;
            color: #fff;
            padding: 15px 20px;
            border: 2px solid #000;
            display: inline-flex;
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .premium-instructor-avatar {
            width: 40px;
            height: 40px;
            background: var(--accent-primary);
            color: #fff;
            font-size: 16px;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
            box-shadow: 2px 2px 0px 0px #fff;
        }

        .premium-buy-card {
            background: #fff;
            border: 3px solid #000;
            padding: 25px;
            box-shadow: 10px 10px 0px 0px #000;
            position: relative;
            top: 0;
            color: #000;
            display: flex;
            flex-direction: column;
        }

        .premium-buy-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 20px;
            border: 2px solid #000;
        }

        .premium-buy-card .price {
            font-size: 36px;
            font-weight: 900;
            margin-bottom: 20px;
            color: #000;
            text-align: center;
            line-height: 1;
        }

        .btn-sq-primary {
            background: var(--accent-primary);
            color: #fff;
            border: 2px solid #000;
            padding: 15px 20px;
            border-radius: 0;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 6px 6px 0px 0px #000;
            text-decoration: none;
            width: 100%;
        }

        .btn-sq-primary:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000;
            color: #fff;
        }

        .btn-sq-primary:active {
            transform: translate(3px, 3px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        .btn-sq-outline {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            padding: 15px 20px;
            border-radius: 0;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 4px 4px 0px 0px #000;
            text-decoration: none;
            width: 100%;
            margin-top: 15px;
        }

        .btn-sq-outline:hover {
            transform: translate(-3px, -3px);
            box-shadow: 7px 7px 0px 0px #000;
            color: #000;
            background: #f8fafc;
        }

        .btn-sq-outline:active {
            transform: translate(3px, 3px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        .premium-course-body {
            padding: 60px 5% 80px;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 50px;
        }

        .premium-curriculum h2 {
            font-size: 24px;
            font-weight: 900;
            margin-bottom: 25px;
            color: #000;
            display: flex;
            align-items: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }

        .premium-curriculum-section {
            margin-bottom: 25px;
            background: #fff;
            border: 2px solid #000;
            overflow: hidden;
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .premium-section-header {
            padding: 15px 20px;
            background: #000;
            border-bottom: 2px solid #000;
            font-weight: 900;
            font-size: 14px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .premium-lesson-item {
            padding: 15px 20px;
            border-bottom: 2px solid #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            transition: all 0.2s ease;
            background: #fff;
        }

        .premium-lesson-item:last-child {
            border-bottom: none;
        }

        .premium-lesson-item:hover {
            background: #f8fafc;
        }

        .premium-lesson-item i {
            color: var(--accent-primary);
            margin-right: 12px;
            font-size: 14px;
        }

        .premium-lesson-item a {
            flex-grow: 1;
            color: #000;
            text-decoration: none;
            font-weight: 800;
            text-transform: uppercase;
        }

        .premium-preview-badge {
            background: #10b981;
            color: #000;
            padding: 4px 8px;
            font-size: 10px;
            font-weight: 900;
            border: 2px solid #000;
            text-transform: uppercase;
            box-shadow: 2px 2px 0px 0px #000;
            letter-spacing: 0.5px;
        }

        @media (max-width: 900px) {
            .asset-header-grid {
                grid-template-columns: 1fr;
            }

            .premium-course-body {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .asset-header-content h1 {
                font-size: 36px;
            }
        }
    </style>

    <div class="asset-header-container">
        <div class="asset-header-grid">
            <div class="asset-header-content">
                <div class="premium-badge-cat">
                    <i class="fa-solid fa-microchip"
                        style="margin-right: 6px; color: var(--accent-primary);"></i>{{ $course->category->name }}
                </div>
                
                @php
                    $reviewsCount = $course->reviews->count();
                    $averageRating = $reviewsCount > 0 ? round($course->reviews->avg('rating'), 1) : 0;
                    $userReview = Auth::check() ? $course->reviews->where('user_id', Auth::id())->first() : null;
                @endphp
                <div style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                    <div style="background: #000; color: #fff; padding: 4px 8px; font-weight: 900; font-size: 14px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px var(--accent-primary);">
                        <i class="fa-solid fa-star" style="color: #fbbf24;"></i> {{ number_format($averageRating, 1) }}
                    </div>
                    <span style="font-size: 12px; font-weight: 800; text-transform: uppercase;">({{ $reviewsCount }} Ulasan)</span>
                </div>

                <h1>{{ $course->title }}</h1>
                <p class="desc">{{ $course->description }}</p>

                <div class="premium-instructor-meta">
                    <div class="premium-instructor-avatar">
                        {{ substr($course->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p
                            style="color: #94a3b8; font-size: 10px; font-weight: 900; text-transform: uppercase; margin: 0; letter-spacing: 1px;">
                            Instruktur</p>
                        <p style="font-weight: 900; font-size: 16px; margin: 0; color: #fff; text-transform: uppercase;">
                            {{ $course->user->name }}</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="premium-buy-card">
                    <div
                        style="position: absolute; top: -15px; right: -15px; background: var(--accent-primary); color: #fff; padding: 6px 12px; font-size: 11px; font-weight: 900; border: 2px solid #000; box-shadow: 3px 3px 0px 0px #000; text-transform: uppercase;">
                        Status: Tersedia
                    </div>
                    <img src="{{ $course->thumbnail }}" alt="Course Thumbnail">

                    @php
                        $isDiscountActive = $course->discount_price > 0 && (!$course->discount_until || $course->discount_until > now());
                    @endphp

                    <div class="price" style="margin-bottom: 30px; padding: 20px; background: #f8fafc; border: 3px solid #000; box-shadow: 4px 4px 0px 0px #000;">
                        @if ($isDiscountActive)
                            <div
                                style="font-size: 14px; color: #64748b; text-decoration: line-through; margin-bottom: 8px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                                Harga Normal: Rp {{ number_format($course->price, 0, ',', '.') }}
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                                <div style="font-size: 42px; font-weight: 950; color: #10b981; line-height: 1; letter-spacing: -1px; font-family: 'Courier New', Courier, monospace;">
                                    Rp {{ number_format($course->discount_price, 0, ',', '.') }}
                                </div>
                                <span
                                    style="background: #000; color: var(--accent-primary); font-size: 11px; font-weight: 950; padding: 6px 12px; border: 2px solid #000; box-shadow: 3px 3px 0px 0px var(--accent-primary); text-transform: uppercase; letter-spacing: 1.5px; display: inline-block;">
                                    OFFER TERBATAS
                                </span>
                            </div>
                            
                            @if($course->discount_until)
                                <div style="margin-top: 20px; background: #000; border: 3px solid #000; padding: 12px; box-shadow: 5px 5px 0px 0px var(--accent-primary);">
                                    <div style="color: #fff; font-size: 10px; font-weight: 900; text-transform: uppercase; text-align: center; margin-bottom: 8px; letter-spacing: 1px;">
                                        <i class="fa-solid fa-bolt-lightning" style="color: #fbbf24; margin-right: 6px;"></i> Flash Sale Ends In:
                                    </div>
                                    <div id="flash-sale-timer-{{ $course->id }}" data-until="{{ $course->discount_until->toIso8601String() }}" style="display: flex; justify-content: center; gap: 12px; color: #fff;">
                                        <div style="text-align: center;"><span class="days" style="font-size: 20px; font-weight: 950; color: #fbbf24;">00</span><div style="font-size: 7px; font-weight: 900; text-transform: uppercase;">Days</div></div>
                                        <div style="font-weight: 950; color: #333; font-size: 20px;">:</div>
                                        <div style="text-align: center;"><span class="hours" style="font-size: 20px; font-weight: 950; color: #fbbf24;">00</span><div style="font-size: 7px; font-weight: 900; text-transform: uppercase;">Hrs</div></div>
                                        <div style="font-weight: 950; color: #333; font-size: 20px;">:</div>
                                        <div style="text-align: center;"><span class="mins" style="font-size: 20px; font-weight: 950; color: #fbbf24;">00</span><div style="font-size: 7px; font-weight: 900; text-transform: uppercase;">Min</div></div>
                                        <div style="font-weight: 950; color: #333; font-size: 20px;">:</div>
                                        <div style="text-align: center;"><span class="secs" style="font-size: 20px; font-weight: 950; color: #fbbf24;">00</span><div style="font-size: 7px; font-weight: 900; text-transform: uppercase;">Sec</div></div>
                                    </div>
                                </div>
                            @endif
                        @elseif ($course->price == 0)
                            <div style="font-size: 48px; font-weight: 950; color: #10b981; letter-spacing: -2px;">GRATIS</div>
                        @else
                            <div style="font-size: 42px; font-weight: 950; color: #000; letter-spacing: -1px; font-family: 'Courier New', Courier, monospace;">
                                Rp {{ number_format($course->price, 0, ',', '.') }}
                            </div>
                        @endif
                    </div>

                    @php
                        $isEnrolled = false;
                        if (Auth::check()) {
                            $isEnrolled = $course->enrollments()->where('user_id', Auth::id())->where('status', 'active')->exists();
                        }
                    @endphp

                    @if ($isEnrolled)
                        <a href="{{ route('courses.watch', [$course->slug, $course->sections->first()->lessons->first()->id ?? 1]) }}"
                            class="btn-sq-primary" style="background: #000; color: var(--accent-primary); box-shadow: 6px 6px 0px 0px var(--accent-primary); border-color: #000;">
                            <i class="fa-solid fa-play-circle" style="margin-right: 10px; font-size: 18px;"></i> LANJUTKAN BELAJAR
                        </a>
                    @else
                        <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-sq-primary" style="height: 70px; font-size: 16px; width: 100%; border: none;">
                                <i class="fa-solid fa-bolt" style="margin-right: 10px; font-size: 20px;"></i> DAFTAR SEKARANG
                            </button>
                        </form>
                    @endif

                    <div
                        style="text-align: center; margin-top: 25px; font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; background: #fff; padding: 15px; border: 2px dashed #cbd5e1; display: flex; flex-direction: column; gap: 5px;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 6px; color: #000;">
                            <i class="fa-solid fa-shield-check" style="color: #10b981;"></i>
                            Sistem Transaksi Terverifikasi
                        </div>
                        <span style="font-size: 9px; opacity: 0.7;">Akses materi selamanya setelah aktivasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="premium-course-body">
        <div class="premium-curriculum">
            <h2><i class="fa-solid fa-list-check" style="margin-right: 12px; color: var(--accent-primary);"></i> Kurikulum Kursus</h2>

            @forelse ($course->sections as $section)
                <div class="premium-curriculum-section">
                    <div class="premium-section-header">
                        <i class="fa-solid fa-folder" style="margin-right: 8px; color: var(--accent-primary);"></i>
                        {{ $section->title }}
                    </div>
                    <div class="section-lessons">
                        @forelse ($section->lessons as $lesson)
                            @php
                                $user = Auth::user();
                                $isAdmin = $user && $user->role === 'admin';
                                $isOwner = $user && $user->id === $course->user_id;
                                $hasDirectAccess = $lesson->is_free_preview || $isEnrolled || $isAdmin || $isOwner;
                            @endphp
                            <div class="premium-lesson-item">
                                @if ($hasDirectAccess)
                                    <a
                                        href="{{ route('courses.watch', ['slug' => $course->slug, 'lesson' => $lesson->id]) }}">
                                        @if ($isActive ?? false)
                                            <i class="fa-solid fa-circle-play" style="color: var(--accent-primary);"></i>
                                        @else
                                            <i class="fa-solid fa-play-circle" style="color: #64748b;"></i>
                                        @endif
                                        <span>{{ $lesson->title }}</span>
                                    </a>
                                    @if ($isAdmin || $isOwner)
                                        <span class="premium-preview-badge"
                                            style="background: #fff; color: #000; border-color: #000;">AKSES ADMIN</span>
                                    @elseif ($lesson->is_free_preview && !$isEnrolled)
                                        <span class="premium-preview-badge" style="background: #fef08a; color: #000;">TINJAUAN 
                                            GRATIS</span>
                                    @endif
                                @else
                                    <a href="#" style="color: #64748b; cursor: not-allowed;"
                                        onclick="event.preventDefault();">
                                        <i class="fa-solid fa-lock" style="color: #cbd5e1;"></i>
                                        <span>{{ $lesson->title }}</span>
                                    </a>
                                @endif
                            </div>
                        @empty
                            <div
                                style="padding: 20px; font-size: 13px; font-weight: 800; color: #64748b; text-align: center; text-transform: uppercase;">
                                Belum ada materi yang ditambahkan.</div>
                        @endforelse
                    </div>
                </div>
            @empty
                <div
                    style="padding: 50px 20px; font-size: 14px; font-weight: 900; color: #000; text-align: center; border: 3px dashed #000; background: #fff; box-shadow: 8px 8px 0px 0px #000; text-transform: uppercase;">
                    <i class="fa-solid fa-person-digging" style="font-size: 32px; margin-bottom: 15px; display: block;"></i>
                    Kurikulum kursus sedang dalam proses penyusunan.
                </div>
            @endforelse

            <div style="margin-top: 50px;">
                <h2><i class="fa-solid fa-star" style="margin-right: 12px; color: #fbbf24;"></i> Ulasan Siswa</h2>
                
                @if ($isEnrolled)
                    <div style="background: #f8fafc; border: 2px solid #000; padding: 25px; margin-bottom: 30px; box-shadow: 6px 6px 0px 0px var(--accent-primary);">
                        <h3 style="font-size: 16px; font-weight: 900; text-transform: uppercase; margin-bottom: 15px;">
                            {{ $userReview ? 'Edit Ulasan Anda' : 'Beri Ulasan' }}
                        </h3>
                        <form action="{{ route('course.review', $course->id) }}" method="POST">
                            @csrf
                            <div style="margin-bottom: 15px;">
                                <label style="display: block; font-size: 12px; font-weight: 900; text-transform: uppercase; margin-bottom: 8px;">Rating (1-5)</label>
                                <select name="rating" required style="width: 100%; padding: 12px; border: 2px solid #000; font-family: inherit; font-weight: 800; appearance: none; background: #fff;">
                                    <option value="">Pilih Bintang</option>
                                    <option value="5" {{ ($userReview->rating ?? '') == 5 ? 'selected' : '' }}>5 - Luar Biasa</option>
                                    <option value="4" {{ ($userReview->rating ?? '') == 4 ? 'selected' : '' }}>4 - Sangat Bagus</option>
                                    <option value="3" {{ ($userReview->rating ?? '') == 3 ? 'selected' : '' }}>3 - Bagus</option>
                                    <option value="2" {{ ($userReview->rating ?? '') == 2 ? 'selected' : '' }}>2 - Cukup</option>
                                    <option value="1" {{ ($userReview->rating ?? '') == 1 ? 'selected' : '' }}>1 - Kurang</option>
                                </select>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label style="display: block; font-size: 12px; font-weight: 900; text-transform: uppercase; margin-bottom: 8px;">Komentar (Opsional)</label>
                                <textarea name="comment" rows="3" style="width: 100%; padding: 12px; border: 2px solid #000; font-family: inherit; resize: vertical;">{{ $userReview->comment ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="btn-sq-primary" style="width: auto;">
                                <i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i> Kirim Ulasan
                            </button>
                        </form>
                    </div>
                @endif

                <div style="display: flex; flex-direction: column; gap: 20px;">
                    @forelse($course->reviews()->latest()->get() as $review)
                        <div style="background: #fff; border: 2px solid #000; padding: 20px; box-shadow: 4px 4px 0px 0px #000;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 35px; height: 35px; background: var(--accent-primary); color: #fff; font-weight: 900; display: flex; align-items: center; justify-content: center; border: 2px solid #000;">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 900; font-size: 14px; text-transform: uppercase;">{{ $review->user->name }}</div>
                                        <div style="font-size: 10px; color: #64748b; font-weight: 800;">{{ $review->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="background: #fbbf24; color: #000; padding: 4px 8px; font-weight: 900; font-size: 12px; border: 2px solid #000;">
                                        <i class="fa-solid fa-star"></i> {{ $review->rating }}
                                    </div>
                                    @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::id() === $course->user_id))
                                        <form id="delete-review-{{ $review->id }}" action="{{ route('course.review.destroy', $review->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="nbConfirm('Hapus ulasan dari {{ $review->user->name }}?', () => document.getElementById('delete-review-{{ $review->id }}').submit())" style="background: #ef4444; color: #fff; border: 1px solid #000; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 2px 2px 0px 0px #000; font-size: 10px;">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            @if($review->comment)
                                <p style="font-size: 14px; font-weight: 600; line-height: 1.5; margin: 0; color: #333;">{{ $review->comment }}</p>
                            @endif

                            @if($review->instructor_reply)
                                <div style="margin-top: 15px; padding: 15px; background: #f1f5f9; border: 2px solid #000; position: relative;">
                                    <div style="position: absolute; top: -10px; left: 15px; background: #000; color: #fff; font-size: 9px; font-weight: 900; padding: 2px 8px; border: 2px solid #000; text-transform: uppercase; letter-spacing: 1px;">
                                        Balasan Instruktur
                                    </div>
                                    <p style="font-size: 13px; font-weight: 700; color: #1e293b; line-height: 1.5; margin: 0;">
                                        {{ $review->instructor_reply }}
                                    </p>
                                    <div style="font-size: 9px; color: #64748b; font-weight: 800; margin-top: 8px; text-transform: uppercase;">
                                        {{ $review->replied_at->diffForHumans() }}
                                    </div>
                                </div>
                            @elseif(Auth::check() && Auth::id() === $course->user_id)
                                <div style="margin-top: 15px; border-top: 2px dashed #000; padding-top: 15px;">
                                    <button onclick="toggleReplyForm({{ $review->id }})" id="reply-btn-{{ $review->id }}" style="background: #000; color: #fff; border: 2px solid #000; padding: 6px 12px; font-size: 10px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 3px 3px 0px 0px var(--accent-primary);">
                                        <i class="fa-solid fa-reply"></i> Balas Ulasan
                                    </button>
                                    
                                    <form id="reply-form-{{ $review->id }}" action="{{ route('instructor.reviews.reply', $review) }}" method="POST" style="display: none; margin-top: 15px;">
                                        @csrf
                                        <textarea name="reply" rows="2" style="width: 100%; border: 2px solid #000; padding: 10px; font-size: 12px; font-weight: 600; margin-bottom: 10px;" placeholder="Tulis balasan Anda..."></textarea>
                                        <div style="display: flex; gap: 10px;">
                                            <button type="submit" style="background: var(--accent-primary); color: #fff; border: 2px solid #000; padding: 6px 12px; font-size: 10px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 3px 3px 0px 0px #000;">
                                                Kirim Balasan
                                            </button>
                                            <button type="button" onclick="toggleReplyForm({{ $review->id }})" style="background: #fff; color: #000; border: 2px solid #000; padding: 6px 12px; font-size: 10px; font-weight: 900; text-transform: uppercase; cursor: pointer;">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div style="text-align: center; padding: 30px; font-size: 12px; font-weight: 900; color: #64748b; text-transform: uppercase; border: 2px dashed #cbd5e1;">
                            Belum ada ulasan untuk kursus ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div>
            <!-- Decorative Sidebar Element -->
            <div
                style="background: #000; padding: 25px; border: 3px solid #000; box-shadow: 8px 8px 0px 0px var(--accent-primary); position: sticky; top: 100px;">
                <h3
                    style="font-size: 14px; font-weight: 900; color: #fff; text-transform: uppercase; border-bottom: 2px solid #333; padding-bottom: 15px; margin-bottom: 20px; letter-spacing: 1px;">
                    <i class="fa-solid fa-terminal" style="color: var(--accent-primary); margin-right: 8px;"></i> Spesifikasi
                     Kursus
                </h3>

                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding-bottom: 15px;">
                        <span style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Tingkat
                            Keamanan</span>
                        <span
                            style="font-size: 12px; font-weight: 900; color: #10b981; background: rgba(16, 185, 129, 0.1); padding: 2px 6px; border: 1px solid #10b981;">TERVERIFIKASI</span>
                    </div>
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding-bottom: 15px;">
                        <span style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Tipe
                            Konten</span>
                        <span style="font-size: 11px; font-weight: 900; color: #fff; text-transform: uppercase;">Video HD /
                            Teks</span>
                    </div>
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding-bottom: 15px;">
                        <span
                            style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Akses</span>
                        <span
                            style="font-size: 11px; font-weight: 900; color: #fff; text-transform: uppercase;">Selamanya</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span
                            style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Pengiriman</span>
                        <span
                            style="font-size: 11px; font-weight: 900; color: #fff; text-transform: uppercase;">Instan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleReplyForm(reviewId) {
            const form = document.getElementById('reply-form-' + reviewId);
            const btn = document.getElementById('reply-btn-' + reviewId);
            if (form.style.display === 'none') {
                form.style.display = 'block';
                btn.style.display = 'none';
            } else {
                form.style.display = 'none';
                btn.style.display = 'block';
            }
        }

        // Flash Sale Timer Logic
        document.addEventListener('DOMContentLoaded', function() {
            const timerElements = document.querySelectorAll('[id^="flash-sale-timer-"]');
            
            timerElements.forEach(timer => {
                const untilStr = timer.getAttribute('data-until');
                if (!untilStr) return;
                
                const countDownDate = new Date(untilStr).getTime();

                const interval = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = countDownDate - now;

                    if (distance < 0) {
                        clearInterval(interval);
                        // Reload page to hide discount or show expired message
                        window.location.reload();
                        return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    timer.querySelector('.days').innerText = days.toString().padStart(2, '0');
                    timer.querySelector('.hours').innerText = hours.toString().padStart(2, '0');
                    timer.querySelector('.mins').innerText = minutes.toString().padStart(2, '0');
                    timer.querySelector('.secs').innerText = seconds.toString().padStart(2, '0');
                }, 1000);
            });
        });
    </script>
@endsection
