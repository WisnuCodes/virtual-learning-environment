<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@php
    $activeAssignments = [];
    $submittedAssignments = [];
    $missedAssignments = [];

    if (isset($assignments)) {
        foreach ($assignments as $assignment) {
            $submission = $assignment->submissions->first();
            $isPastDue = $assignment->due_date && \Carbon\Carbon::parse($assignment->due_date)->isPast();

            if ($submission) {
                $submittedAssignments[] = $assignment;
            } elseif ($isPastDue) {
                $missedAssignments[] = $assignment;
            } else {
                $activeAssignments[] = $assignment;
            }
        }
    }

    $groups = [
        ['title' => 'Aktif', 'id' => 'active', 'icon' => 'fa-file-pen', 'items' => $activeAssignments],
        ['title' => 'Terkirim', 'id' => 'submitted', 'icon' => 'fa-check-circle', 'items' => $submittedAssignments],
        ['title' => 'Melewati Batas', 'id' => 'overdue', 'icon' => 'fa-clock', 'items' => $missedAssignments],
    ];
@endphp

@if (isset($assignments) && $assignments->count() > 0)
    <div id="tab-assignments" class="tab-pane">

        <!-- Header & Toggle Buttons -->
        <div
            style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
            <div class="pane-title" style="margin-bottom: 0;">
                <span><i class="fa-solid fa-file-signature" style="margin-right: 8px; color: var(--text-sec);"></i> Tugas & Penugasan</span>
            </div>

            <div style="display: flex; gap: 10px; flex-wrap: wrap; width: 100%;">
                <button type="button" id="toggle-active" onclick="toggleAssignments('active', event)"
                    class="btn-sq-primary"
                    style="flex: 1 1 30%; padding: 12px; font-size: 13px; transition: 0.2s ease; text-align: center; justify-content: center;">
                    <i class="fa-solid fa-file-pen" style="margin-right: 6px;"></i> Aktif
                    ({{ count($activeAssignments) }})
                </button>
                <button type="button" id="toggle-submitted" onclick="toggleAssignments('submitted', event)"
                    class="btn-sq-outline"
                    style="flex: 1 1 30%; padding: 12px; font-size: 13px; transition: 0.2s ease; text-align: center; justify-content: center;">
                    <i class="fa-solid fa-check-circle" style="margin-right: 6px;"></i> Terkirim
                    ({{ count($submittedAssignments) }})
                </button>
                <button type="button" id="toggle-overdue" onclick="toggleAssignments('overdue', event)"
                    class="btn-sq-outline"
                    style="flex: 1 1 30%; padding: 12px; font-size: 13px; transition: 0.2s ease; color: var(--text-sec); border-color: var(--border-color); text-align: center; justify-content: center;">
                    <i class="fa-solid fa-clock" style="margin-right: 6px;"></i> Terlambat
                    ({{ count($missedAssignments) }})
                </button>
            </div>
        </div>

        @if (session('success_assignment'))
            <div class="alert-sq-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success_assignment') }}
            </div>
        @endif
        @if (session('error_assignment'))
            <div class="alert-sq-error">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error_assignment') }}
            </div>
        @endif

        @foreach ($groups as $group)
            <div id="group-{{ $group['id'] }}"
                style="display: {{ $group['id'] === 'active' ? 'block' : 'none' }}; margin-bottom: 40px; animation: fadeIn 0.3s ease-in-out;">

                @if (count($group['items']) == 0)
                    <!-- Empty State -->
                    <div
                        style="text-align: center; padding: 60px 20px; background: var(--bg-sec); border: 2px dashed var(--border-color);">
                        <div
                            style="width: 70px; height: 70px; background: #fff; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fa-solid {{ $group['icon'] }}"
                                style="font-size: 28px; color: var(--text-prim);"></i>
                        </div>
                        <h6
                            style="color: var(--text-prim); font-weight: 800; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                            Tidak Ada {{ $group['title'] }}</h6>
                        <p style="font-size: 13px; color: var(--text-sec); margin: 0;">Saat ini tidak ada konten untuk ditampilkan.</p>
                    </div>
                @else
                    <div style="display: flex; flex-direction: column; gap: 30px;">
                        @foreach ($group['items'] as $assignment)
                            @php $submission = $assignment->submissions->first(); @endphp
                            <div class="item-card">
                                <div class="item-header"
                                    style="align-items: center; padding: 20px 25px; border-bottom: 2px solid var(--border-color);">
                                    <div>
                                        <h5
                                            style="font-size: 16px; font-weight: 800; color: var(--text-prim); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                                            {{ $assignment->title }}</h5>
                                        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                                            <span class="sq-badge">Max Score: {{ $assignment->max_score }}</span>
                                            @if ($assignment->due_date)
                                                <span class="sq-badge text-danger"><i class="fa-solid fa-clock"
                                                        style="margin-right: 6px;"></i> Due:
                                                    {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y - h:i A') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        @if ($submission)
                                            @if ($submission->status === 'graded')
                                                <span class="sq-badge text-success"><i class="fa-solid fa-check-double"
                                                        style="margin-right: 6px;"></i> GRADED</span>
                                            @else
                                                <span class="sq-badge text-warning"><i
                                                        class="fa-solid fa-clock-rotate-left"
                                                        style="margin-right: 6px;"></i> SUBMITTED</span>
                                            @endif
                                        @else
                                            @if ($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date)->isPast())
                                                <span class="sq-badge text-danger"><i class="fa-solid fa-xmark"
                                                        style="margin-right: 6px;"></i> MISSED/OVERDUE</span>
                                            @else
                                                <span class="sq-badge"><i class="fa-solid fa-pen-to-square"
                                                        style="margin-right: 6px;"></i> TO
                                                    DO</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="item-body">
                                    <!-- Submission Info Box -->
                                    <div class="submission-info-container">
                                        <h6 class="submission-info-title">Submission Info</h6>
                                        <div class="submission-info-box">
                                            <div class="submission-info-row">
                                                <div class="submission-info-label">Bootcamp</div>
                                                <div class="submission-info-value">{{ $course->title }}</div>
                                            </div>
                                            <div class="submission-info-row">
                                                <div class="submission-info-label">Judul</div>
                                                <div class="submission-info-value">{{ $assignment->title }}</div>
                                            </div>
                                            <div class="submission-info-row">
                                                <div class="submission-info-label">Jenis Submission</div>
                                                <div class="submission-info-value">File</div>
                                            </div>
                                            <div class="submission-info-row">
                                                <div class="submission-info-label">Deadline Submission</div>
                                                <div class="submission-info-value">
                                                    @if ($assignment->due_date)
                                                        <span class="deadline-badge">
                                                            {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y, H:i') }}
                                                        </span>
                                                    @else
                                                        <span class="text-sec">No Deadline</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="submission-info-row">
                                                <div class="submission-info-label">Attachment</div>
                                                <div class="submission-info-value">
                                                    @if (isset($assignment->attachment))
                                                        <a href="{{ asset('storage/' . $assignment->attachment) }}"
                                                            target="_blank" style="color: #0ea5e9; text-decoration: none;">
                                                            <i class="fa-solid fa-paperclip"></i> View Attachment
                                                        </a>
                                                    @else
                                                        <span class="text-sec">No Attachment</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="submission-info-row">
                                                <div class="submission-info-label">Waktu Submit</div>
                                                <div class="submission-info-value">
                                                    @if ($submission)
                                                        {{ $submission->created_at->format('d M Y, H:i') }}
                                                    @else
                                                        <span class="text-sec">Belum Dikirim</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="submission-info-row">
                                                <div class="submission-info-label">Jawaban Student</div>
                                                <div class="submission-info-value">
                                                    @if ($submission && $submission->file_path)
                                                        <a href="{{ asset('storage/' . $submission->file_path) }}"
                                                            target="_blank" style="color: #0ea5e9; text-decoration: none;">
                                                            <i class="fa-solid fa-file-arrow-down"></i> Download Jawaban
                                                        </a>
                                                    @else
                                                        <span class="text-sec">Tidak Ada File</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    <!-- Grading Criteria Section -->
                                    @if ($assignment->grading_criteria && count($assignment->grading_criteria) > 0)
                                        <div style="margin-bottom: 35px;">
                                            <h6
                                                style="font-size: 13px; font-weight: 800; color: var(--text-prim); margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                                <span><i class="fa-solid fa-chart-pie" style="margin-right: 8px;"></i>
                                                    Kriteria Penilaian</span>
                                            </h6>
                                            <div
                                                style="background: #fff; border: 2px solid var(--text-prim); padding: 30px; display: flex; align-items: center; gap: 40px; flex-wrap: wrap; box-shadow: 4px 4px 0px 0px var(--accent);">
                                                <div style="flex: 1; min-width: 200px;">
                                                    <div style="display: flex; flex-direction: column; gap: 15px;">
                                                        @foreach ($assignment->grading_criteria as $index => $criteria)
                                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                                <div
                                                                    style="width: 15px; height: 15px; background: {{ ['#0ea5e9', '#6366f1', '#8b5cf6', '#ec4899', '#f43f5e', '#f59e0b'][$index % 6] }}; border: 1px solid var(--text-prim);">
                                                                </div>
                                                                <span
                                                                    style="font-size: 14px; font-weight: 600; color: var(--text-sec);">{{ $criteria['name'] }}
                                                                    ({{ $criteria['weight'] }}%)</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div style="width: 180px; height: 180px; position: relative;">
                                                    <canvas id="criteriaChart-{{ $assignment->id }}"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const ctx = document.getElementById('criteriaChart-{{ $assignment->id }}').getContext('2d');
                                                new Chart(ctx, {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: {!! json_encode(collect($assignment->grading_criteria)->pluck('name')) !!},
                                                        datasets: [{
                                                            data: {!! json_encode(collect($assignment->grading_criteria)->pluck('weight')) !!},
                                                            backgroundColor: ['#0ea5e9', '#6366f1', '#8b5cf6', '#ec4899', '#f43f5e',
                                                                '#f59e0b'
                                                            ],
                                                            borderWidth: 2,
                                                            borderColor: '#0f172a'
                                                        }]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        maintainAspectRatio: false,
                                                        plugins: {
                                                            legend: {
                                                                display: false
                                                            }
                                                        },
                                                        cutout: '60%'
                                                    }
                                                });
                                            });
                                        </script>
                                    @endif
                                    </div>

                                    <h6
                                        style="font-size: 13px; font-weight: 800; color: var(--text-prim); margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; justify-content: space-between;">
                                        <span><i class="fa-solid fa-list-check" style="margin-right: 8px;"></i>
                                            Description & Instructions</span>
                                    </h6>
                                    <div
                                        style="font-size: 14px; color: var(--text-sec); line-height: 1.7; margin-bottom: 35px; white-space: pre-line; background: var(--bg-sec); padding: 25px;">
                                        {!! nl2br(e(trim($assignment->description))) !!}
                                    </div>

                                    @if ($submission)
                                        <!-- Submission Status -->
                                        <div
                                            style="border: 2px dashed var(--border-color); background: #fff; padding: 25px;">
                                            <h6
                                                style="font-size: 13px; font-weight: 800; color: var(--text-prim); margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; justify-content: space-between;">
                                                <span><i class="fa-solid fa-inbox" style="margin-right: 8px;"></i> Your
                                                    Submission</span>
                                                <span
                                                    style="font-weight: 700; font-size: 11px; color: var(--text-sec);">{{ $submission->created_at->format('M d, Y') }}</span>
                                            </h6>
                                            @if ($submission->text_content)
                                                <div
                                                    style="font-size: 13px; color: var(--text-prim); margin-bottom: 15px; padding: 15px; background: var(--bg-sec); border: 1px solid var(--border-color); white-space: pre-line;">
                                                    {!! nl2br(e(trim($submission->text_content))) !!}
                                                </div>
                                            @endif
                                            @if ($submission->file_path)
                                                <a href="{{ asset('storage/' . $submission->file_path) }}"
                                                    target="_blank" class="btn-sq-outline"
                                                    style="font-size: 12px; padding: 6px 12px;">
                                                    <i class="fa-solid fa-paperclip"></i> View Attached File
                                                </a>
                                            @endif

                                            @if ($submission->status === 'graded')
                                                <!-- Project Grade Section (Premium Style) -->
                                                <div style="margin-top: 40px; border-top: 2px solid var(--border-color); padding-top: 40px;">
                                                    <h6 style="font-size: 14px; font-weight: 800; color: var(--text-prim); margin-bottom: 25px; text-transform: uppercase;">
                                                        Nilai Proyek
                                                    </h6>
                                                    
                                                    <!-- Total Grades Banner -->
                                                    <div style="background: #22c55e; color: #fff; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 2px solid #15803d;">
                                                        <span style="font-weight: 800; font-size: 16px;">Total Grades</span>
                                                        <span style="font-weight: 900; font-size: 20px;">{{ number_format($submission->score, 2) }}</span>
                                                    </div>

                                                    @if ($submission->criteria_scores)
                                                        <div style="display: flex; flex-direction: column; gap: 30px; margin-bottom: 40px;">
                                                            @foreach ($submission->criteria_scores as $index => $cScore)
                                                                <div>
                                                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                                                        <div style="display: flex; align-items: center; gap: 12px;">
                                                                            <div style="width: 18px; height: 18px; background: {{ ['#0ea5e9', '#6366f1', '#8b5cf6', '#ec4899', '#f43f5e', '#f59e0b'][$index % 6] }}; border-radius: 50%; border: 1px solid #000;"></div>
                                                                            <span style="font-weight: 800; font-size: 16px; color: var(--text-prim);">{{ $cScore['name'] }}</span>
                                                                        </div>
                                                                        <span style="font-weight: 900; font-size: 18px; color: var(--text-prim);">{{ number_format($cScore['score'], 2) }}</span>
                                                                    </div>
                                                                    <div style="font-size: 14px; line-height: 1.6; color: var(--text-sec); padding-left: 30px;">
                                                                        <strong style="color: #64748b;">Mentor Review:</strong> {{ $cScore['review'] ?: 'Tidak ada ulasan spesifik.' }}
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <!-- Mentor Reviews Box -->
                                                    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 30px; margin-top: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                                                        <h6 style="font-size: 15px; font-weight: 800; color: var(--text-prim); margin-bottom: 15px;">Mentor Reviews</h6>
                                                        <div style="font-size: 14px; color: #475569; line-height: 1.7;">
                                                            {{ $submission->feedback ?: 'Kerja bagus! Tingkatkan kemampuanmu untuk menjadi yang terbaik.' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <!-- Submission Form / Deadline Check -->
                                        <div
                                            style="border: 2px dashed var(--border-color); background: var(--bg-sec); padding: 30px;">
                                            @if ($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date)->isPast())
                                                <div style="text-align: center; padding: 15px;">
                                                    <i class="fa-solid fa-clock text-danger"
                                                        style="font-size: 32px; margin-bottom: 15px;"></i>
                                                    <h6
                                                        style="font-size: 15px; color: var(--text-prim); font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                                                        Deadline Passed</h6>
                                                    <p
                                                        style="font-size: 13px; color: var(--text-sec); margin: 0; font-weight: 500;">
                                                        This assignment is no longer accepting submissions.</p>
                                                </div>
                                            @else
                                                <form
                                                    action="{{ route('assignment.submit', [$lesson->id, $assignment->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div style="margin-bottom: 20px;">
                                                        <label
                                                            style="display:block; font-weight:800; font-size: 12px; color: var(--text-prim); margin-bottom:10px; text-transform: uppercase; letter-spacing: 0.5px;">Write
                                                            your response here (Optional)</label>
                                                        <textarea name="text_content" rows="4" class="form-control-sq"
                                                            placeholder="Type your answer, thoughts, or link to your work here..."></textarea>
                                                    </div>
                                                    <div style="margin-bottom: 25px;">
                                                        <label
                                                            style="display:block; font-weight:800; font-size: 12px; color: var(--text-prim); margin-bottom:10px; text-transform: uppercase; letter-spacing: 0.5px;">Attach
                                                            a File (Optional, Max 10MB)</label>
                                                        <input type="file" name="file" class="form-control-sq"
                                                            style="background: #fff; cursor: pointer;">
                                                    </div>
                                                    <div style="text-align: right;">
                                                        <button type="submit" class="btn-sq-primary">
                                                            <i class="fa-solid fa-paper-plane"></i> Submit Assignment
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Toggle Script -->
    <script>
        function toggleAssignments(type, event) {
            if (event) event.preventDefault();
            const types = ['active', 'submitted', 'overdue'];

            types.forEach(t => {
                // Update display
                const groupEl = document.getElementById('group-' + t);
                if (groupEl) {
                    groupEl.style.display = t === type ? 'block' : 'none';
                }

                // Update button styles
                const btnEl = document.getElementById('toggle-' + t);
                if (btnEl) {
                    if (t === type) {
                        btnEl.className = 'btn-sq-primary';
                        // Reset inline overrides for the active button
                        btnEl.style.color = '';
                        btnEl.style.borderColor = '';
                    } else {
                        btnEl.className = 'btn-sq-outline';
                        // Restore gray styles specifically for the overdue button when inactive
                        if (t === 'overdue') {
                            btnEl.style.color = 'var(--text-sec)';
                            btnEl.style.borderColor = 'var(--border-color)';
                        } else {
                            btnEl.style.color = '';
                            btnEl.style.borderColor = '';
                        }
                    }
                }
            });
        }
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endif
