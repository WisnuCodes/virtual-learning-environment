@extends('layouts.app')

@section('content')
    <style>
        .quiz-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #000;
        }

        .quiz-actions {
            display: flex;
            gap: 10px;
        }

        .quiz-options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .modal-options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .quiz-question-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
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

        .btn-sq-danger {
            background: #fff;
            color: #e11d48;
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
            box-shadow: 4px 4px 0px 0px #e11d48;
            text-decoration: none;
        }

        .btn-sq-danger:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #e11d48;
            color: #e11d48;
            background: #fff1f2;
        }

        .btn-sq-danger:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #e11d48;
        }

        .btn-sq-sm {
            padding: 8px 14px;
            font-size: 11px;
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

        .input-setting {
            border: 2px solid #000 !important;
            background: #fff !important;
            height: 48px !important;
            padding: 0 12px !important;
            font-size: 16px !important;
            transition: all 0.2s ease;
            box-shadow: 3px 3px 0px 0px #000;
        }

        .input-setting:focus-within {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0px 0px var(--accent-primary);
            border-color: #000;
        }

        .input-setting input {
            font-family: 'Poppins', sans-serif;
            background: transparent;
            border: none;
            outline: none;
            color: #000;
            font-weight: 900 !important;
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

        .modal-body-sq {
            background: #fff;
            width: 650px;
            max-width: 95%;
            border-radius: 0;
            overflow: hidden;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
        }

        .modal-header-sq {
            padding: 15px 20px;
            border-bottom: 3px solid #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--accent-primary);
            color: #fff;
        }

        .question-card {
            border: 2px solid #000;
            border-radius: 0;
            padding: 25px;
            margin-bottom: 25px;
            background: #fff;
            transition: 0.2s;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
        }

        .question-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .option-item {
            padding: 12px 15px;
            border-radius: 0;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 2px solid #000;
            transition: 0.2s;
        }

        .option-item.correct {
            background: #ecfdf5;
            border-color: #000;
            color: #000;
            font-weight: 800;
            box-shadow: 3px 3px 0px 0px #10b981;
        }

        .option-item.normal {
            background: #fff;
            border-color: #000;
            color: #000;
            font-weight: 700;
            box-shadow: 3px 3px 0px 0px #e2e8f0;
        }

        .option-letter {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 900;
            border: 2px solid #000;
        }

        .option-item.correct .option-letter {
            background: #10b981;
            color: #000;
        }

        .option-item.normal .option-letter {
            background: #f8fafc;
            color: #000;
        }

        @media (max-width: 768px) {
            .quiz-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .quiz-actions {
                width: 100%;
                flex-direction: column;
            }

            .quiz-actions button,
            .quiz-actions a {
                width: 100%;
                justify-content: center;
                display: flex;
            }

            .quiz-options-grid {
                grid-template-columns: 1fr;
            }

            .modal-options-grid {
                grid-template-columns: 1fr;
            }

            .quiz-question-header {
                flex-direction: column;
                gap: 15px;
            }

            .quiz-question-header form {
                align-self: flex-start;
            }

            #add-question-modal .modal-body-sq {
                max-height: 90vh;
                overflow-y: auto;
            }
        }
    </style>
    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 900px; margin: 0 auto; padding: 40px 5%;">

            <div class="quiz-header">
                <div>
                    <h2
                        style="font-size: 28px; font-weight: 900; color: var(--text-primary); text-transform: uppercase; letter-spacing: -0.5px; margin: 0; margin-bottom: 4px;">
                        Knowledge Verification</h2>
                    <p style="color: var(--text-secondary); font-size: 14px; margin: 0; font-weight: 500;">Operational
                        control for unit:
                        <strong style="color: #000;">{{ $lesson->title }}</strong>
                    </p>
                </div>

                <div class="quiz-actions">
                    <button onclick="document.getElementById('add-question-modal').style.display='flex'"
                        class="btn-sq-primary">
                        <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> New Question
                    </button>
                    <a href="{{ route('instructor.quiz.results', [$course->id, $lesson->id]) }}" class="btn-sq-outline">
                        <i class="fa-solid fa-users-viewfinder" style="margin-right: 6px;"></i> Student Results
                    </a>
                    <a href="{{ route('instructor.curriculum.index', $course->id) }}" class="btn-sq-outline">
                        <i class="fa-solid fa-arrow-left" style="margin-right: 6px;"></i> Exit
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 12px 15px; margin-bottom: 25px; font-weight: 800; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 8px; box-shadow: 4px 4px 0px 0px #10b981;">
                    <i class="fa-solid fa-circle-check" style="font-size: 16px;"></i> {{ session('success') }}
                </div>
            @endif

            @php $totalQ = $quizQuestions->count(); @endphp
            <div
                style="background: #ffffff; border: 2px solid #000; box-shadow: 6px 6px 0px 0px var(--accent-primary); margin-bottom: 40px; border-radius: 0; overflow: hidden;">
                <!-- Header -->
                <div
                    style="padding: 15px 20px; border-bottom: 2px solid #000; background: #f8fafc; display: flex; align-items: center; gap: 12px;">
                    <div
                        style="width: 32px; height: 32px; background: var(--accent-primary); border: 2px solid #000; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-gear" style="color: #fff; font-size: 14px;"></i>
                    </div>
                    <div>
                        <div
                            style="font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 0.5px;">
                            Quiz Settings</div>
                        <div style="font-size: 12px; color: #475569; margin-top: 2px; font-weight: 500;">Configure duration,
                            warning thresholds, and passing criteria.</div>
                    </div>
                </div>
                <!-- Body -->
                <form action="{{ route('instructor.quiz.updateDuration', [$course->id, $lesson->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div style="padding: 25px; display: flex; gap: 25px; flex-wrap: wrap; align-items: flex-start;">

                        <!-- Time Limit -->
                        <div style="flex: 1; min-width: 130px;">
                            <div
                                style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">
                                <i class="fa-regular fa-clock" style="margin-right: 6px; color: var(--accent-primary);"></i>
                                Time Limit
                            </div>
                            <div class="input-setting" style="display: flex; align-items: center;">
                                <input type="number" name="quiz_duration" value="{{ $lesson->quiz_duration ?? 15 }}"
                                    min="1" required style="width: 50px; text-align: right;">
                                <span
                                    style="font-size: 12px; font-weight: 800; color: #475569; padding-left: 8px;">mins</span>
                            </div>
                        </div>

                        <!-- Max Warnings -->
                        <div style="flex: 1; min-width: 130px;">
                            <div
                                style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">
                                <i class="fa-solid fa-triangle-exclamation" style="margin-right: 6px; color: #eab308;"></i>
                                Max Warnings
                            </div>
                            <div class="input-setting" style="display: flex; align-items: center;">
                                <input type="number" name="quiz_max_warnings" value="{{ $lesson->quiz_max_warnings ?? 5 }}"
                                    min="1" max="10" required style="width: 40px; text-align: right;">
                                <span
                                    style="font-size: 12px; font-weight: 800; color: #475569; padding-left: 8px;">strikes</span>
                            </div>
                        </div>

                        <!-- Passing Score -->
                        <div style="flex: 2; min-width: 200px;">
                            <div
                                style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">
                                <i class="fa-solid fa-check-to-slot" style="margin-right: 6px; color: #10b981;"></i> Min.
                                Passing Score
                            </div>
                            <div class="input-setting" style="display: flex; align-items: center;">
                                <input type="number" name="quiz_passing_score"
                                    value="{{ $lesson->quiz_passing_score ?? 0 }}" min="0" max="{{ $totalQ }}"
                                    required style="width: 40px; text-align: right;">
                                <span style="font-size: 12px; font-weight: 800; color: #475569; padding-left: 8px;">
                                    of {{ $totalQ }} questions
                                </span>
                            </div>
                            @if ($totalQ > 0)
                                <div
                                    style="font-size: 11px; color: #475569; margin-top: 10px; font-weight: 700; background: #f8fafc; border: 2px solid #000; padding: 4px 8px; display: inline-block;">
                                    Active Threshold: <strong style="color: #000;">{{ $lesson->quiz_passing_score ?? 0 }}
                                        / {{ $totalQ }}</strong> correct
                                </div>
                            @else
                                <div
                                    style="font-size: 11px; color: #000; margin-top: 10px; font-weight: 800; background: #fef08a; border: 2px solid #000; padding: 4px 8px; display: inline-block; box-shadow: 2px 2px 0px 0px #ca8a04;">
                                    <i class="fa-solid fa-circle-info" style="margin-right: 4px;"></i> Add questions first
                                </div>
                            @endif
                        </div>

                    </div>
                    <!-- Footer -->
                    <div
                        style="padding: 15px 25px; border-top: 2px solid #000; background: #f8fafc; display: flex; justify-content: flex-end;">
                        <button type="submit" class="btn-sq-primary">
                            <i class="fa-solid fa-floppy-disk" style="margin-right: 6px;"></i> Save Configuration
                        </button>
                    </div>
                </form>
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <span
                    style="font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="fa-solid fa-clipboard-list" style="margin-right: 6px; color: var(--accent-primary);"></i>
                    Assessment Registry
                </span>
                <span
                    style="font-size: 11px; font-weight: 900; color: #000; background: #fef08a; padding: 6px 12px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #ca8a04;">
                    {{ $quizQuestions->count() }} ACTIVE ENTRIES
                </span>
            </div>

            <div>
                @forelse($quizQuestions as $index => $qq)
                    <div class="question-card">
                        <div class="quiz-question-header">
                            <div style="flex: 1; padding-right: 20px;">
                                <div
                                    style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; display: inline-block; background: #f1f5f9; border: 2px solid #000; padding: 4px 8px; box-shadow: 2px 2px 0px 0px #000;">
                                    Objective Item #{{ $index + 1 }}</div>
                                <h4 style="font-size: 16px; font-weight: 800; color: #000; margin: 0; line-height: 1.6;">
                                    {{ $qq->question }}
                                </h4>
                            </div>
                            <form action="{{ route('instructor.quiz.destroy', [$course->id, $lesson->id, $qq->id]) }}"
                                method="POST" id="delete-question-{{ $qq->id }}" style="margin: 0;">
                                @csrf @method('DELETE')
                                <button type="button" onclick="triggerDelete('delete-question-{{ $qq->id }}')"
                                    class="btn-sq-danger btn-sq-sm">
                                    <i class="fa-solid fa-trash-can" style="margin-right: 4px;"></i> Purge
                                </button>
                            </form>
                        </div>

                        <div class="quiz-options-grid">
                            <div class="option-item {{ $qq->correct_option == 'A' ? 'correct' : 'normal' }}">
                                <span class="option-letter">A</span>
                                <span style="flex: 1;">{{ $qq->option_a }}</span>
                                @if ($qq->correct_option == 'A')
                                    <i class="fa-solid fa-circle-check" style="font-size: 16px; color: #059669;"></i>
                                @endif
                            </div>
                            <div class="option-item {{ $qq->correct_option == 'B' ? 'correct' : 'normal' }}">
                                <span class="option-letter">B</span>
                                <span style="flex: 1;">{{ $qq->option_b }}</span>
                                @if ($qq->correct_option == 'B')
                                    <i class="fa-solid fa-circle-check" style="font-size: 16px; color: #059669;"></i>
                                @endif
                            </div>
                            @if ($qq->option_c)
                                <div class="option-item {{ $qq->correct_option == 'C' ? 'correct' : 'normal' }}">
                                    <span class="option-letter">C</span>
                                    <span style="flex: 1;">{{ $qq->option_c }}</span>
                                    @if ($qq->correct_option == 'C')
                                        <i class="fa-solid fa-circle-check" style="font-size: 16px; color: #059669;"></i>
                                    @endif
                                </div>
                            @endif
                            @if ($qq->option_d)
                                <div class="option-item {{ $qq->correct_option == 'D' ? 'correct' : 'normal' }}">
                                    <span class="option-letter">D</span>
                                    <span style="flex: 1;">{{ $qq->option_d }}</span>
                                    @if ($qq->correct_option == 'D')
                                        <i class="fa-solid fa-circle-check" style="font-size: 16px; color: #059669;"></i>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div
                        style="text-align: center; padding: 60px 40px; border: 2px dashed #000; border-radius: 0; background: #fff; box-shadow: 4px 4px 0px 0px #000;">
                        <div
                            style="width: 72px; height: 72px; background: #f8fafc; border: 3px solid #000; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                            <i class="fa-solid fa-clipboard-question" style="font-size: 32px; color: #000;"></i>
                        </div>
                        <h4
                            style="font-size: 18px; font-weight: 900; color: #000; margin-bottom: 12px; text-transform: uppercase;">
                            Zero Question Framework</h4>
                        <p style="font-size: 14px; color: #475569; font-weight: 700; margin-bottom: 30px;">Initialize
                            objective assessment items for this unit.</p>
                        <button onclick="document.getElementById('add-question-modal').style.display='flex'"
                            class="btn-sq-primary">
                            <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> INITIALIZE ITEM
                        </button>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- Add Question Modal -->
    <div id="add-question-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 1200; align-items: center; justify-content: center;">
        <div class="modal-body-sq">
            <div class="modal-header-sq">
                <h3 style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin: 0;">
                    Initialize Assessment Item</h3>
                <button onclick="document.getElementById('add-question-modal').style.display='none'"
                    style="background:none; border:none; font-size: 24px; color: #fff; cursor:pointer; font-weight: 900;">&times;</button>
            </div>

            <form action="{{ route('instructor.quiz.store', [$course->id, $lesson->id]) }}" method="POST"
                style="padding: 25px;">
                @csrf
                <div style="margin-bottom: 30px;">
                    <label class="sq-label">Item Description</label>
                    <textarea name="question" required rows="3" placeholder="Define the question parameters..." class="input-sq"
                        style="resize: vertical;"></textarea>
                </div>

                <div
                    style="background: #f8fafc; padding: 25px; border: 2px solid #000; margin-bottom: 30px; box-shadow: 4px 4px 0px 0px #cbd5e1;">
                    <div
                        style="font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">
                        <i class="fa-solid fa-list-ul" style="margin-right: 6px;"></i> Option Matrix
                    </div>
                    <div class="modal-options-grid">

                        <!-- Option A -->
                        <div>
                            <div style="display:flex; justify-content: space-between; margin-bottom: 10px;">
                                <label
                                    style="font-size: 11px; font-weight: 900; text-transform: uppercase; color: #000; background: #e2e8f0; border: 2px solid #000; padding: 2px 8px; box-shadow: 2px 2px 0px 0px #000;">Option
                                    A</label>
                                <label
                                    style="display: flex; align-items: center; gap: 6px; cursor: pointer; color: #000; font-size: 11px; font-weight: 900; text-transform: uppercase;">
                                    <input type="radio" name="correct_option" value="A" required
                                        style="width: 16px; height: 16px; accent-color: #10b981;"> Correct
                                </label>
                            </div>
                            <input type="text" name="option_a" required placeholder="Asset A" class="input-sq">
                        </div>

                        <!-- Option B -->
                        <div>
                            <div style="display:flex; justify-content: space-between; margin-bottom:10px;">
                                <label
                                    style="font-size: 11px; font-weight: 900; text-transform: uppercase; color: #000; background: #e2e8f0; border: 2px solid #000; padding: 2px 8px; box-shadow: 2px 2px 0px 0px #000;">Option
                                    B</label>
                                <label
                                    style="display: flex; align-items: center; gap: 6px; cursor: pointer; color: #000; font-size: 11px; font-weight: 900; text-transform: uppercase;">
                                    <input type="radio" name="correct_option" value="B"
                                        style="width: 16px; height: 16px; accent-color: #10b981;"> Correct
                                </label>
                            </div>
                            <input type="text" name="option_b" required placeholder="Asset B" class="input-sq">
                        </div>

                        <!-- Option C -->
                        <div>
                            <div style="display:flex; justify-content: space-between; margin-bottom:10px;">
                                <label
                                    style="font-size: 11px; font-weight: 900; text-transform: uppercase; color: #000; background: #e2e8f0; border: 2px solid #000; padding: 2px 8px; box-shadow: 2px 2px 0px 0px #000;">Option
                                    C</label>
                                <label
                                    style="display: flex; align-items: center; gap: 6px; cursor: pointer; color: #000; font-size: 11px; font-weight: 900; text-transform: uppercase;">
                                    <input type="radio" name="correct_option" value="C"
                                        style="width: 16px; height: 16px; accent-color: #10b981;"> Correct
                                </label>
                            </div>
                            <input type="text" name="option_c" placeholder="Asset C (Optional)" class="input-sq">
                        </div>

                        <!-- Option D -->
                        <div>
                            <div style="display:flex; justify-content: space-between; margin-bottom:10px;">
                                <label
                                    style="font-size: 11px; font-weight: 900; text-transform: uppercase; color: #000; background: #e2e8f0; border: 2px solid #000; padding: 2px 8px; box-shadow: 2px 2px 0px 0px #000;">Option
                                    D</label>
                                <label
                                    style="display: flex; align-items: center; gap: 6px; cursor: pointer; color: #000; font-size: 11px; font-weight: 900; text-transform: uppercase;">
                                    <input type="radio" name="correct_option" value="D"
                                        style="width: 16px; height: 16px; accent-color: #10b981;"> Correct
                                </label>
                            </div>
                            <input type="text" name="option_d" placeholder="Asset D (Optional)" class="input-sq">
                        </div>

                    </div>
                </div>

                <div style="display: flex; gap: 15px;">
                    <button type="submit" class="btn-sq-primary" style="flex: 1;">Commit Item</button>
                    <button type="button" onclick="document.getElementById('add-question-modal').style.display='none'"
                        class="btn-sq-outline">Abort</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Custom Confirmation Modal (Question Purge) -->
    <div id="confirm-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 1210; justify-content: center; align-items: flex-start; padding-top: 50px;">
        <div id="confirm-card"
            style="background: #fff; width: 450px; max-width: 90%; border: 3px solid #000; box-shadow: 12px 12px 0px 0px #e11d48; transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 30px; text-align: center;">
                <div
                    style="width: 70px; height: 70px; background: #fff1f2; color: #e11d48; border-radius: 0; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px; border: 3px solid #000; box-shadow: 4px 4px 0px 0px #e11d48;">
                    <i class="fa-solid fa-clipboard-question"></i>
                </div>
                <h3
                    style="font-size: 18px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: #000; margin-bottom: 12px;">
                    Assessment Item Purge
                </h3>
                <p
                    style="font-size: 12px; color: #475569; font-weight: 700; line-height: 1.6; margin-bottom: 30px; text-transform: uppercase;">
                    Purge this question permanently from the knowledge verification record? <br><br>
                    <strong>THIS ACTION CANNOT BE UNDONE.</strong>
                </p>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <button id="confirm-yes"
                        style="padding: 12px 25px; font-size: 12px; font-weight: 900; background: #e11d48; color: #fff; border: 2px solid #000; box-shadow: 4px 4px 0px 0px #000; cursor: pointer; text-transform: uppercase;">
                        CONFIRM PURGE
                    </button>
                    <button onclick="closeConfirmModal()"
                        style="padding: 12px 25px; font-size: 12px; font-weight: 900; background: #fff; color: #000; border: 2px solid #000; box-shadow: 4px 4px 0px 0px #000; cursor: pointer; text-transform: uppercase;">
                        ABORT OPS
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteForm = null;

        function triggerDelete(formId) {
            currentDeleteForm = document.getElementById(formId);
            const modal = document.getElementById('confirm-modal');
            const card = document.getElementById('confirm-card');

            modal.style.display = 'flex';
            setTimeout(() => {
                card.style.transform = 'translateY(0)';
                card.style.opacity = '1';
            }, 10);
        }

        function closeConfirmModal() {
            const card = document.getElementById('confirm-card');
            const modal = document.getElementById('confirm-modal');

            card.style.transform = 'translateY(-100px)';
            card.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 400);
        }

        document.getElementById('confirm-yes').addEventListener('click', function() {
            if (currentDeleteForm) {
                currentDeleteForm.submit();
            }
        });
    </script>
@endsection
