@extends('layouts.app')

@section('content')
    <style>
        .curriculum-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #000;
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
            padding: 6px 12px;
            font-size: 11px;
        }

        .section-card {
            background: #ffffff;
            border: 2px solid #000;
            border-radius: 0;
            margin-bottom: 30px;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            transition: all 0.2s ease;
        }

        .section-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .section-header {
            background: #f8fafc;
            padding: 15px 20px;
            border-bottom: 2px solid #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .lesson-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 2px solid #000;
        }

        .lesson-item:last-child {
            border-bottom: none;
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
            width: 450px;
            max-width: 90%;
            border-radius: 0;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
            max-height: 90vh; /* slightly reduce to prevent overflow */
            display: flex;
            flex-direction: column;
            margin: auto; /* ensure centering within flex */
        }

        .modal-header-sq {
            padding: 15px 20px;
            border-bottom: 3px solid #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--accent-primary);
            color: #fff;
            flex-shrink: 0;
        }

        .modal-body-sq form {
            overflow-y: auto;
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
            .curriculum-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .section-header .actions {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }

            .lesson-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .lesson-item .actions {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                justify-content: flex-start;
            }
        }
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 850px; margin: 0 auto; padding: 40px 5%;">

            <div class="curriculum-header">
                <div>
                    <h2
                        style="font-size: 28px; font-weight: 900; color: var(--text-primary); text-transform: uppercase; letter-spacing: -0.5px; margin: 0; margin-bottom: 4px;">
                        Pengelola Kurikulum</h2>
                    <p style="color: var(--text-secondary); font-size: 14px; margin: 0; font-weight: 500;">Menyusun struktur materi untuk:
                        <strong style="color: #000;">{{ $course->title }}</strong>
                    </p>
                </div>

                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button onclick="document.getElementById('add-section-modal').style.display='flex'"
                        class="btn-sq-primary">
                        <i class="fa-solid fa-layer-group" style="margin-right: 6px;"></i> Bagian Baru
                    </button>
                    <a href="{{ route('instructor.dashboard') }}" class="btn-sq-outline">
                        <i class="fa-solid fa-arrow-left" style="margin-right: 6px;"></i> Kembali
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 12px 15px; margin-bottom: 25px; font-weight: 800; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 4px 4px 0px 0px #10b981; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-circle-check" style="font-size: 16px;"></i> {{ session('success') }}
                </div>
            @endif

            @forelse($course->sections as $section)
                <div class="section-card">
                    <!-- Section Header -->
                    <div class="section-header">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div
                                style="width: 32px; height: 32px; background: #fff; border: 2px solid #000; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 14px; box-shadow: 2px 2px 0px 0px #000;">
                                {{ $loop->iteration }}
                            </div>
                            <div style="display: flex; flex-direction: column;">
                                <span
                                    style="font-size: 10px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Bagian</span>
                                <h3
                                    style="font-size: 16px; font-weight: 900; color: #000; margin: 0; text-transform: uppercase;">
                                    {{ $section->title }}</h3>
                            </div>
                        </div>

                        <div class="actions" style="display: flex; align-items: center; gap: 8px;">
                            <a href="{{ route('instructor.lessons.create', [$course->id, $section->id]) }}"
                                class="btn-sq-primary btn-sq-sm" style="text-decoration: none; display: inline-flex; align-items: center;">
                                <i class="fa-solid fa-plus" style="margin-right: 4px;"></i> Materi
                            </a>

                            <button
                                onclick="document.getElementById('edit-section-modal-{{ $section->id }}').style.display='flex'"
                                class="btn-sq-outline btn-sq-sm">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <form action="{{ route('instructor.sections.destroy', [$course->id, $section->id]) }}"
                                method="POST" id="delete-section-{{ $section->id }}" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="button"
                                    onclick="triggerDelete('delete-section-{{ $section->id }}', 'section', '{{ addslashes($section->title) }}')"
                                    class="btn-sq-danger btn-sq-sm">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Lessons List -->
                    <div style="padding: 0 20px;">
                        @forelse($section->lessons as $lesson)
                            <div class="lesson-item">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div
                                        style="width: 24px; height: 24px; background: #f1f5f9; border: 2px solid #000; display: flex; align-items: center; justify-content: center; font-size: 11px; color: #000; font-weight: 900;">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div>
                                        <div
                                            style="font-size: 14px; font-weight: 800; color: #000; display: flex; align-items: center; gap: 8px; text-transform: uppercase;">
                                            <i class="{{ $lesson->video_url ? 'fa-solid fa-video' : 'fa-solid fa-file-lines' }}"
                                                style="font-size: 12px; color: var(--accent-primary);"></i>
                                            {{ $lesson->title }}
                                        </div>
                                        @if ($lesson->is_free_preview)
                                            <span
                                                style="font-size: 9px; background: #ecfdf5; color: #059669; padding: 2px 6px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px; border: 2px solid #000; margin-top: 6px; display: inline-block; box-shadow: 2px 2px 0px 0px #10b981;">Akses Terbuka</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="actions" style="display: flex; align-items: center; gap: 8px;">
                                    <a href="{{ route('instructor.assignments.index', [$course->id, $lesson->id]) }}"
                                        class="btn-sq-outline btn-sq-sm" title="Assignments">
                                        <i class="fa-solid fa-file-signature"></i>
                                    </a>

                                    <a href="{{ route('instructor.quiz.index', [$course->id, $lesson->id]) }}"
                                        class="btn-sq-outline btn-sq-sm" title="Quiz Management">
                                        <i class="fa-solid fa-list-check"></i>
                                    </a>

                                    <button
                                        onclick="document.getElementById('edit-lesson-modal-{{ $lesson->id }}').style.display='flex'"
                                        class="btn-sq-outline btn-sq-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <form
                                        action="{{ route('instructor.lessons.destroy', [$course->id, $section->id, $lesson->id]) }}"
                                        method="POST" id="delete-unit-{{ $lesson->id }}" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="button"
                                            onclick="triggerDelete('delete-unit-{{ $lesson->id }}', 'unit', '{{ addslashes($lesson->title) }}')"
                                            class="btn-sq-danger btn-sq-sm"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </div>

                            <!-- Edit Lesson Modal -->
                            <div id="edit-lesson-modal-{{ $lesson->id }}"
                                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 1200; align-items: center; justify-content: center; padding: 40px 10px; box-sizing: border-box;">
                                <div class="modal-body-sq">
                                    <div class="modal-header-sq">
                                        <h3
                                            style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 85%;">
                                            Edit Materi</h3>
                                        <button
                                            onclick="document.getElementById('edit-lesson-modal-{{ $lesson->id }}').style.display='none'"
                                            style="background:none; border:none; font-size: 24px; color: #fff; cursor:pointer; font-weight: 900;">&times;</button>
                                    </div>
                                    <form
                                        action="{{ route('instructor.lessons.update', [$course->id, $section->id, $lesson->id]) }}"
                                        method="POST" enctype="multipart/form-data" style="padding: 20px;">
                                        @csrf @method('PUT')
                                        <div style="margin-bottom: 15px;">
                                            <label class="sq-label">Judul Materi</label>
                                            <input type="text" name="title" value="{{ $lesson->title }}" required
                                                class="input-sq" style="text-transform: uppercase;">
                                        </div>
                                        <div style="margin-bottom: 15px;">
                                            <label class="sq-label">Tautan YouTube / Eksternal</label>
                                            <input type="url" name="video_url" value="{{ \Illuminate\Support\Str::startsWith($lesson->video_url, '/storage') ? '' : $lesson->video_url }}"
                                                placeholder="https://registry.io/video" class="input-sq">
                                        </div>
                                        <div style="margin-bottom: 15px;">
                                            <label class="sq-label">Upload File Video Lokal (Opsional)</label>
                                            <input type="file" name="video_file" accept="video/mp4,video/x-m4v,video/*" class="input-sq" style="padding: 9px; cursor: pointer;">
                                            @if(\Illuminate\Support\Str::startsWith($lesson->video_url, '/storage'))
                                                <small style="display:block; margin-top:5px; font-weight:800; color:var(--accent-primary);">File tersimpan: {{ basename($lesson->video_url) }}</small>
                                            @endif
                                        </div>
                                        <div style="margin-bottom: 15px;">
                                            <label class="sq-label">Materi Tambahan (Teks)</label>
                                            <textarea name="content" rows="4" class="input-sq" style="resize: vertical;">{{ $lesson->content }}</textarea>
                                        </div>

                                        <div
                                            style="margin-bottom: 20px; border: 2px solid #000; padding: 12px; background: #f8fafc;">
                                            <label
                                                style="display:flex; align-items:center; gap:10px; cursor:pointer; font-size: 13px; font-weight: 900; color: #000; text-transform: uppercase;">
                                                <input type="checkbox" name="is_free_preview" value="1"
                                                    {{ $lesson->is_free_preview ? 'checked' : '' }}
                                                    style="width: 18px; height: 18px; accent-color: var(--accent-primary);">
                                                <span>Buka Akses (Pratinjau Gratis)</span>
                                            </label>
                                        </div>
                                        <div style="display: flex; gap: 15px;">
                                            <button type="submit" class="btn-sq-primary" style="flex: 1;">Simpan
                                                Perubahan</button>
                                            <button type="button"
                                                onclick="document.getElementById('edit-lesson-modal-{{ $lesson->id }}').style.display='none'"
                                                class="btn-sq-outline">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div
                                style="text-align: center; padding: 40px 0; color: #000; font-size: 14px; font-weight: 800; text-transform: uppercase;">
                                <div
                                    style="width: 48px; height: 48px; background: #f1f5f9; border: 2px solid #000; border-radius: 0; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 4px 4px 0px 0px #000;">
                                    <i class="fa-solid fa-inbox" style="font-size: 20px;"></i>
                                </div>
                                Bagian ini belum memiliki materi.
                            </div>
                        @endforelse
                    </div>



                    <!-- Edit Section Modal -->
                    <div id="edit-section-modal-{{ $section->id }}"
                        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 1200; align-items: center; justify-content: center; padding: 40px 10px; box-sizing: border-box;">
                        <div class="modal-body-sq" style="width: 450px;">
                            <div class="modal-header-sq">
                                <h3
                                    style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 85%;">
                                    Edit Bagian</h3>
                                <button
                                    onclick="document.getElementById('edit-section-modal-{{ $section->id }}').style.display='none'"
                                    style="background:none; border:none; font-size: 24px; color: #fff; cursor:pointer; font-weight: 900;">&times;</button>
                            </div>
                            <form action="{{ route('instructor.sections.update', [$course->id, $section->id]) }}"
                                method="POST" style="padding: 25px;">
                                @csrf @method('PUT')
                                <div style="margin-bottom: 25px;">
                                    <label class="sq-label">Nama Bagian</label>
                                    <input type="text" name="title" value="{{ $section->title }}" required
                                        class="input-sq" style="text-transform: uppercase;">
                                </div>
                                <div style="display: flex; gap: 15px;">
                                    <button type="submit" class="btn-sq-primary" style="flex: 1;">Perbarui Bagian</button>
                                    <button type="button"
                                        onclick="document.getElementById('edit-section-modal-{{ $section->id }}').style.display='none'"
                                        class="btn-sq-outline">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div
                        style="width: 72px; height: 72px; background: var(--accent-primary); border: 3px solid #000; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 6px 6px 0px 0px #000;">
                        <i class="fa-solid fa-folder-tree" style="font-size: 32px; color: #fff;"></i>
                    </div>
                    <h3
                        style="font-size: 20px; font-weight: 900; color: #000; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">
                        Kurikulum Kosong</h3>
                    <p style="color: #475569; font-size: 14px; margin-bottom: 30px; font-weight: 700;">Mulai struktur kursus Anda dengan membuat bagian pertama.</p>
                    <button onclick="document.getElementById('add-section-modal').style.display='flex'"
                        class="btn-sq-primary">
                        <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Buat Bagian
                    </button>
                </div>
            @endforelse

        </div>
    </div>

    <!-- Add Section Modal (Global) -->
    <div id="add-section-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 1200; align-items: center; justify-content: center; padding: 40px 10px; box-sizing: border-box;">
        <div class="modal-body-sq" style="width: 450px;">
            <div class="modal-header-sq">
                <h3 style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 85%;">
                    Tambah Bagian Baru</h3>
                <button onclick="document.getElementById('add-section-modal').style.display='none'"
                    style="background:none; border:none; font-size: 24px; color: #fff; cursor:pointer; font-weight: 900;">&times;</button>
            </div>
            <form action="{{ route('instructor.sections.store', $course->id) }}" method="POST" style="padding: 25px;">
                @csrf
                <div style="margin-bottom: 25px;">
                    <label class="sq-label">Nama Bagian</label>
                    <input type="text" name="title" placeholder="CONTOH: FASE PENGENALAN" required class="input-sq"
                        style="text-transform: uppercase;">
                </div>
                <div style="display: flex; gap: 15px;">
                    <button type="submit" class="btn-sq-primary" style="flex: 1;">Simpan Bagian</button>
                    <button type="button" onclick="document.getElementById('add-section-modal').style.display='none'"
                        class="btn-sq-outline">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Custom Confirmation Modal (Curriculum Purge) -->
    <div id="confirm-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 1210; justify-content: center; align-items: flex-start; padding-top: 50px;">
        <div id="confirm-card"
            style="background: #fff; width: 450px; max-width: 90%; border: 3px solid #000; box-shadow: 12px 12px 0px 0px #e11d48; transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 30px; text-align: center;">
                <div id="modal-icon-container"
                    style="width: 70px; height: 70px; background: #fff1f2; color: #e11d48; border-radius: 0; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px; border: 3px solid #000; box-shadow: 4px 4px 0px 0px #e11d48;">
                    <i id="modal-icon" class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 id="modal-title"
                    style="font-size: 18px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: #000; margin-bottom: 12px;">
                    Konfirmasi Penghapusan
                </h3>
                <p id="modal-message"
                    style="font-size: 12px; color: #475569; font-weight: 700; line-height: 1.6; margin-bottom: 30px;">
                    Apakah Anda yakin?
                </p>
                <div style="display: flex; gap: 15px; justify-content: center;">
                    <button id="confirm-yes"
                        style="padding: 12px 25px; font-size: 12px; font-weight: 900; background: #e11d48; color: #fff; border: 2px solid #000; box-shadow: 4px 4px 0px 0px #000; cursor: pointer; text-transform: uppercase;">
                        KONFIRMASI HAPUS
                    </button>
                    <button onclick="closeConfirmModal()"
                        style="padding: 12px 25px; font-size: 12px; font-weight: 900; background: #fff; color: #000; border: 2px solid #000; box-shadow: 4px 4px 0px 0px #000; cursor: pointer; text-transform: uppercase;">
                        BATALKAN
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteForm = null;

        function triggerDelete(formId, type, title) {
            currentDeleteForm = document.getElementById(formId);
            const modalTitle = document.getElementById('modal-title');
            const modalMessage = document.getElementById('modal-message');
            const modalIcon = document.getElementById('modal-icon');
            const iconContainer = document.getElementById('modal-icon-container');
            const confirmBtn = document.getElementById('confirm-yes');
            const confirmCard = document.getElementById('confirm-card');

            if (type === 'section') {
                modalTitle.innerText = "Penghapusan Bagian";
                modalMessage.innerHTML =
                    `Hapus seluruh bagian <br> <span style="color:#e11d48; font-weight: 900; background: #fff1f2; padding: 2px 6px; border: 1px solid #e11d48; display: inline-block; margin-top: 5px;">${title}</span> <br><br> dan semua materi di dalamnya?<br><br> <strong>TINDAKAN INI PERMANEN.</strong>`;
                modalIcon.className = "fa-solid fa-layer-group";

                // Styling specifically for section
                iconContainer.style.background = "#fff1f2";
                iconContainer.style.color = "#e11d48";
                confirmCard.style.boxShadow = "12px 12px 0px 0px #e11d48";
            } else {
                modalTitle.innerText = "Penghapusan Materi";
                modalMessage.innerHTML =
                    `Hapus materi <br> <span style="color:#e11d48; font-weight: 900; background: #fff1f2; padding: 2px 6px; border: 1px solid #e11d48; display: inline-block; margin-top: 5px;">${title}</span> <br><br> dari kurikulum ini?`;
                modalIcon.className = "fa-solid fa-xmark";

                // Styling specifically for unit
                iconContainer.style.background = "#f1f5f9";
                iconContainer.style.color = "#475569";
                confirmCard.style.boxShadow = "12px 12px 0px 0px #475569";
            }

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
            if (currentDeleteForm) currentDeleteForm.submit();
        });
    </script>
@endsection
