@if (isset($quizQuestions) && $quizQuestions->count() > 0)
    <div id="tab-quiz" class="tab-pane">
        <div class="pane-title">
            <span><i class="fa-solid fa-clipboard-question" style="margin-right: 8px; color: var(--text-sec);"></i>
                Cek Pemahaman</span>
            <span class="sq-badge text-prim bg-sec"><i class="fa-solid fa-list-check"
                    style="margin-right: 6px;"></i>{{ $quizQuestions->count() }} Pertanyaan</span>
        </div>

        @php
            $hasSessionResult = session('quiz_result');
            $hasDbResult = isset($quizResult);

            // Result is outdated if the number of questions has changed since last attempt
            $isOutdated = $hasDbResult && $quizResult->total_questions !== $quizQuestions->count();

            $showResult = $hasSessionResult || ($hasDbResult && !$isOutdated);

            $resultPerc = session('quiz_result')['percentage'] ?? ($quizResult->percentage ?? 0);
            $resultScore = session('quiz_result')['score'] ?? ($quizResult->score ?? 0);
            $resultTotal = session('quiz_result')['total'] ?? ($quizResult->total_questions ?? 0);
            $resultMessage =
                session('quiz_result')['message'] ??
                "Skor Anda adalah $resultScore dari $resultTotal (" . number_format($resultPerc, 0) . '%).';
        @endphp

        @if ($showResult)
            <div class="item-card"
                style="padding: 40px; background: {{ $resultPerc >= 50 ? '#ecfdf5' : '#fef2f2' }}; border: 2px dashed {{ $resultPerc >= 50 ? '#10b981' : '#ef4444' }}; margin-bottom: 30px;">
                <div
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                    <div
                        style="width: 80px; height: 80px; background: {{ $resultPerc >= 50 ? '#10b981' : '#ef4444' }}; display: flex; align-items: center; justify-content: center; margin-bottom: 25px; box-shadow: 4px 4px 0px rgba(0,0,0,0.1);">
                        <i class="{{ $resultPerc >= 50 ? 'fa-solid fa-trophy' : 'fa-solid fa-circle-xmark' }}"
                            style="font-size: 32px; color: #fff;"></i>
                    </div>

                    <h5
                        style="font-size: 24px; font-weight: 800; color: {{ $resultPerc >= 50 ? '#065f46' : '#991b1b' }}; margin-bottom: 25px; text-transform: uppercase; letter-spacing: -0.5px;">
                        {{ $resultPerc >= 50 ? 'Pekerjaan Luar Biasa!' : 'Terus Berlatih!' }}
                    </h5>

                    <div
                        style="background: #fff; border: 2px solid {{ $resultPerc >= 50 ? '#10b981' : '#ef4444' }}; padding: 25px 40px; display: inline-block; box-shadow: 6px 6px 0px {{ $resultPerc >= 50 ? 'rgba(16,185,129,0.2)' : 'rgba(239,68,68,0.2)' }};">
                        <div
                            style="font-size: 13px; font-weight: 800; color: var(--text-sec); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                            Skor Akhir Anda</div>
                        <div
                            style="font-size: 42px; font-weight: 800; color: {{ $resultPerc >= 50 ? '#10b981' : '#ef4444' }}; line-height: 1; margin-bottom: 6px;">
                            {{ $resultScore }}<span
                                style="font-size: 22px; color: var(--text-sec);">/{{ $resultTotal }}</span>
                        </div>
                        <div style="font-size: 15px; font-weight: 700; color: var(--text-prim);">
                            Akurasi {{ number_format($resultPerc, 0) }}%</div>
                    </div>
                </div>
            </div>
        @else
            <div id="quiz-intro-screen"
                style="text-align: center; padding: 60px 40px; background: #fff; border: 1px solid var(--border-color); margin-bottom: 30px;">
                <i class="fa-solid fa-hourglass-start"
                    style="font-size: 32px; color: var(--text-prim); margin-bottom: 25px; display: block;"></i>
                <h4
                    style="font-size: 18px; font-weight: 800; color: var(--text-prim); margin-bottom: 15px; text-transform: uppercase;">
                    Siap untuk memulai?</h4>
                <p style="font-size: 14px; color: var(--text-sec); margin-bottom: 25px;">Anda akan memiliki
                    <strong>{{ $lesson->quiz_duration ?? 15 }} menit</strong> untuk menyelesaikan kuis ini. Setelah dimulai, waktu tidak dapat dihentikan.
                </p>

                <div
                    style="text-align: left; max-width: 400px; margin: 0 auto 35px; background: #f8fafc; border: 1px solid var(--border-color); padding: 20px;">
                    <h5
                        style="font-size: 12px; font-weight: 800; color: var(--text-prim); text-transform: uppercase; margin-bottom: 12px; border-bottom: 1px dashed var(--border-color); padding-bottom: 8px;">
                        <i class="fa-solid fa-clipboard-list" style="margin-right: 5px;"></i> Aturan Penilaian
                    </h5>
                    <ul
                        style="font-size: 13px; color: var(--text-sec); padding-left: 20px; line-height: 1.6; margin: 0; font-weight: 500;">
                        <li style="margin-bottom: 8px;">Anda hanya memiliki <strong style="color: var(--text-prim)">1 kesempatan</strong>. Tidak ada pengulangan.</li>
                        <li style="margin-bottom: 8px;">Pastikan koneksi internet stabil sebelum memulai.</li>
                        <li style="margin-bottom: 8px;">Jangan menutup atau memuat ulang (refresh) tab browser selama kuis berlangsung.</li>
                        <li style="margin-bottom: 0;">Jika waktu habis, jawaban Anda saat ini akan dikirim secara otomatis.</li>
                    </ul>
                </div>
                <button type="button" id="start-quiz-btn" class="btn-sq-primary"
                    style="padding: 12px 35px; font-size: 15px;">
                    <i class="fa-solid fa-play" style="margin-right: 8px;"></i> MULAI KUIS
                </button>
            </div>

            <!-- Quiz Start Confirmation Modal -->
            <div id="quiz-start-modal"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 1200; align-items: center; justify-content: center;">
                <div
                    style="background: #fff; width: 450px; max-width: 90%; border: 3px solid var(--text-prim); box-shadow: 10px 10px 0px rgba(0,0,0,0.1); padding: 30px; text-align: center;">
                    <div
                        style="width: 70px; height: 70px; background: #e0f2fe; color: #0284c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px; border: 2px solid #0284c7;">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <h3
                        style="font-size: 16px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: var(--text-prim); margin-bottom: 12px;">
                        Konfirmasi Tindakan</h3>
                    <p
                        style="font-size: 12px; color: var(--text-sec); font-weight: 600; line-height: 1.6; margin-bottom: 30px;">
                        Apakah Anda yakin ingin memulai? <br>
                        Waktu ({{ $lesson->quiz_duration ?? 15 }} menit) akan segera dimulai dan tidak dapat dihentikan.
                    </p>
                    <div style="display: flex; gap: 12px; justify-content: center;">
                        <button type="button" id="modal-confirm-start" class="btn-sq-primary"
                            style="padding: 12px 25px; font-size: 12px; font-weight: 900; background: #0284c7; border-color: #0284c7;">
                            YA, MULAI SEKARANG
                        </button>
                        <button type="button" id="modal-abort-start" class="btn-sq-outline"
                            style="padding: 12px 25px; font-size: 12px; font-weight: 900;">
                            BATAL
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quiz Security Warning Modal -->
            <div id="quiz-security-modal"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(4px); z-index: 1200; align-items: center; justify-content: center;">
                <div
                    style="background: #fff; width: 450px; max-width: 90%; border: 3px solid #ef4444; box-shadow: 10px 10px 0px rgba(239,68,68,0.2); padding: 30px; text-align: center;">
                    <div
                        style="width: 70px; height: 70px; background: #fef2f2; color: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px; border: 2px solid #ef4444;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h3
                        style="font-size: 16px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: #ef4444; margin-bottom: 12px;">
                        PERINGATAN KEAMANAN</h3>
                    <p
                        style="font-size: 13px; color: var(--text-sec); font-weight: 600; line-height: 1.6; margin-bottom: 25px;">
                        Anda telah berpindah tab atau mengecilkan browser selama kuis aktif. Ini adalah pelanggaran ketat terhadap aturan penilaian. <br><br>
                        <span id="security-warning-text" style="color: #ef4444; font-weight: 800;">Jika Anda meninggalkan tab ini lagi, kuis Anda akan dikirim secara paksa!</span>
                    </p>
                    <button type="button" onclick="document.getElementById('quiz-security-modal').style.display='none'"
                        class="btn-sq-primary"
                        style="padding: 12px 35px; font-size: 13px; font-weight: 900; background: #ef4444; border-color: #ef4444; width: 100%;">
                        SAYA MENGERTI, KEMBALI KE KUIS
                    </button>
                </div>
            </div>

            <!-- Quiz Critical Violation Modal -->
            <div id="quiz-critical-modal"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.9); backdrop-filter: blur(8px); z-index: 1250; align-items: center; justify-content: center;">
                <div
                    style="background: #fff; width: 450px; max-width: 90%; border: 3px solid #000; box-shadow: 10px 10px 0px rgba(255,255,255,0.2); padding: 40px 30px; text-align: center;">
                    <div
                        style="width: 70px; height: 70px; background: #000; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px;">
                        <i class="fa-solid fa-ban"></i>
                    </div>
                    <h3
                        style="font-size: 18px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: #000; margin-bottom: 12px;">
                        PELANGGARAN KRITIS</h3>
                    <p
                        style="font-size: 13px; color: var(--text-sec); font-weight: 600; line-height: 1.6; margin-bottom: 0;">
                        Anda telah berulang kali meninggalkan area kuis aktif. Penilaian Anda sedang dikirim secara paksa ke server sekarang.
                    </p>
                </div>
            </div>

            <form id="quiz-form" action="{{ route('quiz.submit', $lesson->id) }}" method="POST"
                style="display: none;">
                @csrf
                <input type="hidden" name="is_force_submitted" id="force_submit_field" value="0">
                <div class="quiz-timer-bar"
                    style="background: var(--bg-sec); border-left: 4px solid var(--text-prim); padding: 15px 20px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; border-radius: 0; position: sticky; z-index: 100; box-shadow: 0px 4px 10px rgba(0,0,0,0.05);">
                    <div style="font-size: 14px; font-weight: 700; color: var(--text-prim); text-transform: uppercase;">
                        <i class="fa-solid fa-stopwatch" style="margin-right: 8px;"></i> Sisa Waktu
                    </div>
                    <div id="quiz-timer"
                        style="font-size: 20px; font-weight: 800; color: var(--text-prim); font-variant-numeric: tabular-nums;">
                        --:--
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    @foreach ($quizQuestions as $index => $qq)
                        <div class="item-card quiz-question-card"
                            style="background: #fff; border: 1px solid var(--border-color); box-shadow: none; display: none;">
                            <div class="item-body" style="padding: 25px;">
                                <div style="display: flex; align-items: flex-start; gap: 15px; margin-bottom: 25px;">
                                    <div
                                        style="background: var(--text-prim); color: #fff; padding: 6px 14px; font-size: 14px; font-weight: 800; flex-shrink: 0;">
                                        Q{{ $index + 1 }}
                                    </div>
                                    <div
                                        style="font-size: 15px; font-weight: 700; color: var(--text-prim); line-height: 1.6; margin-top: 3px;">
                                        {!! nl2br(e(trim($qq->question))) !!}
                                    </div>
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    <label class="radio-sq">
                                        <input type="radio" name="answers[{{ $qq->id }}]" value="A"
                                            required>
                                        <span style="font-size: 14px; font-weight: 500;"><strong
                                                style="color: var(--text-sec); margin-right: 10px;">A.</strong>
                                            {{ $qq->option_a }}</span>
                                    </label>
                                    <label class="radio-sq">
                                        <input type="radio" name="answers[{{ $qq->id }}]" value="B">
                                        <span style="font-size: 14px; font-weight: 500;"><strong
                                                style="color: var(--text-sec); margin-right: 10px;">B.</strong>
                                            {{ $qq->option_b }}</span>
                                    </label>
                                    @if ($qq->option_c)
                                        <label class="radio-sq">
                                            <input type="radio" name="answers[{{ $qq->id }}]"
                                                value="C">
                                            <span style="font-size: 14px; font-weight: 500;"><strong
                                                    style="color: var(--text-sec); margin-right: 10px;">C.</strong>
                                                {{ $qq->option_c }}</span>
                                        </label>
                                    @endif
                                    @if ($qq->option_d)
                                        <label class="radio-sq">
                                            <input type="radio" name="answers[{{ $qq->id }}]"
                                                value="D">
                                            <span style="font-size: 14px; font-weight: 500;"><strong
                                                    style="color: var(--text-sec); margin-right: 10px;">D.</strong>
                                                {{ $qq->option_d }}</span>
                                        </label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div
                    style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center; border-top: 2px dashed var(--border-color); padding-top: 25px;">
                    <div>
                        <button type="button" id="quiz-prev-btn" class="btn-sq-outline"
                            style="display: none; padding: 10px 20px;">
                            <i class="fa-solid fa-arrow-left"></i> Sebelumnya
                        </button>
                    </div>
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <span id="quiz-page-indicator"
                            style="font-size: 13px; font-weight: 700; color: var(--text-sec); text-transform: uppercase;"></span>
                        <button type="button" id="quiz-next-btn" class="btn-sq-primary"
                            style="padding: 10px 20px;">
                            Selanjutnya <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        <button type="submit" id="quiz-submit-btn" class="btn-sq-primary"
                            style="display: none; padding: 10px 20px;">
                            <i class="fa-solid fa-flag-checkered"></i> Kirim Jawaban Saya
                        </button>
                    </div>
                </div>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('quiz-form');
                    const introScreen = document.getElementById('quiz-intro-screen');
                    const startBtn = document.getElementById('start-quiz-btn');
                    const timerDisplay = document.getElementById('quiz-timer');

                    // Allow custom duration assigned by instructor or default to 15 mins
                    const fullDuration = {{ ($lesson->quiz_duration ?? 15) * 60 }};
                    let timeLeft = fullDuration;
                    const durationVersion = {{ $lesson->quiz_duration ?? 15 }};
                    const storageKey = 'quiz_timer_lesson_{{ $lesson->id }}_v' + durationVersion;
                    const savedTime = localStorage.getItem(storageKey);
                    let timerInterval;

                    // Pagination logic
                    const questions = document.querySelectorAll('.quiz-question-card');
                    const prevBtn = document.getElementById('quiz-prev-btn');
                    const nextBtn = document.getElementById('quiz-next-btn');
                    const submitBtn = document.getElementById('quiz-submit-btn');
                    const pageIndicator = document.getElementById('quiz-page-indicator');

                    const perPage = 5;
                    let currentPage = 1;
                    const totalPages = Math.ceil(questions.length / perPage) || 1;

                    function renderPagination() {
                        // Hide all
                        questions.forEach(q => q.style.display = 'none');

                        // Show current page
                        const start = (currentPage - 1) * perPage;
                        const end = start + perPage;
                        for (let i = start; i < end && i < questions.length; i++) {
                            questions[i].style.display = 'block';
                        }

                        // Update buttons
                        if (currentPage === 1) {
                            if (prevBtn) prevBtn.style.display = 'none';
                        } else {
                            if (prevBtn) prevBtn.style.display = 'inline-flex';
                        }

                        if (currentPage === totalPages) {
                            if (nextBtn) nextBtn.style.display = 'none';
                            if (submitBtn) submitBtn.style.display = 'inline-flex';
                        } else {
                            if (nextBtn) nextBtn.style.display = 'inline-flex';
                            if (submitBtn) submitBtn.style.display = 'none';
                        }

                        if (pageIndicator) {
                            pageIndicator.textContent = `Halaman ${currentPage} dari ${totalPages}`;
                        }
                    }

                    if (prevBtn) {
                        prevBtn.addEventListener('click', function() {
                            if (currentPage > 1) {
                                currentPage--;
                                renderPagination();
                                // Optional smooth scroll to top of form
                                form.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }
                        });
                    }

                    if (nextBtn) {
                        nextBtn.addEventListener('click', function() {
                            if (currentPage < totalPages) {
                                currentPage++;
                                renderPagination();
                                form.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }
                        });
                    }

                    renderPagination();

                    function updateTimerDisplay() {
                        const minutes = Math.floor(timeLeft / 60);
                        const seconds = timeLeft % 60;
                        timerDisplay.textContent =
                            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                        if (timeLeft <= 60) {
                            timerDisplay.style.color = '#ef4444'; // Red warning
                        }
                    }

                    function startTimer() {
                        updateTimerDisplay();
                        timerInterval = setInterval(function() {
                            timeLeft--;
                            localStorage.setItem(storageKey, timeLeft);
                            updateTimerDisplay();

                            if (timeLeft <= 0) {
                                clearInterval(timerInterval);
                                localStorage.removeItem(storageKey);

                                timerDisplay.textContent = '00:00';
                                alert('Waktu habis! Jawaban Anda akan dikirim secara otomatis.');

                                if (form) form.submit();
                            }
                        }, 1000);
                    }

                    function showQuiz() {
                        if (introScreen) introScreen.style.display = 'none';
                        if (form) form.style.display = 'block';
                    }

                    // If user refreshed and already had a running timer, auto-start and skip intro
                    if (savedTime && parseInt(savedTime) > 0 && parseInt(savedTime) <= fullDuration) {
                        timeLeft = parseInt(savedTime);
                        showQuiz();
                        startTimer();
                    } else {
                        const startModal = document.getElementById('quiz-start-modal');
                        const confirmStart = document.getElementById('modal-confirm-start');
                        const abortStart = document.getElementById('modal-abort-start');

                        // Wait for user to click Start
                        if (startBtn && startModal) {
                            startBtn.addEventListener('click', function() {
                                startModal.style.display = 'flex';
                            });
                        }

                        if (abortStart && startModal) {
                            abortStart.addEventListener('click', function() {
                                startModal.style.display = 'none';
                            });
                        }

                        if (confirmStart && startModal) {
                            confirmStart.addEventListener('click', function() {
                                startModal.style.display = 'none';
                                timeLeft = fullDuration;
                                localStorage.setItem(storageKey, timeLeft);
                                showQuiz();
                                startTimer();
                            });
                        }
                    }

                    // Clear storage when manually submitted
                    if (form) {
                        form.addEventListener('submit', function() {
                            clearInterval(timerInterval);
                            localStorage.removeItem(storageKey);
                        });
                    }

                    // Strict Security: Detect Tab Switching or Minimizing
                    let securityViolations = 0;
                    const maxWarnings = {{ $lesson->quiz_max_warnings ?? 5 }};

                    document.addEventListener("visibilitychange", function() {
                        // Only trigger if the quiz form is actively shown
                        if (form && form.style.display === 'block' && document.visibilityState === 'hidden') {
                            securityViolations++;
                            const warningsLeft = maxWarnings - securityViolations;

                            if (securityViolations < maxWarnings) {
                                const warningTextEl = document.getElementById('security-warning-text');
                                if (warningTextEl) {
                                    if (warningsLeft === 1) {
                                        warningTextEl.innerText =
                                            "Jika Anda meninggalkan tab ini lagi, kuis Anda akan dikirim secara paksa!";
                                    } else {
                                        warningTextEl.innerText =
                                            `Anda memiliki ${warningsLeft} peringatan tersisa sebelum kuis dikirim secara paksa.`;
                                    }
                                }
                                document.getElementById('quiz-security-modal').style.display = 'flex';
                            } else if (securityViolations >= maxWarnings) {
                                document.getElementById('quiz-critical-modal').style.display = 'flex';
                                clearInterval(timerInterval);
                                localStorage.removeItem(storageKey);
                                document.getElementById('force_submit_field').value = "1";
                                // add small delay so user can read the critical violation message
                                setTimeout(() => {
                                    form.submit();
                                }, 3000);
                            }
                        }
                    });
                });
            </script>
        @endif
    </div>
@endif
