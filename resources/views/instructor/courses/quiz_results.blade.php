@extends('layouts.app')

@section('content')
    <style>
        .quiz-results-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #000;
        }

        .table-container {
            border: 2px solid #000;
            border-radius: 0;
            overflow-x: auto;
            margin-bottom: 30px;
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
            background: #fff;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            min-width: 700px;
        }

        .results-table th {
            padding: 15px 20px;
            font-size: 13px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #000;
            background: #f8fafc;
            border-right: 2px solid #000;
        }

        .results-table th:last-child {
            border-right: none;
        }

        .results-table td {
            padding: 15px 20px;
            border-bottom: 2px solid #000;
            border-right: 2px solid #000;
            background: #fff;
            transition: all 0.2s ease;
        }

        .results-table td:last-child {
            border-right: none;
        }

        .results-table tr:last-child td {
            border-bottom: none;
        }

        .results-table tr:hover td {
            background: #f8fafc;
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
            box-shadow: 3px 3px 0px 0px #000;
        }

        .btn-sq-sm:hover {
            box-shadow: 5px 5px 0px 0px #000;
        }

        .btn-sq-danger.btn-sq-sm {
            box-shadow: 3px 3px 0px 0px #e11d48;
        }

        .btn-sq-danger.btn-sq-sm:hover {
            box-shadow: 5px 5px 0px 0px #e11d48;
        }

        .status-badge {
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            border: 2px solid #000;
            display: inline-block;
            box-shadow: 3px 3px 0px 0px #000;
            letter-spacing: 0.5px;
        }

        .status-badge-passed {
            background: #10b981;
            color: #fff;
        }

        .status-badge-failed {
            background: #fef08a;
            color: #000;
        }

        .modal-body-sq {
            background: #fff;
            width: 750px;
            max-width: 95%;
            height: 90vh;
            border-radius: 0;
            overflow: hidden;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
            display: flex;
            flex-direction: column;
        }

        .modal-header-sq {
            padding: 15px 25px;
            border-bottom: 3px solid #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
        }

        @media (max-width: 768px) {
            .quiz-results-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .quiz-results-header .btn-sq-outline {
                width: 100%;
                justify-content: center;
                display: flex;
            }

            .table-container {
                border: none;
                background: transparent;
                overflow: visible;
                box-shadow: none;
            }

            .results-table,
            .results-table tbody,
            .results-table tr,
            .results-table td {
                display: block;
                width: 100%;
                min-width: 100%;
                box-sizing: border-box;
            }

            .results-table thead {
                display: none;
            }

            .results-table tr {
                background: #fff;
                margin-bottom: 25px;
                border: 2px solid #000;
                box-shadow: 4px 4px 0px 0px var(--accent-primary);
            }

            .results-table td {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                padding: 15px 20px !important;
                border-bottom: 2px solid #000 !important;
                border-right: none !important;
                text-align: left !important;
                gap: 8px;
            }

            .results-table td:last-child {
                border-bottom: none !important;
                background: #f8fafc;
            }

            .results-table td:last-child>button {
                width: 100%;
                justify-content: center;
            }

            .results-table td:nth-child(2)::before {
                content: "Score:";
                font-size: 11px;
                font-weight: 900;
                color: #000;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .results-table td:nth-child(3)::before {
                content: "Status:";
                font-size: 11px;
                font-weight: 900;
                color: #000;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .results-table td:nth-child(4)::before {
                content: "Date Submitted:";
                font-size: 11px;
                font-weight: 900;
                color: #000;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .results-table td:first-child {
                background: #f8fafc;
            }
        }
    </style>
    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 900px; margin: 0 auto; padding: 40px 5%;">

            <div class="quiz-results-header">
                <div>
                    <h2
                        style="font-size: 28px; font-weight: 900; color: var(--text-primary); text-transform: uppercase; letter-spacing: -0.5px; margin: 0; margin-bottom: 4px;">
                        Student Quiz Results</h2>
                    <p style="color: var(--text-secondary); font-size: 14px; font-weight: 500; margin: 0;">Performance logs
                        for unit:
                        <strong style="color: #000;">{{ $lesson->title }}</strong>
                    </p>
                </div>

                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('instructor.quiz.index', [$course->id, $lesson->id]) }}" class="btn-sq-outline">
                        <i class="fa-solid fa-arrow-left" style="margin-right: 6px;"></i> Back to Quiz
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 12px 15px; margin-bottom: 25px; font-weight: 800; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 8px; box-shadow: 4px 4px 0px 0px #10b981;">
                    <i class="fa-solid fa-circle-check" style="font-size: 16px;"></i> {{ session('success') }}
                </div>
            @endif

            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <span
                    style="font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="fa-solid fa-chart-simple" style="margin-right: 6px; color: var(--accent-primary);"></i>
                    Assessment Log Viewer
                </span>
                <span
                    style="font-size: 11px; font-weight: 900; color: #000; background: #fef08a; padding: 6px 12px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #ca8a04;">
                    {{ $results->total() }} RECORDS LISTED
                </span>
            </div>

            <div>
                @if ($results->count() > 0)
                    <div class="table-container">
                        <table class="results-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Score</th>
                                    <th>Status</th>
                                    <th>Date Submitted</th>
                                    <th style="text-align: right;">Audit Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 15px;">
                                                <div
                                                    style="width: 40px; height: 40px; background: #fff; border: 2px solid #000; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 900; color: #000; text-transform: uppercase;">
                                                    {{ substr($result->user->name, 0, 2) }}
                                                </div>
                                                <div>
                                                    <div
                                                        style="font-size: 15px; font-weight: 900; color: #000; text-transform: uppercase;">
                                                        {{ $result->user->name }}</div>
                                                    <div style="font-size: 11px; color: #475569; font-weight: 700;">
                                                        {{ $result->user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="font-size: 16px; font-weight: 900; color: #000;">
                                            {{ $result->score }} <span
                                                style="font-weight: 700; color: #475569; font-size: 12px;">/
                                                {{ $result->total_questions }}</span>
                                            <div
                                                style="font-size: 12px; color: {{ $result->score >= ($lesson->quiz_passing_score ?? 0) ? '#059669' : '#e11d48' }}; margin-top: 4px; font-weight: 800;">
                                                {{ number_format($result->percentage, 0) }}% Accuracy
                                            </div>
                                        </td>
                                        <td>
                                            @if ($result->score >= ($lesson->quiz_passing_score ?? 0))
                                                <span class="status-badge status-badge-passed"><i class="fa-solid fa-check"
                                                        style="margin-right: 4px;"></i> Passed</span>
                                            @else
                                                <span class="status-badge status-badge-failed"><i class="fa-solid fa-xmark"
                                                        style="margin-right: 4px;"></i> Failed</span>
                                            @endif
                                        </td>
                                        <td style="font-size: 13px; color: #000; font-weight: 800;">
                                            {{ $result->created_at->format('M d, Y') }}<br>
                                            <span
                                                style="font-size: 11px; color: #475569;">{{ $result->created_at->format('H:i A') }}</span>
                                        </td>
                                        <td style="text-align: right;">
                                            <button
                                                onclick="document.getElementById('details-modal-{{ $result->id }}').style.display='flex'"
                                                class="btn-sq-outline btn-sq-sm">
                                                <i class="fa-solid fa-file-invoice" style="margin-right: 6px;"></i>
                                                Expand Log
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Render Modals Output per row -->
                    @foreach ($results as $result)
                        <!-- Log Details Modal -->
                        <div id="details-modal-{{ $result->id }}"
                            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 1200; align-items: center; justify-content: center;">
                            <div class="modal-body-sq">
                                <div class="modal-header-sq">
                                    <h3
                                        style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin: 0; color: #000;">
                                        Detailed Assessment Record: <span
                                            style="color: var(--accent-primary);">{{ $result->user->name }}</span>
                                    </h3>
                                    <div style="display: flex; gap: 15px; align-items: center;">
                                        <form id="reset-form-{{ $result->id }}"
                                            action="{{ route('instructor.quiz.reset', [$course->id, $lesson->id, $result->id]) }}"
                                            method="POST" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-sq-danger btn-sq-sm"
                                                onclick="triggerReset('reset-form-{{ $result->id }}', '{{ addslashes($result->user->name) }}')">
                                                <i class="fa-solid fa-rotate-left" style="margin-right: 6px;"></i> Reset
                                                Assessment
                                            </button>
                                        </form>
                                        <button
                                            onclick="document.getElementById('details-modal-{{ $result->id }}').style.display='none'"
                                            style="background: none; border: none; font-size: 24px; color: #000; cursor: pointer; font-weight: 900;">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                                <div style="padding: 30px; overflow-y: auto; flex: 1;">
                                    @if ($result->is_force_submitted)
                                        <div
                                            style="background: #fff1f2; border: 2px solid #000; color: #e11d48; padding: 15px; margin-bottom: 25px; font-size: 12px; font-weight: 900; display: flex; align-items: center; gap: 10px; box-shadow: 4px 4px 0px 0px #e11d48; text-transform: uppercase;">
                                            <i class="fa-solid fa-shield-halved" style="font-size: 18px;"></i>
                                            SECURITY TRIGGER: This assessment was forcefully submitted due to critical
                                            tab-switching violations.
                                        </div>
                                    @endif

                                    <div
                                        style="display: flex; gap: 30px; margin-bottom: 30px; border-bottom: 3px solid #000; padding-bottom: 25px; flex-wrap: wrap;">
                                        <div>
                                            <span
                                                style="display: block; font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Final
                                                Score</span>
                                            <span
                                                style="font-size: 24px; font-weight: 900; color: #000; line-height: 1;">{{ $result->score }}
                                                <span style="font-size: 16px; color: #475569;">/
                                                    {{ $result->total_questions }}</span></span>
                                        </div>
                                        <div>
                                            <span
                                                style="display: block; font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Accuracy</span>
                                            <span
                                                style="font-size: 24px; font-weight: 900; line-height: 1; color: {{ $result->score >= ($lesson->quiz_passing_score ?? 0) ? '#059669' : '#e11d48' }};">{{ number_format($result->percentage, 0) }}%</span>
                                        </div>
                                        <div>
                                            <span
                                                style="display: block; font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Status</span>
                                            @if ($result->score >= ($lesson->quiz_passing_score ?? 0))
                                                <span
                                                    style="font-size: 20px; font-weight: 900; color: #10b981; text-transform: uppercase; line-height: 1.2;">Passed</span>
                                            @else
                                                <span
                                                    style="font-size: 20px; font-weight: 900; color: #e11d48; text-transform: uppercase; line-height: 1.2;">Failed</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        @foreach ($quizQuestions as $index => $q)
                                            @php
                                                $userAnswer = isset($result->answers_data[$q->id])
                                                    ? $result->answers_data[$q->id]
                                                    : null;
                                                $isCorrect = $userAnswer === $q->correct_option;
                                            @endphp
                                            <div
                                                style="margin-bottom: 30px; border: 2px solid #000; padding: 20px; background: #fff; box-shadow: 4px 4px 0px 0px {{ $isCorrect ? '#10b981' : '#e11d48' }};">
                                                <div
                                                    style="font-size: 11px; font-weight: 900; color: #000; margin-bottom: 10px; background: #f8fafc; display: inline-block; padding: 4px 8px; border: 2px solid #000; text-transform: uppercase;">
                                                    Question {{ $index + 1 }}</div>
                                                <div
                                                    style="font-size: 15px; font-weight: 800; color: #000; margin-bottom: 15px;">
                                                    {{ $q->question }}</div>

                                                <div style="display: grid; grid-template-columns: 1fr; gap: 10px;">
                                                    @foreach (['A', 'B', 'C', 'D'] as $opt)
                                                        @php
                                                            $optField = 'option_' . strtolower($opt);
                                                        @endphp
                                                        @if ($q->$optField)
                                                            <div
                                                                style="padding: 10px 15px; font-size: 13px; font-weight: 700; display: flex; align-items: center; justify-content: space-between; border: 2px solid #000;
                                                                @if ($q->correct_option === $opt) background: #ecfdf5; color: #000; font-weight: 900;
                                                                @elseif($userAnswer === $opt && !$isCorrect)
                                                                    background: #fff1f2; color: #000; font-weight: 800;
                                                                @else
                                                                    background: #f8fafc; color: #475569; @endif
                                                            ">
                                                                <span><strong
                                                                        style="color: #000; margin-right: 6px;">{{ $opt }}.</strong>
                                                                    {{ $q->$optField }}</span>
                                                                @if ($q->correct_option === $opt)
                                                                    <i class="fa-solid fa-check"
                                                                        style="color: #10b981; font-size: 16px;"></i>
                                                                @elseif($userAnswer === $opt && !$isCorrect)
                                                                    <i class="fa-solid fa-xmark"
                                                                        style="color: #e11d48; font-size: 16px;"></i>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                @if (!$userAnswer)
                                                    <div
                                                        style="margin-top: 15px; font-size: 12px; font-weight: 900; color: #e11d48; background: #fff1f2; padding: 8px 12px; border: 2px solid #e11d48; display: inline-block; text-transform: uppercase;">
                                                        <i class="fa-solid fa-circle-exclamation"
                                                            style="margin-right: 6px;"></i> Unanswered
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination (Matching square design) -->
                    <div style="display: flex; justify-content: center; margin-top: 35px;">
                        <style>
                            .pagination {
                                display: flex;
                                list-style: none;
                                gap: 8px;
                                padding: 0;
                                margin: 0;
                            }

                            .pagination li.active span,
                            .pagination li.active a {
                                background: var(--accent-primary);
                                color: #fff;
                                border: 2px solid #000;
                                font-weight: 900;
                                box-shadow: 3px 3px 0px 0px #000;
                            }

                            .pagination li span,
                            .pagination li a {
                                padding: 8px 14px;
                                background: #fff;
                                border: 2px solid #000;
                                color: #000;
                                font-size: 13px;
                                font-weight: 800;
                                text-decoration: none;
                                border-radius: 0;
                                display: block;
                                transition: 0.2s;
                                box-shadow: 3px 3px 0px 0px #000;
                            }

                            .pagination li a:hover {
                                background: #f8fafc;
                                transform: translate(-2px, -2px);
                                box-shadow: 5px 5px 0px 0px #000;
                            }

                            .pagination li.disabled span {
                                color: #94a3b8;
                                background: #f1f5f9;
                                box-shadow: 2px 2px 0px 0px #cbd5e1;
                                border-color: #cbd5e1;
                            }
                        </style>
                        {{ $results->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div
                        style="text-align: center; padding: 60px 40px; border: 2px dashed #000; border-radius: 0; background: #fff; box-shadow: 4px 4px 0px 0px #000;">
                        <div
                            style="width: 72px; height: 72px; background: #f8fafc; border: 3px solid #000; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 4px 4px 0px 0px #000;">
                            <i class="fa-solid fa-users-slash" style="font-size: 32px; color: #000;"></i>
                        </div>
                        <h4
                            style="font-size: 18px; font-weight: 900; color: #000; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">
                            No Data Logs Yet</h4>
                        <p style="font-size: 14px; color: #475569; font-weight: 700; margin-bottom: 0;">Wait for students to
                            complete this objective assessment to view their scores here.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Custom Confirmation Modal (Reset Assessment) -->
    <div id="confirm-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 1300; justify-content: center; align-items: flex-start; padding-top: 50px;">
        <div id="confirm-card"
            style="background: #fff; width: 450px; max-width: 90%; border: 3px solid #000; box-shadow: 12px 12px 0px 0px #e11d48; transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 30px; text-align: center;">
                <div
                    style="width: 70px; height: 70px; background: #fff1f2; color: #e11d48; border-radius: 0; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px; border: 3px solid #000; box-shadow: 4px 4px 0px 0px #e11d48;">
                    <i class="fa-solid fa-rotate-left"></i>
                </div>
                <h3
                    style="font-size: 18px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: #000; margin-bottom: 12px;">
                    Assessment Reset Request
                </h3>
                <p
                    style="font-size: 12px; color: #475569; font-weight: 700; line-height: 1.6; margin-bottom: 30px; text-transform: uppercase;">
                    Are you sure you want to completely RESET the assessment record for <br><span id="student-name-display"
                        style="color:#e11d48; font-weight: 900; font-size: 16px; margin: 8px 0; display: inline-block; background: #fff1f2; padding: 4px 8px; border: 2px solid #e11d48;">[STUDENT]</span>?
                    <br><br>
                    <strong>THIS ACTION CANNOT BE UNDONE AND THEY WILL HAVE TO RETAKE THE QUIZ.</strong>
                </p>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <button id="confirm-yes"
                        style="padding: 12px 25px; font-size: 12px; font-weight: 900; background: #e11d48; color: #fff; border: 2px solid #000; box-shadow: 4px 4px 0px 0px #000; cursor: pointer; text-transform: uppercase;">
                        CONFIRM RESET
                    </button>
                    <button onclick="closeConfirmModal()"
                        style="padding: 12px 25px; font-size: 12px; font-weight: 900; background: #fff; color: #000; border: 2px solid #000; box-shadow: 4px 4px 0px 0px #000; cursor: pointer; text-transform: uppercase;">
                        CANCEL OPS
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentResetForm = null;

        function triggerReset(formId, studentName) {
            currentResetForm = document.getElementById(formId);
            document.getElementById('student-name-display').innerText = studentName;

            // hide details modal first just in case
            const allDetailsModals = document.querySelectorAll('[id^="details-modal-"]');
            allDetailsModals.forEach(mod => mod.style.display = 'none');

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
            if (currentResetForm) {
                currentResetForm.submit();
            }
        });
    </script>
@endsection
