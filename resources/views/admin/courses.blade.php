@extends('layouts.app')

@section('content')
    <style>
        .registry-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 35px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .registry-title-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            background: #000;
            padding: 8px 18px;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            display: inline-flex;
        }

        .table-container {
            background: #fff;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px #000;
            overflow-x: auto;
            margin-bottom: 40px;
        }

        .registry-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .registry-table th {
            padding: 15px 25px;
            font-size: 12px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 3px solid #000;
            background: #f8fafc;
            border-right: 2px solid #000;
        }

        .registry-table th:last-child {
            border-right: none;
        }

        .registry-table td {
            padding: 20px 25px;
            border-bottom: 2px solid #000;
            border-right: 2px solid #000;
            background: #fff;
            transition: all 0.2s ease;
        }

        .registry-table td:last-child {
            border-right: none;
        }

        .registry-table tr:hover td {
            background: #f8fafc;
        }

        .registry-table tr:last-child td {
            border-bottom: none;
        }

        .btn-sq-outline {
            background: #fff;
            color: #000;
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
            letter-spacing: 1px;
            box-shadow: 4px 4px 0px 0px #000;
            text-decoration: none;
        }

        .btn-sq-outline:hover {
            transform: translate(-3px, -3px);
            box-shadow: 7px 7px 0px 0px #000;
            color: #000;
            background: #f8fafc;
        }

        .btn-sq-outline:active {
            transform: translate(3px, 3px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        .btn-sq-danger {
            background: #fff;
            color: #e11d48;
            border: 2px solid #000;
            padding: 8px 12px;
            border-radius: 0;
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            box-shadow: 3px 3px 0px 0px #e11d48;
            text-decoration: none;
        }

        .btn-sq-danger:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0px 0px #e11d48;
            color: #fff;
            background: #e11d48;
        }

        .btn-sq-danger:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #e11d48;
            background: #e11d48;
            color: #fff;
        }

        .status-select {
            padding: 8px 12px;
            border: 2px solid #000;
            border-radius: 0;
            font-size: 12px;
            background: #fff;
            font-weight: 900;
            cursor: pointer;
            text-transform: uppercase;
            box-shadow: 3px 3px 0px 0px #000;
            transition: all 0.2s ease;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
            padding-right: 35px;
        }

        .status-select:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px 0px #000;
        }

        .status-select:focus {
            outline: none;
            background-color: #f8fafc;
        }

        .asset-link {
            color: #000;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .asset-link:hover {
            color: var(--accent-primary);
            border-bottom: 2px solid var(--accent-primary);
        }
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 40px 5%;">

            <div class="registry-header">
                <div>
                    <div class="registry-title-wrapper">
                        <i class="fa-solid fa-satellite-dish" style="color: var(--accent-primary); font-size: 18px;"></i>
                        <h2
                            style="font-size: 18px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">
                            Pangkalan Data Kursus</h2>
                    </div>
                    <p
                        style="color: #000; font-size: 14px; margin: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                        Moderasi katalog lengkap dan kontrol status.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn-sq-outline">
                    <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Kembali ke Panel
                </a>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 15px 20px; margin-bottom: 30px; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 5px 5px 0px 0px #10b981; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i> {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <table class="registry-table">
                    <thead>
                        <tr>
                            <th>Kursus</th>
                            <th>Identitas Penulis</th>
                            <th>Status Publikasi</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <div style="position: relative;">
                                            <img src="{{ $course->thumbnail }}"
                                                style="width: 70px; height: 50px; object-fit: cover; border: 2px solid #000; box-shadow: 3px 3px 0px 0px #000;">
                                        </div>
                                        <div>
                                            <div
                                                style="font-size: 15px; font-weight: 900; line-height: 1.2; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                                                <a href="{{ route('courses.show', $course->slug) }}" target="_blank"
                                                    class="asset-link">
                                                    {{ $course->title }}
                                                </a>
                                            </div>
                                            <div
                                                style="font-size: 12px; color: #000; font-weight: 800; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                                @if ($course->discount_price)
                                                    <span
                                                        style="color: #fff; background: #e11d48; padding: 2px 6px; border: 1px solid #000;">Rp {{ number_format($course->discount_price, 0, ',', '.') }}</span>
                                                    <span
                                                        style="color: #64748b; text-decoration: line-through; font-size: 11px;">
                                                        Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                                @elseif ($course->price == 0)
                                                    <span
                                                        style="color: #fff; background: #10b981; padding: 2px 6px; border: 1px solid #000;">GRATIS</span>
                                                @else
                                                    <span
                                                        style="color: #fff; background: #000; padding: 2px 6px; border: 1px solid #000;">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                                @endif
                                                <span
                                                    style="color: #000; border-left: 2px solid #000; padding-left: 8px; text-transform: uppercase; font-size: 11px;">
                                                    <i class="fa-solid fa-users"
                                                        style="color: var(--accent-primary); margin-right: 4px;"></i>
                                                    {{ $course->enrollments_count }} Siswa
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div
                                        style="font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase; margin-bottom: 4px;">
                                        {{ $course->user->name ?? 'INSTRUKTUR TIDAK DIKENAL' }}</div>
                                    <div
                                        style="font-size: 11px; color: #475569; font-weight: 700; background: #e2e8f0; border: 1px solid #000; padding: 2px 6px; display: inline-block;">
                                        ID: {{ $course->user->email ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <form action="{{ route('admin.courses.updateStatus', $course->id) }}" method="POST"
                                        style="margin: 0;">
                                        @csrf @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="status-select"
                                            style="color: {{ $course->status === 'published' ? '#10b981' : '#d97706' }};">
                                            <option value="draft" {{ $course->status === 'draft' ? 'selected' : '' }}>
                                                Terbatas (Draft)</option>
                                            <option value="published"
                                                {{ $course->status === 'published' ? 'selected' : '' }}>Terbitkan Publik
                                            </option>
                                        </select>
                                    </form>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: flex; justify-content: flex-end;">
                                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                            style="margin: 0;" id="delete-form-{{ $course->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn-sq-danger"
                                                onclick="triggerDelete('delete-form-{{ $course->id }}', '{{ addslashes($course->title) }}')"
                                                title="Hapus Kursus">
                                                <i class="fa-solid fa-trash-can" style="margin-right: 6px;"></i> HAPUS KURSUS
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 60px 20px; text-align: center; border-bottom: none;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
                                        <div
                                            style="width: 80px; height: 80px; border: 3px solid #000; display: flex; align-items: center; justify-content: center; font-size: 32px; color: #cbd5e1; background: #f8fafc; box-shadow: 6px 6px 0px 0px #000;">
                                            <i class="fa-solid fa-folder-open"></i>
                                        </div>
                                        <h3
                                            style="font-size: 16px; font-weight: 900; color: #000; margin: 0; text-transform: uppercase;">
                                            Data Kosong</h3>
                                        <p
                                            style="color: #64748b; font-size: 13px; font-weight: 800; margin: 0; text-transform: uppercase;">
                                            Tidak ada aset pembelajaran terdeteksi di seluruh sistem.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($courses->hasPages())
                    <div
                        style="padding: 25px 30px; border-top: 3px solid #000; background: #fff; display: flex; justify-content: center;">
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
                        {{ $courses->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Custom Confirmation Modal (Asset Purge) -->
    <div id="confirm-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(8px); z-index: 1200; justify-content: center; align-items: flex-start; padding-top: 50px;">
        <div id="confirm-card"
            style="background: #fff; width: 500px; max-width: 90%; border: 4px solid #000; box-shadow: 15px 15px 0px rgba(0,0,0,1); transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 40px; text-align: center;">
                <div
                    style="width: 80px; height: 80px; background: #fff; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px; border: 3px solid #000; box-shadow: 6px 6px 0px 0px #e11d48; color: #e11d48;">
                    <i class="fa-solid fa-dumpster-fire"></i>
                </div>
                <h3
                    style="font-size: 20px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; color: #000; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 15px;">
                    Penghapusan Data Kursus
                </h3>
                <p
                    style="font-size: 14px; color: #000; font-weight: 700; line-height: 1.6; margin-bottom: 35px; text-transform: uppercase;">
                    Apakah Anda yakin ingin menghapus permanen <br><br> <span id="course-name"
                        style="background: #e11d48; color: #fff; padding: 4px 10px; font-weight: 900; border: 2px solid #000; display: inline-block; margin-bottom: 15px;">[NAMA_KURSUS]</span>
                    <br><br>
                    <span style="border-bottom: 2px solid #000; padding-bottom: 2px;">Tindakan ini akan menghapus semua materi terkait,<br>statistik, dan riwayat akses siswa.</span>
                </p>
                <div style="display: flex; gap: 20px; justify-content: center;">
                    <button id="confirm-yes"
                        style="flex: 1; background: #e11d48; color: #fff; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px #000; transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px #000';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px #000';">
                        KONFIRMASI HAPUS
                    </button>
                    <button onclick="closeConfirmModal()"
                        style="flex: 1; background: #000; color: #fff; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px var(--accent-primary); transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px var(--accent-primary)';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px var(--accent-primary)';">
                        BATALKAN AKSI
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentForm = null;

        function triggerDelete(formId, courseTitle) {
            currentForm = document.getElementById(formId);
            document.getElementById('course-name').innerText = courseTitle;
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
            if (currentForm) currentForm.submit();
        });
    </script>
@endsection
