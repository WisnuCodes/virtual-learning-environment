@extends('layouts.app')

@section('content')
    <style>
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #ffffff;
            border: 2px solid #000;
            padding: 20px;
            border-radius: 0;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .table-container {
            background: #ffffff;
            border: 2px solid #000;
            border-radius: 0;
            overflow-x: auto;
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .course-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
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
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .dashboard-header .btn-sq-primary {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table-container {
                border: none;
                background: transparent;
                overflow: visible;
                box-shadow: none;
            }

            .course-table,
            .course-table tbody,
            .course-table tr,
            .course-table td {
                display: block;
                width: 100%;
                min-width: 100%;
                box-sizing: border-box;
            }

            .course-table thead {
                display: none;
            }

            .course-table tr {
                background: #fff;
                margin-bottom: 20px;
                border: 2px solid #000;
                box-shadow: 4px 4px 0px 0px var(--accent-primary);
            }

            .course-table td {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                padding: 15px !important;
                border-bottom: 1px solid #000 !important;
                text-align: left !important;
                gap: 5px;
            }

            .course-table td:last-child {
                border-bottom: none !important;
                background: #f8fafc;
            }

            .course-table td:last-child>div {
                width: 100%;
                justify-content: flex-start !important;
            }

            .course-table td:nth-child(2)::before {
                content: "Harga:";
                font-size: 10px;
                font-weight: 800;
                color: #64748b;
                text-transform: uppercase;
            }

            .course-table td:nth-child(3)::before {
                content: "Siswa Terdaftar:";
                font-size: 10px;
                font-weight: 800;
                color: #64748b;
                text-transform: uppercase;
            }

            .course-table td:nth-child(4)::before {
                content: "Status Audit:";
                font-size: 10px;
                font-weight: 800;
                color: #64748b;
                text-transform: uppercase;
            }

            .course-table td:nth-child(5)::before {
                content: "Kontrol:";
                font-size: 10px;
                font-weight: 800;
                color: #64748b;
                text-transform: uppercase;
                margin-bottom: 5px;
            }

            .course-table td:first-child {
                background: #f8fafc;
                border-bottom: 2px solid #000 !important;
            }
        }
    </style>
    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1000px; margin: 0 auto; padding: 40px 5%;">

            <div class="dashboard-header">
                <div>
                    <h1
                        style="font-size: 28px; font-weight: 900; color: var(--text-primary); margin-bottom: 4px; letter-spacing: -0.5px; text-transform: uppercase;">
                        Panel Instruktur</h1>
                    <p style="color: var(--text-secondary); font-size: 14px; margin: 0; font-weight: 500;">Kelola kursus Anda dan pantau pendapatan Anda.</p>
                </div>
                <a href="{{ route('instructor.courses.create') }}" class="btn-sq-primary">
                    <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> Buat Kursus
                </a>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 12px 15px; margin-bottom: 25px; font-weight: 700; font-size: 13px; border-radius: 0px; display: flex; align-items: center; gap: 8px; box-shadow: 4px 4px 0px 0px #10b981;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="stats-grid">

                <div class="stat-card">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                        <div
                            style="width: 48px; height: 48px; background: var(--accent-primary); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; border-radius: 0px; border: 2px solid #000;">
                            <i class="fa-solid fa-cube"></i>
                        </div>
                        <div>
                            <div
                                style="color: var(--text-secondary); font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                                Total Kursus</div>
                            <div style="font-size: 28px; font-weight: 900; color: #000; line-height: 1.2;">
                                {{ $courses->count() }}</div>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                        <div
                            style="width: 48px; height: 48px; background: #3b82f6; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; border-radius: 0px; border: 2px solid #000;">
                            <i class="fa-solid fa-user-astronaut"></i>
                        </div>
                        <div>
                            <div
                                style="color: var(--text-secondary); font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                                Total Siswa</div>
                            <div style="font-size: 28px; font-weight: 900; color: #000; line-height: 1.2;">
                                {{ $totalStudents }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card" style="cursor: pointer;" onclick="window.location.href='{{ route('instructor.reviews') }}'">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                        <div
                            style="width: 48px; height: 48px; background: #8b5cf6; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; border-radius: 0px; border: 2px solid #000;">
                            <i class="fa-solid fa-message"></i>
                        </div>
                        <div>
                            <div
                                style="color: var(--text-secondary); font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                                Ulasan Siswa</div>
                            <div style="font-size: 14px; font-weight: 900; color: #000; margin-top: 5px; text-transform: uppercase;">
                                Kelola <i class="fa-solid fa-arrow-right" style="margin-left: 5px; font-size: 10px;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                        <div
                            style="width: 48px; height: 48px; background: #eab308; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; border-radius: 0px; border: 2px solid #000;">
                            <i class="fa-solid fa-coins"></i>
                        </div>
                        <div>
                            <div
                                style="color: var(--text-secondary); font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                                Total Pendapatan</div>
                            <div style="font-size: 28px; font-weight: 900; color: #000; line-height: 1.2;">
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

            </div>

            <h2
                style="font-size: 18px; font-weight: 900; margin-bottom: 15px; color: var(--text-primary); text-transform: uppercase;">
                <i class="fa-solid fa-table-list" style="color: var(--accent-primary); margin-right: 8px;"></i>Inventaris Kursus
            </h2>

            <div class="table-container">
                <table class="course-table">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 3px solid #000; text-align: left;">
                            <th
                                style="padding: 15px 18px; font-weight: 900; color: #000; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">
                                Identitas Kursus</th>
                            <th
                                style="padding: 15px 18px; font-weight: 900; color: #000; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">
                                Harga</th>
                            <th
                                style="padding: 15px 18px; font-weight: 900; color: #000; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">
                                Siswa</th>
                            <th
                                style="padding: 15px 18px; font-weight: 900; color: #000; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">
                                Status Audit</th>
                            <th
                                style="padding: 15px 18px; font-weight: 900; color: #000; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; text-align: right;">
                                Kontrol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr style="border-bottom: 1px solid #000; transition: 0.2s;"
                                onmouseover="this.style.background='#f1f5f9'"
                                onmouseout="this.style.background='transparent'">
                                <td style="padding: 15px 18px; vertical-align: middle;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <img src="{{ $course->thumbnail }}"
                                            style="width: 50px; height: 35px; object-fit: cover; border-radius: 0px; border: 2px solid #000;">
                                        <div style="display: flex; flex-direction: column; gap: 4px;">
                                            <a href="{{ route('courses.show', $course->slug) }}"
                                                style="font-weight: 800; font-size: 14px; color: #000; text-decoration: none; line-height: 1.3;">{{ $course->title }}</a>
                                            @if ($course->status === 'pending')
                                                <span
                                                    style="display: inline-block; width: fit-content; font-size: 9px; background: #fef08a; color: #854d0e; padding: 2px 6px; border: 2px solid #000; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px;">Menunggu 
                                                    Persetujuan</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td
                                    style="padding: 15px 18px; vertical-align: middle; color: #000; font-weight: 900; font-size: 14px;">
                                    @if ($course->discount_price)
                                        <div
                                            style="font-size: 11px; color: #64748b; text-decoration: line-through; margin-bottom: 1px;">
                                            Rp {{ number_format($course->price, 0, ',', '.') }}</div>
                                        <div
                                            style="color: #e11d48; border: 1px solid #e11d48; padding: 2px 6px; display: inline-block;">
                                            Rp {{ number_format($course->discount_price, 0, ',', '.') }}</div>
                                    @elseif($course->price == 0)
                                        <span
                                            style="color: #10b981; border: 2px solid #000; padding: 2px 8px; font-size: 11px; background: #fff;">GRATIS</span>
                                    @else
                                        Rp {{ number_format($course->price, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="padding: 15px 18px; vertical-align: middle;">
                                    <span
                                        style="background: #f1f5f9; border: 2px solid #000; padding: 6px 12px; font-size: 11px; font-weight: 900; color: #000; box-shadow: 2px 2px 0px 0px #000; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                                        <i class="fa-solid fa-user-astronaut" style="color: #3b82f6; font-size: 14px;"></i>
                                        <span>{{ $course->enrollments_count }}</span>
                                    </span>
                                </td>
                                <td style="padding: 15px 18px; vertical-align: middle;">
                                    @if ($course->status === 'published')
                                        <span
                                            style="color: #10b981; font-size: 11px; font-weight: 900; text-transform: uppercase; display: flex; align-items: center; gap: 6px;">
                                            <i class="fa-solid fa-square-check"></i> Terbit
                                        </span>
                                    @elseif($course->status === 'pending')
                                        <div style="display: flex; flex-direction: column; gap: 3px;">
                                            <span
                                                style="color: #f59e0b; font-size: 11px; font-weight: 900; text-transform: uppercase; display: flex; align-items: center; gap: 6px;">
                                                <i class="fa-solid fa-shield-halved"></i> Sedang Audit
                                            </span>
                                            <div
                                                style="font-size: 9px; color: #94a3b8; font-weight: 800; line-height: 1.1;">
                                                Menilai materi...</div>
                                        </div>
                                    @elseif($course->status === 'rejected')
                                        <div style="display: flex; flex-direction: column; gap: 3px;">
                                            <span
                                                style="color: #ef4444; font-size: 11px; font-weight: 900; text-transform: uppercase; display: flex; align-items: center; gap: 6px;">
                                                <i class="fa-solid fa-square-xmark"></i> Ditolak
                                            </span>
                                            <div
                                                style="font-size: 9px; color: #b91c1c; font-weight: 800; line-height: 1.1;">
                                                Perlu tindakan.</div>
                                        </div>
                                    @else
                                        <span
                                            style="color: #64748b; font-size: 11px; font-weight: 900; text-transform: uppercase;">{{ $course->status }}</span>
                                    @endif
                                </td>
                                <td style="padding: 15px 18px; vertical-align: middle; text-align: right;">
                                    <div style="display: flex; justify-content: flex-end; align-items: center; gap: 8px;">
                                        <a href="{{ route('instructor.curriculum.index', $course->id) }}"
                                            style="padding: 6px 12px; font-size: 12px; font-weight: 800; background: #fff; color: #000; border: 2px solid #000; text-decoration: none; box-shadow: 2px 2px 0px 0px #3b82f6; transition: 0.2s;"
                                            title="Curriculum"
                                            onmouseover="this.style.transform='translate(-1px, -1px)'; this.style.boxShadow='3px 3px 0px 0px #3b82f6'"
                                            onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='2px 2px 0px 0px #3b82f6'">
                                            <i class="fa-solid fa-list-check"></i>
                                        </a>
                                        <a href="{{ route('instructor.courses.edit', $course->id) }}"
                                            style="padding: 6px 12px; font-size: 12px; font-weight: 800; background: #fff; color: #000; border: 2px solid #000; text-decoration: none; box-shadow: 2px 2px 0px 0px #eab308; transition: 0.2s;"
                                            title="Edit Course"
                                            onmouseover="this.style.transform='translate(-1px, -1px)'; this.style.boxShadow='3px 3px 0px 0px #eab308'"
                                            onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='2px 2px 0px 0px #eab308'">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('instructor.courses.destroy', $course->id) }}"
                                            method="POST" style="display:inline; margin: 0;"
                                            id="delete-form-{{ $course->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                onclick="triggerDelete('delete-form-{{ $course->id }}', '{{ addslashes($course->title) }}')"
                                                style="padding: 6px 12px; font-size: 12px; font-weight: 800; background: #fff; color: #e11d48; border: 2px solid #000; cursor: pointer; box-shadow: 2px 2px 0px 0px #e11d48; transition: 0.2s;"
                                                title="Delete Course"
                                                onmouseover="this.style.transform='translate(-1px, -1px)'; this.style.boxShadow='3px 3px 0px 0px #e11d48'"
                                                onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='2px 2px 0px 0px #e11d48'">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    style="padding: 60px 20px; text-align: center; color: #000; background: var(--bg-secondary); border-bottom: 2px solid #000;">
                                    <div
                                        style="width: 60px; height: 60px; background: #fff; border: 2px solid #000; border-radius: 0px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 4px 4px 0px 0px var(--accent-primary);">
                                        <i class="fa-solid fa-box-open" style="font-size: 24px; color: #000;"></i>
                                    </div>
                                    <div
                                        style="margin-bottom: 20px; font-size: 15px; font-weight: 800; text-transform: uppercase;">
                                        Anda belum membuat kursus apa pun.</div>
                                    <a href="{{ route('instructor.courses.create') }}" class="btn-sq-primary">
                                        Buat Kursus Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Custom Confirmation Modal (Instructor Asset Removal) -->
    <div id="confirm-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); z-index: 1200; justify-content: center; align-items: flex-start; padding-top: 50px;">
        <div id="confirm-card"
            style="background: #fff; width: 450px; max-width: 90%; border: 3px solid #000; box-shadow: 12px 12px 0px 0px #e11d48; transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 30px; text-align: center;">
                <div
                    style="width: 70px; height: 70px; background: #fff1f2; color: #e11d48; border-radius: 0; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 28px; border: 3px solid #000; box-shadow: 4px 4px 0px 0px #e11d48;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3
                    style="font-size: 18px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: #000; margin-bottom: 12px;">
                    Permintaan Penghapusan Kursus
                </h3>
                <p style="font-size: 12px; color: #475569; font-weight: 700; line-height: 1.6; margin-bottom: 30px;">
                    Apakah Anda yakin ingin menghapus <br> <span id="course-title-display"
                        style="color:#e11d48; font-weight: 900; background: #fff1f2; padding: 2px 6px; border: 1px solid #e11d48; display: inline-block; margin-top: 5px;">[NAMA_KURSUS]</span>?
                    <br><br>
                    Tindakan ini akan menghapus kursus dari katalog. Akses siswa yang sudah ada mungkin akan terpengaruh sesuai kebijakan sistem.
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

        function triggerDelete(formId, courseTitle) {
            currentDeleteForm = document.getElementById(formId);
            document.getElementById('course-title-display').innerText = courseTitle;
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
