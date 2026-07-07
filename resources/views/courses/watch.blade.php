@extends('layouts.app')

@section('content')
    @include('courses.partials.watch-styles')

    <div class="watch-container watch-layout">
        <!-- Main Video & Content Area -->
        <div class="video-player-area">

            <!-- Video Player Wrapper -->
            <div class="main-video-wrapper">
                <video id="course-video" class="video-js vjs-big-play-centered vjs-16-9" controls preload="auto" data-setup='{"fluid": true}'>
                    <source src="{{ $lesson->video_url }}" type="video/mp4">
                    Your browser does not support HTML video.
                </video>
            </div>

            <!-- Content Area Below Video -->
            <div class="video-info">
                <div style="max-width: 950px; margin: 0 auto;">
                    <h2 class="video-title">{{ $lesson->title }}</h2>
                    <div class="video-meta">
                        <span class="meta-badge"><i class="fa-solid fa-folder-tree"
                                style="margin-right:6px"></i>{{ $lesson->section->title }}</span>
                        <span>•</span>
                        <span>{{ $course->title }}</span>
                    </div>

                    <!-- Custom Tabs -->
                    <div class="content-box">
                        <div class="tab-container">
                            <button type="button" onclick="switchTab('content', event)" id="tab-btn-content"
                                class="tab-btn active">
                                <i class="fa-solid fa-file-lines"></i>Ringkasan
                            </button>
                            <button type="button" onclick="switchTab('qna', event)" id="tab-btn-qna" class="tab-btn">
                                <i class="fa-solid fa-comments"></i>Tanya Jawab ({{ count($questions) }})
                            </button>
                            @if (isset($quizQuestions) && $quizQuestions->count() > 0)
                                <button type="button" onclick="switchTab('quiz', event)" id="tab-btn-quiz" class="tab-btn">
                                    <i class="fa-solid fa-clipboard-question"></i>Kuis
                                </button>
                            @endif
                            @if (isset($assignments) && $assignments->count() > 0)
                                <button type="button" onclick="switchTab('assignments', event)" id="tab-btn-assignments"
                                    class="tab-btn">
                                    <i class="fa-solid fa-file-signature"></i>Tugas
                                </button>
                            @endif
                        </div>

                        <!-- OVERVIEW TAB -->
                        <div id="tab-content" class="tab-pane active">
                            <div class="pane-title">
                                <span><i class="fa-solid fa-book-open"
                                        style="margin-right: 8px; color: var(--text-sec);"></i> Tentang materi ini</span>
                            </div>
                            <div class="pane-desc">
                                {!! nl2br(e($lesson->content)) ?:
                                    '<span style="color: #94a3b8; font-style: italic; font-weight: 500;">Tidak ada deskripsi teks untuk materi ini.</span>' !!}
                            </div>
                        </div>

                        <!-- QnA TAB -->
                        @include('courses.partials.watch-qna')

                        <!-- QUIZ TAB -->
                        @include('courses.partials.watch-quiz')

                        <!-- ASSIGNMENTS TAB -->
                        @include('courses.partials.watch-assignments')
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Playlist Area -->
        <div class="playlist-sidebar-area">
            @include('courses.partials.watch-sidebar')
        </div>

        <style>
            /* Video.js Premium Emerald Theme */
            .video-js {
                width: 100%;
                font-family: 'Poppins', sans-serif;
                border-bottom: 4px solid #000;
                background-color: #000;
            }

            .video-js .vjs-tech {
                object-fit: contain;
                width: 100%;
                height: 100%;
            }

            .main-video-wrapper {
                width: 100%;
                background: #000;
                position: relative;
            }

            .vjs-theme-emerald {
                --vjs-theme-emerald--primary: #10b981;
                --vjs-theme-emerald--secondary: #000;
            }

            .video-js .vjs-big-play-button {
                background-color: #10b981 !important;
                border: 3px solid #000 !important;
                box-shadow: 8px 8px 0px #000 !important;
                width: 80px !important;
                height: 80px !important;
                line-height: 74px !important;
                border-radius: 0 !important;
                top: 50% !important;
                left: 50% !important;
                margin-top: -40px !important;
                margin-left: -40px !important;
                transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
            }

            .video-js:hover .vjs-big-play-button {
                background-color: #fff !important;
                transform: scale(1.1) translate(-3px, -3px) !important;
                box-shadow: 12px 12px 0px #000 !important;
            }

            .video-js .vjs-control-bar {
                background: linear-gradient(transparent, rgba(0,0,0,0.9)) !important;
                height: 50px !important;
                padding-top: 5px;
            }

            .video-js .vjs-play-progress, 
            .video-js .vjs-volume-level {
                background-color: #10b981 !important;
            }

            .video-js .vjs-slider {
                background-color: rgba(255,255,255,0.2) !important;
            }

            /* Watermark for Video.js */
            .vjs-watermark {
                position: absolute;
                top: 25px;
                right: 25px;
                background: rgba(15, 23, 42, 0.7);
                backdrop-filter: blur(12px);
                padding: 10px 20px;
                border: 3px solid #000;
                box-shadow: 6px 6px 0px #000;
                color: #fff;
                font-weight: 800;
                font-size: 16px;
                pointer-events: none;
                z-index: 10;
                display: flex;
                align-items: center;
                gap: 10px;
                text-transform: lowercase;
                letter-spacing: -1px;
                transition: opacity 0.4s ease;
            }

            .vjs-watermark span { color: #10b981; }
            .vjs-watermark i { color: #10b981; font-size: 18px; }

            .vjs-user-inactive .vjs-watermark {
                opacity: 0.3;
            }
        </style>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const player = videojs('course-video', {
                    fluid: true,
                    responsive: true,
                    playbackRates: [0.5, 1, 1.25, 1.5, 2],
                    controlBar: {
                        children: [
                            'playToggle',
                            'volumePanel',
                            'currentTimeDisplay',
                            'progressControl',
                            'durationDisplay',
                            'playbackRateMenuButton',
                            'subsCapsButton',
                            'pictureInPictureToggle',
                            'fullscreenToggle',
                        ],
                    }
                });

                // Add Watermark
                const watermark = document.createElement('div');
                watermark.className = 'vjs-watermark';
                watermark.innerHTML = '<i class="fa-solid fa-graduation-cap"></i> ruang<span>kelas.</span>';
                player.el().appendChild(watermark);

                // Handle video ended for progress tracking
                @php
                    $currentLessonCompleted = \Illuminate\Support\Facades\Auth::check() ? \App\Models\LessonProgress::where('user_id', Auth::id())->where('lesson_id', $lesson->id)->where('is_completed', true)->exists() : false;
                @endphp
                
                @if (Auth::check() && !$currentLessonCompleted)
                    player.on('ended', function() {
                        fetch('{{ route('progress.complete', $lesson->id) }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.reload();
                                }
                            })
                            .catch(err => console.error(err));
                    });
                @endif
            });

            function switchTab(tabName, event) {
                if (event) event.preventDefault();
                document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('active'));
                document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
                const tab = document.getElementById(tabName === 'content' ? 'tab-content' : 'tab-' + tabName);
                const btn = document.getElementById('tab-btn-' + tabName);
                if (tab) tab.classList.add('active');
                if (btn) btn.classList.add('active');
            }
        </script>
    </div>
@endsection
