@extends('layouts.app')

@section('content')
    <style>
        .analysis-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #000;
        }

        .pipeline-badges {
            display: flex;
            gap: 10px;
        }

        .student-info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .grading-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .criteria-grading-row {
            display: grid;
            grid-template-columns: 200px 1fr 120px;
            gap: 20px;
            align-items: flex-start;
            padding-bottom: 20px;
            border-bottom: 1px dashed #cbd5e1;
        }

        .btn-sq-primary {
            background: var(--accent-primary);
            color: #fff;
            border: 2px solid #000;
            padding: 10px 16px;
            border-radius: 0;
            font-size: 13px;
            font-weight: 800;
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

        .btn-sq-outline {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            padding: 10px 16px;
            border-radius: 0;
            font-size: 13px;
            font-weight: 800;
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

        .btn-sq-outline:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #000;
            color: #000;
            background: #f8fafc;
        }

        .btn-sq-outline:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        .input-sq {
            width: 100%;
            padding: 12px;
            font-size: 13px;
            font-weight: 700;
            border: 2px solid #000;
            border-radius: 0;
            font-family: 'Poppins', sans-serif;
            background: #fff;
            outline: none;
            transition: all 0.2s ease;
            box-shadow: 2px 2px 0px 0px #000;
        }

        .input-sq:focus {
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            border-color: #000;
        }

        label.sq-label {
            display: block;
            font-size: 12px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .submission-card {
            border: 2px solid #000;
            border-radius: 0;
            padding: 25px;
            margin-bottom: 30px;
            background: #fff;
            transition: 0.2s;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
        }

        .submission-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        @media (max-width: 768px) {
            .analysis-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .analysis-header>a {
                width: 100%;
                justify-content: center;
                display: flex;
            }

            .pipeline-badges {
                flex-wrap: wrap;
                width: 100%;
            }

            .pipeline-badges span,
            .pipeline-badges a {
                flex: 1;
                text-align: center;
                justify-content: center;
                display: flex;
                align-items: center;
            }

            .student-info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .student-info-row>div:last-child {
                align-self: flex-start;
            }

            .grading-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 900px; margin: 0 auto; padding: 40px 5%;">

            <div class="analysis-header">
                <div>
                    <h2
                        style="font-size: 28px; font-weight: 900; color: var(--text-primary); text-transform: uppercase; letter-spacing: -0.5px; margin: 0; margin-bottom: 4px;">
                        Submission Analysis</h2>
                    <p style="color: var(--text-secondary); font-size: 14px; margin: 0; font-weight: 500;">Evaluating task:
                        <strong style="color: #000; text-transform: uppercase;">{{ $assignment->title }}</strong>
                        <span
                            style="margin-left: 10px; color: #000; font-weight: 900; background: #fef08a; padding: 2px 6px; border: 2px solid #000;">[
                            MAX THRESHOLD:
                            {{ $assignment->max_score }} ]</span>
                    </p>
                </div>
                <a href="{{ route('instructor.assignments.index', [$course->id, $lesson->id]) }}" class="btn-sq-outline">
                    <i class="fa-solid fa-arrow-left" style="margin-right: 6px;"></i> Exit Analysis
                </a>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 12px 15px; margin-bottom: 25px; font-weight: 800; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 8px; box-shadow: 4px 4px 0px 0px #10b981;">
                    <i class="fa-solid fa-circle-check" style="font-size: 16px;"></i> {{ session('success') }}
                </div>
            @endif

            <div
                style="background: #ffffff; border: 2px solid #000; border-radius: 0; box-shadow: 6px 6px 0px 0px var(--accent-primary); overflow: hidden; margin-bottom: 40px;">
                <div
                    style="background: #f8fafc; padding: 15px 20px; border-bottom: 2px solid #000; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                    <span
                        style="font-size: 13px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px;">
                        <i class="fa-solid fa-list-check" style="margin-right: 6px; color: var(--accent-primary);"></i>
                        Student Output Pipeline
                    </span>

                    <div class="pipeline-badges">
                        <span
                            style="font-size: 11px; font-weight: 900; color: #000; background: #ecfdf5; padding: 6px 12px; border: 2px solid #000; text-transform: uppercase; box-shadow: 2px 2px 0px 0px #10b981;">
                            <i class="fa-solid fa-inbox" style="color: #059669; margin-right: 4px;"></i>
                            {{ $submissions->count() }} Captured
                        </span>
                        <a href="#missing-students"
                            style="font-size: 11px; font-weight: 900; color: #000; background: #fff1f2; padding: 6px 12px; border: 2px solid #000; text-transform: uppercase; text-decoration: none; box-shadow: 2px 2px 0px 0px #e11d48;">
                            <i class="fa-solid fa-user-clock" style="color: #e11d48; margin-right: 4px;"></i>
                            {{ $missingStudents->count() }} Outstanding
                        </a>
                    </div>
                </div>

                <div style="padding: 25px;">
                    @forelse($submissions as $submission)
                        <div class="submission-card">

                            <div class="student-info-row">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div
                                        style="width: 48px; height: 48px; background: #000; color: white; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 900; border-radius: 0; border: 2px solid #000; box-shadow: 3px 3px 0px 0px var(--accent-primary);">
                                        {{ strtoupper(substr($submission->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div
                                            style="font-weight: 900; color: #000; font-size: 18px; text-transform: uppercase; letter-spacing: -0.3px;">
                                            {{ $submission->user->name }}</div>
                                        <div
                                            style="color: #475569; font-size: 11px; font-weight: 800; text-transform: uppercase; margin-top: 2px;">
                                            INDEXED: <span
                                                style="color: #000;">{{ $submission->created_at->format('M d, Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @if ($submission->status === 'graded')
                                        <span
                                            style="background: #10b981; color: #fff; border: 2px solid #000; padding: 6px 12px; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; box-shadow: 3px 3px 0px 0px #000;">
                                            <i class="fa-solid fa-square-check" style="margin-right: 4px;"></i> RATIFIED:
                                            {{ $submission->score }}/{{ $assignment->max_score }}
                                        </span>
                                    @else
                                        <span
                                            style="background: #f59e0b; color: #000; border: 2px solid #000; padding: 6px 12px; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; box-shadow: 3px 3px 0px 0px #000;">
                                            <i class="fa-solid fa-user-pen" style="margin-right: 4px;"></i> PENDING
                                            RATIFICATION
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div style="margin-bottom: 30px;">
                                <div
                                    style="font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fa-solid fa-cube" style="color: var(--accent-primary);"></i> Submissions
                                    Assets
                                </div>

                                @if ($submission->text_content)
                                    <div
                                        style="background: #f8fafc; padding: 20px; border-radius: 0; border: 2px dashed #000; font-size: 14px; line-height: 1.7; color: #000; margin-bottom: 20px; font-family: 'Inter', sans-serif; font-weight: 500;">
                                        {!! nl2br(e(trim($submission->text_content))) !!}
                                    </div>
                                @endif

                                @if ($submission->file_path)
                                    <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
                                        class="btn-sq-outline">
                                        <i class="fa-solid fa-file-export" style="margin-right: 6px;"></i> EXPORT ATTACHMENT
                                    </a>
                                @endif
                            </div>

                            <div style="background: #f8fafc; padding: 25px; border-radius: 0; border: 2px solid #000;">
                                <form
                                    action="{{ route('instructor.assignments.grade', [$course->id, $lesson->id, $assignment->id, $submission->id]) }}"
                                    method="POST">
                                    @csrf @method('PUT')
                                    <div
                                        style="font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">
                                        <i class="fa-solid fa-check-double"
                                            style="margin-right: 6px; color: var(--accent-primary);"></i> Verification
                                        Interface
                                    </div>

                                    <div class="grading-grid">
                                        @php
                                            $existingCriteriaScores = $submission->criteria_scores ?? [];
                                            $criteriaMap = collect($existingCriteriaScores)->keyBy('name');
                                        @endphp

                                        @if ($assignment->grading_criteria && count($assignment->grading_criteria) > 0)
                                            @foreach ($assignment->grading_criteria as $criteria)
                                                <div class="criteria-grading-row">
                                                    <div>
                                                        <label class="sq-label" style="margin-bottom: 4px;">
                                                            {{ $criteria['name'] }}
                                                        </label>
                                                        <div style="font-size: 10px; font-weight: 800; color: #64748b; text-transform: uppercase;">
                                                            Max Weight: {{ $criteria['weight'] }}%
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <textarea name="criteria_review[{{ $criteria['name'] }}]" rows="2" placeholder="Review for {{ $criteria['name'] }}..." class="input-sq"
                                                            style="resize: vertical; font-size: 12px; padding: 8px;">{{ $criteriaMap->get($criteria['name'])['review'] ?? '' }}</textarea>
                                                    </div>
                                                    <div>
                                                        <input type="number" step="0.01" name="criteria_score[{{ $criteria['name'] }}]" 
                                                            value="{{ $criteriaMap->get($criteria['name'])['score'] ?? '' }}"
                                                            placeholder="Score"
                                                            oninput="calculateTotalScore(this.closest('form'))"
                                                            class="input-sq criteria-score-input" 
                                                            style="font-size: 14px; text-align: center;"
                                                            min="0" max="{{ $criteria['weight'] }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        <div style="display: grid; grid-template-columns: 1fr 150px; gap: 20px; margin-top: 10px; align-items: flex-end;">
                                            <div>
                                                <label class="sq-label" style="margin-bottom: 8px;">
                                                    Global Mentor Reviews
                                                </label>
                                                <textarea name="feedback" rows="2" placeholder="Overall constructive evaluation..." class="input-sq"
                                                    style="resize: vertical;">{{ $submission->feedback }}</textarea>
                                            </div>
                                            <div>
                                                <label class="sq-label" style="margin-bottom: 8px; color: var(--accent-primary);">
                                                    Total Grade
                                                </label>
                                                <input type="number" step="0.01" name="score" id="total-score-{{ $submission->id }}" value="{{ $submission->score }}" required
                                                    min="0" max="{{ $assignment->max_score }}" class="input-sq"
                                                    style="font-size: 18px; font-weight: 900; background: #fff;">
                                            </div>
                                        </div>

                                        <div style="margin-top: 25px;">
                                            <button type="submit" class="btn-sq-primary"
                                                style="width: 100%; justify-content: center; padding: 15px; font-size: 14px;">
                                                <i class="fa-solid fa-signature" style="margin-right: 8px;"></i> COMMIT EVALUATION & RATIFY
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div
                            style="text-align: center; padding: 60px 40px; border: 2px dashed #000; background: #fff; border-radius: 0; box-shadow: 4px 4px 0px 0px #000;">
                            <div
                                style="width: 72px; height: 72px; background: #f1f5f9; border: 3px solid #000; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 4px 4px 0px 0px #000;">
                                <i class="fa-solid fa-box-open" style="font-size: 32px; color: #000;"></i>
                            </div>
                            <h4
                                style="font-size: 18px; font-weight: 900; color: #000; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;">
                                Queue Clear</h4>
                            <p style="font-size: 14px; color: #475569; font-weight: 700;">No student output has been
                                ingested
                                for this task yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Missing Submissions Section -->
            @if ($missingStudents && $missingStudents->count() > 0)
                <div id="missing-students"
                    style="background: #fff; border-radius: 0; border: 2px solid #000; box-shadow: 6px 6px 0px 0px #e11d48; overflow: hidden; margin-top: 50px; margin-bottom: 40px;">
                    <div
                        style="background: #fff1f2; padding: 15px 20px; border-bottom: 2px solid #000; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                        <h3
                            style="font-size: 14px; font-weight: 900; color: #e11d48; margin: 0; text-transform: uppercase; letter-spacing: 1px;">
                            <i class="fa-solid fa-triangle-exclamation" style="margin-right: 8px;"></i> Non-Compliant
                            Registry
                        </h3>
                        <span
                            style="font-size: 11px; font-weight: 900; color: #e11d48; background: #fff; border: 2px solid #e11d48; padding: 4px 12px; box-shadow: 2px 2px 0px 0px #e11d48;">
                            {{ $missingStudents->count() }}
                            OUTSTANDING</span>
                    </div>

                    <div style="padding: 25px;">
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                            @foreach ($missingStudents as $student)
                                <div style="display: flex; align-items: center; gap: 15px; padding: 15px; border: 2px solid #000; border-radius: 0; background: #fff; box-shadow: 3px 3px 0px 0px transparent; transition: 0.2s;"
                                    onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='4px 4px 0px 0px #e11d48';"
                                    onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='3px 3px 0px 0px transparent';">
                                    <div
                                        style="width: 40px; height: 40px; background: #f8fafc; color: #000; border: 2px solid #000; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 900; border-radius: 0;">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div
                                            style="font-weight: 900; color: #000; font-size: 15px; text-transform: uppercase;">
                                            {{ $student->name }}</div>
                                        <div style="font-size: 11px; font-weight: 800; margin-top: 4px;">
                                            @if ($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date)->isPast())
                                                <span style="color: #e11d48;"><i class="fa-solid fa-circle-exclamation"
                                                        style="margin-right: 4px;"></i>
                                                    CRITICAL: OVERDUE</span>
                                            @else
                                                <span style="color: #475569;"><i class="fa-solid fa-clock"
                                                        style="margin-right: 4px;"></i> PENDING
                                                    INGESTION</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function calculateTotalScore(form) {
            const scoreInputs = form.querySelectorAll('.criteria-score-input');
            let total = 0;
            scoreInputs.forEach(input => {
                if (input.value) {
                    total += parseFloat(input.value);
                }
            });
            const totalInput = form.querySelector('input[name="score"]');
            totalInput.value = total.toFixed(2);
        }
    </script>
@endsection
