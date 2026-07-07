@extends('layouts.app')

@section('content')
    <style>
        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #000;
        }

        .task-actions {
            display: flex;
            gap: 10px;
        }

        .task-card-inner {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .task-stats {
            display: flex;
            gap: 15px;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .task-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-end;
            min-width: 180px;
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
            width: 550px;
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

        .assignment-card {
            border: 2px solid #000;
            border-radius: 0;
            padding: 20px;
            margin-bottom: 25px;
            background: #fff;
            transition: 0.2s;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
        }

        .assignment-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .empty-state {
            text-align: center;
            padding: 60px 40px;
            background: #fff;
            border: 2px dashed #000;
            border-radius: 0;
            box-shadow: 4px 4px 0px 0px #000;
        }

        @media (max-width: 768px) {
            .task-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .task-actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .task-actions button,
            .task-actions a {
                flex: 1;
                justify-content: center;
                min-width: 120px;
            }

            .task-card-inner {
                flex-direction: column;
                gap: 20px;
            }

            .task-card-inner>div:first-child {
                padding-right: 0 !important;
            }

            .task-buttons {
                width: 100%;
                flex-direction: row;
                align-items: center;
                flex-wrap: wrap;
            }

            .task-buttons>form,
            .task-buttons>a {
                flex: 1;
                min-width: 140px;
            }
        }
    </style>
    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 850px; margin: 0 auto; padding: 40px 5%;">

            <div class="task-header">
                <div>
                    <h2
                        style="font-size: 28px; font-weight: 900; color: var(--text-primary); text-transform: uppercase; letter-spacing: -0.5px; margin: 0; margin-bottom: 4px;">
                        Task Governance</h2>
                    <p style="color: var(--text-secondary); font-size: 14px; margin: 0; font-weight: 500;">Operational
                        control for unit:
                        <strong style="color: #000;">{{ $lesson->title }}</strong>
                    </p>
                </div>

                <div class="task-actions">
                    <button onclick="document.getElementById('add-assignment-modal').style.display='flex'"
                        class="btn-sq-primary">
                        <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> New Assignment
                    </button>
                    <a href="{{ route('instructor.curriculum.index', $course->id) }}" class="btn-sq-outline">
                        <i class="fa-solid fa-arrow-left" style="margin-right: 6px;"></i> Exit
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 12px 15px; margin-bottom: 25px; font-weight: 800; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 4px 4px 0px 0px #10b981; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-circle-check" style="font-size: 16px;"></i> {{ session('success') }}
                </div>
            @endif

            <div
                style="background: #ffffff; border: 2px solid #000; border-radius: 0; box-shadow: 6px 6px 0px 0px var(--accent-primary); overflow: hidden; margin-bottom: 30px;">
                <div
                    style="background: #f8fafc; padding: 15px 20px; border-bottom: 2px solid #000; display: flex; align-items: center; justify-content: space-between;">
                    <span
                        style="font-size: 13px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px;">
                        <i class="fa-solid fa-list-check" style="margin-right: 6px; color: var(--accent-primary);"></i>
                        Assignment Registry
                    </span>
                    <span
                        style="font-size: 10px; font-weight: 900; color: #000; background: #fef08a; padding: 4px 10px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #ca8a04;">
                        {{ $assignments->count() }} ACTIVE ENTRIES
                    </span>
                </div>

                <div style="padding: 25px;">
                    @forelse($assignments as $assignment)
                        <div class="assignment-card">
                            <div class="task-card-inner">
                                <div style="flex: 1; padding-right: 20px;">
                                    <h4
                                        style="font-size: 18px; font-weight: 900; color: #000; margin: 0 0 10px 0; text-transform: uppercase; letter-spacing: -0.2px;">
                                        {{ $assignment->title }}
                                    </h4>
                                    <p
                                        style="font-size: 14px; color: #475569; margin-bottom: 15px; line-height: 1.6; font-weight: 500;">
                                        {{ $assignment->description }}
                                    </p>

                                    <div class="task-stats">
                                        <span
                                            style="display: inline-flex; align-items: center; background: #fff; border: 2px solid #000; padding: 4px 8px; color: #000; box-shadow: 2px 2px 0px 0px #fbbf24;">
                                            <i class="fa-solid fa-star" style="color: #d97706; margin-right: 6px;"></i> MAX
                                            SCORE: {{ $assignment->max_score }}
                                        </span>
                                        <span
                                            style="display: inline-flex; align-items: center; background: #fff; border: 2px solid #000; padding: 4px 8px; color: #000; box-shadow: 2px 2px 0px 0px #10b981;">
                                            <i class="fa-solid fa-inbox" style="color: #059669; margin-right: 6px;"></i>
                                            {{ $assignment->submissions_count }} SUBMITTED
                                        </span>
                                        <span
                                            style="display: inline-flex; align-items: center; background: #fff; border: 2px solid #000; padding: 4px 8px; color: #000; box-shadow: 2px 2px 0px 0px #e11d48;">
                                            <i class="fa-solid fa-user-xmark"
                                                style="color: #e11d48; margin-right: 6px;"></i>
                                            {{ max(0, $totalEnrolled - $assignment->submissions_count) }} PENDING
                                        </span>
                                        @if ($assignment->due_date)
                                            <span
                                                style="display: inline-flex; align-items: center; background: #fff; border: 2px solid #000; padding: 4px 8px; color: #000; box-shadow: 2px 2px 0px 0px {{ \Carbon\Carbon::parse($assignment->due_date)->isPast() ? '#e11d48' : '#cbd5e1' }};">
                                                <i class="fa-solid fa-clock-rotate-left"
                                                    style="color: {{ \Carbon\Carbon::parse($assignment->due_date)->isPast() ? '#e11d48' : '#64748b' }}; margin-right: 6px;"></i>
                                                DUE:
                                                {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y H:i') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="task-buttons">
                                    <a href="{{ route('instructor.assignments.submissions', [$course->id, $lesson->id, $assignment->id]) }}"
                                        class="btn-sq-primary btn-sq-sm" style="width: 100%;">
                                        <i class="fa-solid fa-eye" style="margin-right: 6px;"></i> ANALYZE SUBMISSIONS
                                    </a>
                                    <button type="button"
                                        onclick='openEditModal({!! json_encode($assignment) !!})'
                                        class="btn-sq-outline btn-sq-sm" style="width: 100%;">
                                        <i class="fa-solid fa-pen-to-square" style="margin-right: 6px;"></i> EDIT GOVERNANCE
                                    </button>
                                    <form
                                        action="{{ route('instructor.assignments.destroy', [$course->id, $lesson->id, $assignment->id]) }}"
                                        method="POST" id="delete-assignment-{{ $assignment->id }}"
                                        style="width: 100%; margin: 0;">
                                        @csrf @method('DELETE')
                                        <button type="button"
                                            onclick="triggerDelete('delete-assignment-{{ $assignment->id }}', '{{ addslashes($assignment->title) }}')"
                                            class="btn-sq-danger btn-sq-sm" style="width: 100%;">
                                            <i class="fa-solid fa-trash-can" style="margin-right: 6px;"></i> PURGE ASSET
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div
                                style="width: 64px; height: 64px; background: var(--accent-primary); border: 3px solid #000; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 4px 4px 0px 0px #000;">
                                <i class="fa-solid fa-file-pen" style="font-size: 28px; color: #fff;"></i>
                            </div>
                            <h4
                                style="font-size: 18px; font-weight: 900; color: #000; margin-bottom: 12px; text-transform: uppercase;">
                                Zero Task Framework</h4>
                            <p style="font-size: 14px; color: #475569; font-weight: 700; margin-bottom: 25px;">Initialize a
                                student evaluation objective for this unit.</p>
                            <button onclick="document.getElementById('add-assignment-modal').style.display='flex'"
                                class="btn-sq-primary">
                                <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> INITIALIZE TASK
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Add Assignment Modal -->
    <div id="add-assignment-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 1200; align-items: center; justify-content: center;">
        <div class="modal-body-sq">
            <div class="modal-header-sq">
                <h3 style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin: 0;">
                    Initialize Evaluation Framework</h3>
                <button onclick="document.getElementById('add-assignment-modal').style.display='none'"
                    style="background:none; border:none; font-size: 24px; color: #fff; cursor:pointer; font-weight: 900;">&times;</button>
            </div>

            <form action="{{ route('instructor.assignments.store', [$course->id, $lesson->id]) }}" method="POST"
                enctype="multipart/form-data" style="padding: 25px;">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label class="sq-label">Governance Title</label>
                    <input type="text" name="title" required placeholder="E.G. TECHNICAL FEASIBILITY STUDY"
                        class="input-sq" style="text-transform: uppercase;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label class="sq-label">Strategic Instructions</label>
                    <textarea name="description" required rows="4"
                        placeholder="Define the core deliverables and grading criteria for this task..." class="input-sq"
                        style="resize: vertical;"></textarea>
                </div>

                <div style="margin-bottom: 20px;">
                    <label class="sq-label">Resource Attachment (Optional)</label>
                    <input type="file" name="attachment" class="input-sq" style="background: #fff; cursor: pointer; padding: 10px;">
                    <small style="font-size: 10px; color: #475569; font-weight: 700; text-transform: uppercase; margin-top: 5px; display: block;">
                        Accepted: PDF, DOCX, ZIP, Images (Max 10MB)
                    </small>
                </div>

                <div style="margin-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <label class="sq-label" style="margin-bottom: 0;">Grading Criteria (%)</label>
                        <button type="button" onclick="addCriteriaRow('add-criteria-container')" class="btn-sq-outline btn-sq-sm" style="padding: 4px 10px; font-size: 10px;">
                            <i class="fa-solid fa-plus"></i> Add
                        </button>
                    </div>
                    <div id="add-criteria-container" style="display: flex; flex-direction: column; gap: 10px;">
                        <div class="criteria-row" style="display: flex; gap: 10px;">
                            <input type="text" name="criteria_name[]" placeholder="Criteria Name (e.g. Accuracy)" class="input-sq" style="flex: 2;">
                            <input type="number" name="criteria_weight[]" placeholder="%" class="input-sq" style="flex: 1;" min="0" max="100">
                        </div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                    <div>
                        <label class="sq-label">Max Quality Score</label>
                        <input type="number" name="max_score" required min="1" value="100" class="input-sq">
                    </div>
                    <div>
                        <label class="sq-label">Deadline (Optional)</label>
                        <input type="datetime-local" name="due_date" class="input-sq" style="padding: 10px;">
                    </div>
                </div>

                <div style="display: flex; gap: 15px;">
                    <button type="submit" class="btn-sq-primary" style="flex: 1;">Commit Task</button>
                    <button type="button" onclick="document.getElementById('add-assignment-modal').style.display='none'"
                        class="btn-sq-outline">Abort</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Custom Confirmation Modal (Assignment Purge) -->
    <div id="confirm-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 1210; justify-content: center; align-items: flex-start; padding-top: 50px;">
        <div id="confirm-card"
            style="background: #fff; width: 450px; max-width: 90%; border: 3px solid #000; box-shadow: 12px 12px 0px 0px #e11d48; transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 30px; text-align: center;">
                <div
                    style="width: 70px; height: 70px; background: #fff1f2; color: #e11d48; border-radius: 0; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px; border: 3px solid #000; box-shadow: 4px 4px 0px 0px #e11d48;">
                    <i class="fa-solid fa-file-pen"></i>
                </div>
                <h3
                    style="font-size: 18px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: #000; margin-bottom: 12px;">
                    Task Asset Purge
                </h3>
                <p
                    style="font-size: 12px; color: #475569; font-weight: 700; line-height: 1.6; margin-bottom: 30px; text-transform: uppercase;">
                    Purge assignment <br> <span id="assignment-title-display"
                        style="color:#e11d48; font-weight: 900; background: #fff1f2; padding: 2px 6px; border: 1px solid #e11d48; display: inline-block; margin-top: 5px;">[TITLE]</span>?
                    <br><br>
                    <strong>ALL SUBMISSIONS WILL BE LOST PERMANENTLY.</strong>
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

    <!-- Edit Assignment Modal -->
    <div id="edit-assignment-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 1200; align-items: center; justify-content: center;">
        <div class="modal-body-sq">
            <div class="modal-header-sq">
                <h3 style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin: 0;">
                    Edit Evaluation Framework</h3>
                <button onclick="document.getElementById('edit-assignment-modal').style.display='none'"
                    style="background:none; border:none; font-size: 24px; color: #fff; cursor:pointer; font-weight: 900;">&times;</button>
            </div>

            <form id="edit-assignment-form" method="POST" enctype="multipart/form-data" style="padding: 25px;">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 20px;">
                    <label class="sq-label">Governance Title</label>
                    <input type="text" name="title" id="edit-title" required class="input-sq"
                        style="text-transform: uppercase;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label class="sq-label">Strategic Instructions</label>
                    <textarea name="description" id="edit-description" required rows="4" class="input-sq"
                        style="resize: vertical;"></textarea>
                </div>

                <div style="margin-bottom: 20px;">
                    <label class="sq-label">Resource Attachment (Optional)</label>
                    <input type="file" name="attachment" class="input-sq"
                        style="background: #fff; cursor: pointer; padding: 10px;">
                    <small
                        style="font-size: 10px; color: #475569; font-weight: 700; text-transform: uppercase; margin-top: 5px; display: block;">
                        Keep empty to retain current attachment. Max 10MB.
                    </small>
                </div>

                <div style="margin-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <label class="sq-label" style="margin-bottom: 0;">Grading Criteria (%)</label>
                        <button type="button" onclick="addCriteriaRow('edit-criteria-container')" class="btn-sq-outline btn-sq-sm" style="padding: 4px 10px; font-size: 10px;">
                            <i class="fa-solid fa-plus"></i> Add
                        </button>
                    </div>
                    <div id="edit-criteria-container" style="display: flex; flex-direction: column; gap: 10px;">
                        <!-- Populate via JS -->
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                    <div>
                        <label class="sq-label">Max Quality Score</label>
                        <input type="number" name="max_score" id="edit-max-score" required min="1"
                            class="input-sq">
                    </div>
                    <div>
                        <label class="sq-label">Deadline (Optional)</label>
                        <input type="datetime-local" name="due_date" id="edit-due-date" class="input-sq"
                            style="padding: 10px;">
                    </div>
                </div>

                <div style="display: flex; gap: 15px;">
                    <button type="submit" class="btn-sq-primary" style="flex: 1;">Update Task</button>
                    <button type="button" onclick="document.getElementById('edit-assignment-modal').style.display='none'"
                        class="btn-sq-outline">Abort</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentDeleteForm = null;

        function addCriteriaRow(containerId, name = '', weight = '') {
            const container = document.getElementById(containerId);
            const row = document.createElement('div');
            row.className = 'criteria-row';
            row.style.display = 'flex';
            row.style.gap = '10px';
            row.innerHTML = `
                <input type="text" name="criteria_name[]" value="${name}" placeholder="Criteria Name" class="input-sq" style="flex: 2;">
                <input type="number" name="criteria_weight[]" value="${weight}" placeholder="%" class="input-sq" style="flex: 1;" min="0" max="100">
                <button type="button" onclick="this.parentElement.remove()" class="btn-sq-danger btn-sq-sm" style="padding: 10px; min-width: auto; box-shadow: 2px 2px 0px 0px #e11d48;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            `;
            container.appendChild(row);
        }

        function openEditModal(assignment) {
            const modal = document.getElementById('edit-assignment-modal');
            const form = document.getElementById('edit-assignment-form');

            // Set action URL
            form.action = `/instructor/courses/{{ $course->id }}/lessons/{{ $lesson->id }}/assignments/${assignment.id}`;

            // Populate fields
            document.getElementById('edit-title').value = assignment.title;
            document.getElementById('edit-description').value = assignment.description;
            document.getElementById('edit-max-score').value = assignment.max_score;

            // Populate Criteria
            const criteriaContainer = document.getElementById('edit-criteria-container');
            criteriaContainer.innerHTML = '';
            if (assignment.grading_criteria && assignment.grading_criteria.length > 0) {
                assignment.grading_criteria.forEach(c => {
                    addCriteriaRow('edit-criteria-container', c.name, c.weight);
                });
            } else {
                addCriteriaRow('edit-criteria-container');
            }

            if (assignment.due_date) {
                // Format date for datetime-local (YYYY-MM-DDTHH:mm)
                const date = new Date(assignment.due_date);
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                document.getElementById('edit-due-date').value = `${year}-${month}-${day}T${hours}:${minutes}`;
            } else {
                document.getElementById('edit-due-date').value = '';
            }

            modal.style.display = 'flex';
        }

        function triggerDelete(formId, title) {
            currentDeleteForm = document.getElementById(formId);
            document.getElementById('assignment-title-display').innerText = title;
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
