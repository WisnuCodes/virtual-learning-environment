@extends('layouts.app')

@section('content')
    <style>
        .learning-card {
            background: #ffffff;
            border: 2px solid #000;
            border-radius: 0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: all 0.2s ease;
            position: relative;
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .learning-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
        }

        .learning-card .thumbnail-box {
            height: 180px;
            overflow: hidden;
            background: #000;
            position: relative;
            border-bottom: 2px solid #000;
        }

        .learning-card .thumbnail-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
            transition: 0.5s;
        }

        .learning-card:hover .thumbnail-box img {
            opacity: 1;
            transform: scale(1.05);
        }

        .progress-bar-container {
            height: 8px;
            background: #f1f5f9;
            border: 2px solid #000;
            width: 100%;
            position: relative;
            box-shadow: inset 2px 2px 0px 0px rgba(0, 0, 0, 0.1);
        }

        .progress-bar-fill {
            height: 100%;
            background: var(--accent-primary);
            transition: width 1s ease;
            position: relative;
        }

        .progress-bar-fill::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 2px;
            height: 100%;
            background: #000;
        }

        .category-tag {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #fff;
            color: #000;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            padding: 4px 10px;
            letter-spacing: 1px;
            border: 2px solid #000;
            box-shadow: 2px 2px 0px 0px #000;
            z-index: 10;
        }

        .btn-sq-primary {
            background: var(--accent-primary);
            color: #fff;
            border: 2px solid #000;
            padding: 12px 20px;
            border-radius: 0;
            font-size: 13px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 4px 4px 0px 0px #000;
            text-decoration: none;
        }

        .btn-sq-primary:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #000;
            color: #fff;
        }

        .btn-sq-primary:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000;
        }
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 40px 5%;">

            <div
                style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; border-bottom: 2px solid #000; padding-bottom: 20px; flex-wrap: wrap; gap: 20px;">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px; background: #e2e8f0; display: inline-block; padding: 4px 8px; border: 2px solid #000;">
                        <i class="fa-solid fa-graduation-cap" style="margin-right: 6px;"></i> Repositori Siswa
                    </div>
                    <h1
                        style="font-size: 36px; font-weight: 900; color: #000; margin: 0; letter-spacing: -1.5px; text-transform: uppercase;">
                        Kursus Saya</h1>
                    <p style="color: #475569; font-size: 14px; font-weight: 600; margin-top: 5px;">Pantau kemajuan dan kelola aset pembelajaran aktif Anda.</p>
                </div>
                <div
                    style="background: #fff; border: 2px solid #000; padding: 10px 15px; display: flex; align-items: center; gap: 15px; box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                    <span
                        style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px;">Aset
                        Aktif:</span>
                    <span
                        style="font-size: 20px; font-weight: 900; color: #000; line-height: 1;">{{ sprintf('%02d', $enrollments->count()) }}</span>
                </div>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 12px 15px; margin-bottom: 30px; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 10px; box-shadow: 4px 4px 0px 0px #10b981;">
                    <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i> {{ session('success') }}
                </div>
            @endif

            @if ($enrollments->isEmpty())
                <div
                    style="text-align: center; padding: 80px 20px; border: 2px dashed #000; background: #fff; box-shadow: 8px 8px 0px 0px #000;">
                    <div
                        style="width: 80px; height: 80px; border: 3px solid #000; display: inline-flex; align-items: center; justify-content: center; font-size: 36px; color: #000; margin-bottom: 25px; background: #f8fafc; box-shadow: 6px 6px 0px 0px var(--accent-primary);">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <h3
                        style="font-size: 20px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">
                        Repositori Kosong</h3>
                    <p
                        style="color: #475569; margin-bottom: 35px; font-size: 14px; font-weight: 600; max-width: 400px; margin-left: auto; margin-right: auto;">
                        Mulai pengembangan profesional Anda dengan mengambil kursus pertama.</p>
                    <a href="{{ route('home') }}" class="btn-sq-primary">
                        JELAJAHI KATALOG <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                    </a>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 40px;">
                    @foreach ($enrollments as $enrollment)
                        <div class="learning-card">
                            <div class="thumbnail-box">
                                <span class="category-tag">{{ $enrollment->course->category->name ?? 'Course' }}</span>
                                <img src="{{ $enrollment->course->thumbnail }}" alt="{{ $enrollment->course->title }}">
                                <div
                                    style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.9)); padding: 40px 20px 15px; display: flex; justify-content: space-between; align-items: flex-end;">
                                    <div
                                        style="font-size: 10px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; gap: 6px;">
                                        <i class="fa-regular fa-calendar-check" style="color: var(--accent-primary);"></i>
                                        Terdaftar: {{ $enrollment->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </div>

                            <div style="padding: 25px; flex-grow: 1; display: flex; flex-direction: column;">
                                <h3
                                    style="font-size: 18px; font-weight: 900; color: #000; margin: 0 0 25px; line-height: 1.4; height: 50px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-transform: uppercase;">
                                    {{ $enrollment->course->title }}
                                </h3>

                                <div style="margin-top: auto;">
                                    @php
                                        $totalLessons = 0;
                                        foreach ($enrollment->course->sections as $sec) {
                                            $totalLessons += $sec->lessons->count();
                                        }
                                        $lessonIds = $enrollment->course->sections->flatMap->lessons->pluck('id');

                                        $completedLessons = \App\Models\LessonProgress::where('user_id', Auth::id())
                                            ->whereIn('lesson_id', $lessonIds)
                                            ->where('is_completed', true)
                                            ->count();

                                        $progressPercentage =
                                            $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;
                                    @endphp

                                    <div
                                        style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 2px dashed #cbd5e1;">
                                        <div>
                                            <div
                                                style="font-size: 10px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">
                                                Indeks Penyelesaian</div>
                                            <div style="font-size: 24px; font-weight: 900; color: #000; line-height: 1;">
                                                {{ $progressPercentage }}<span
                                                    style="font-size: 14px; color: var(--accent-primary);">%</span></div>
                                        </div>
                                        <div style="text-align: right;">
                                            <div
                                                style="font-size: 10px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">
                                                Pencapaian</div>
                                            <div style="font-size: 14px; font-weight: 900; color: #475569;">
                                                <span style="color: #000;">{{ sprintf('%02d', $completedLessons) }}</span> /
                                                {{ sprintf('%02d', $totalLessons) }}
                                                <span style="font-size: 10px; text-transform: uppercase;">Unit</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress-bar-container" style="margin-bottom: 30px;">
                                        <div class="progress-bar-fill"
                                            style="width: {{ $progressPercentage }}%; background: {{ $progressPercentage == 100 ? '#10b981' : 'var(--accent-primary)' }};">
                                        </div>
                                    </div>

                                    @php
                                        $firstLessonId =
                                            optional(optional($enrollment->course->sections->first())->lessons)->first()
                                                ->id ?? 1;
                                    @endphp

                                    <div style="display: flex; background: #fff; border: 2px solid #000; box-shadow: 4px 4px 0px 0px #000; transition: all 0.2s ease; margin-bottom: 20px;"
                                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='6px 6px 0px 0px #000';"
                                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='4px 4px 0px 0px #000';">

                                        @if($enrollment->status === 'active')
                                            <a href="{{ route('courses.watch', [$enrollment->course->slug, $firstLessonId]) }}"
                                                style="flex: 1; text-align: center; padding: 14px; background: #fff; color: #000; font-size: 13px; font-weight: 900; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; transition: 0.2s; border-right: 2px solid #000;"
                                                onmouseover="this.style.background='var(--accent-primary)'; this.style.color='#fff';"
                                                onmouseout="this.style.background='#fff'; this.style.color='#000';">
                                                @if ($progressPercentage == 0)
                                                    <i class="fa-solid fa-play" style="margin-right: 6px;"></i> MULAI
                                                @elseif($progressPercentage == 100)
                                                    <i class="fa-solid fa-rotate-right" style="margin-right: 6px;"></i>
                                                    PELAJARI LAGI
                                                @else
                                                    <i class="fa-solid fa-forward-step" style="margin-right: 6px;"></i> LANJUTKAN
                                                @endif
                                            </a>
                                        @else
                                            <a href="{{ route('courses.show', $enrollment->course->slug) }}"
                                                style="flex: 1; text-align: center; padding: 14px; background: #fef3c7; color: #92400e; font-size: 11px; font-weight: 950; text-transform: uppercase; border-right: 2px solid #000; text-decoration: none; transition: 0.2s;"
                                                onmouseover="this.style.background='var(--accent-primary)'; this.style.color='#fff';"
                                                onmouseout="this.style.background='#fef3c7'; this.style.color='#92400e';">
                                                <i class="fa-solid fa-arrow-right" style="margin-right: 6px;"></i> SELESAIKAN PENDAFTARAN
                                            </a>
                                        @endif
                                        <a href="{{ route('courses.show', $enrollment->course->slug) }}"
                                            style="width: 50px; display: flex; align-items: center; justify-content: center; background: #fff; color: #000; text-decoration: none; transition: 0.2s;"
                                            onmouseover="this.style.background='#000'; this.style.color='#fff';"
                                            onmouseout="this.style.background='#fff'; this.style.color='#000';">
                                            <i class="fa-solid fa-list" style="font-size: 16px;"></i>
                                        </a>
                                    </div>


                                    <button type="button"
                                        onclick="triggerTerm('term-form-{{ $enrollment->id }}', '{{ addslashes($enrollment->course->title) }}')"
                                        style="width: 100%; padding: 10px; background: #fff; color: #e11d48; border: 2px solid #000; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: 0.2s; box-shadow: 2px 2px 0px 0px #e11d48;"
                                        onmouseover="this.style.background='#fff1f2'; this.style.transform='translate(-1px, -1px)'; this.style.boxShadow='3px 3px 0px 0px #e11d48';"
                                        onmouseout="this.style.background='#fff'; this.style.transform='translate(0, 0)'; this.style.boxShadow='2px 2px 0px 0px #e11d48';">
                                        <i class="fa-solid fa-trash-can" style="margin-right: 8px;"></i> HAPUS KURSUS & DATA
                                    </button>

                                    <form id="term-form-{{ $enrollment->id }}"
                                        action="{{ route('courses.terminate', $enrollment->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    <!-- Terminate Modal -->
    <div id="term-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(4px); z-index: 9999; justify-content: center; align-items: center; padding: 20px;">
        <div id="term-card"
            style="background: #fff; width: 450px; max-width: 100%; border: 4px solid #000; box-shadow: 15px 15px 0px 0px #e11d48; transform: scale(0.9); opacity: 0; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 35px; text-align: center;">
                <div
                    style="width: 80px; height: 80px; background: #fff1f2; color: #e11d48; border: 3px solid #000; display: inline-flex; align-items: center; justify-content: center; font-size: 32px; margin-bottom: 25px; box-shadow: 6px 6px 0px 0px #e11d48;">
                    <i class="fa-solid fa-biohazard"></i>
                </div>
                <h3
                    style="font-size: 20px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: -0.5px; margin-bottom: 12px;">
                    KRITIS: PENGHAPUSAN KURSUS</h3>
                <p style="font-size: 13px; color: #475569; font-weight: 600; line-height: 1.6; margin-bottom: 30px;">
                    Anda akan menghapus data kursus <span id="course-name-display"
                        style="color: #e11d48; font-weight: 900; border-bottom: 2px solid #e11d48;">[KURSUS]</span>.
                    <br><br>
                    <strong>PERINGATAN:</strong> Tindakan ini akan menghapus semua kemajuan kurikulum, catatan kuis, dan pengiriman tugas. Tindakan ini tidak dapat dibatalkan.
                </p>
                <div style="display: flex; gap: 15px;">
                    <button id="term-confirm-btn"
                        style="flex: 1; padding: 15px; background: #e11d48; color: #fff; border: 3px solid #000; font-size: 12px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 4px 4px 0px 0px #000; transition: 0.2s;">
                        HAPUS DATA
                    </button>
                    <button onclick="closeTermModal()"
                        style="flex: 1; padding: 15px; background: #fff; color: #000; border: 3px solid #000; font-size: 12px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 4px 4px 0px 0px #000; transition: 0.2s;">
                        BATALKAN
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let pendingForm = null;

        function triggerTerm(formId, courseName) {
            pendingForm = document.getElementById(formId);
            document.getElementById('course-name-display').innerText = courseName;

            const modal = document.getElementById('term-modal');
            const card = document.getElementById('term-card');

            modal.style.display = 'flex';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'scale(1)';
            }, 10);
        }

        function closeTermModal() {
            const modal = document.getElementById('term-modal');
            const card = document.getElementById('term-card');

            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        document.getElementById('term-confirm-btn').addEventListener('click', function() {
            if (pendingForm) {
                pendingForm.submit();
            }
        });
    </script>
@endsection
