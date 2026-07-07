@extends('layouts.app')

@section('content')
    <style>
        .queue-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 35px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .queue-title-wrapper {
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

        .queue-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .queue-table th {
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

        .queue-table th:last-child {
            border-right: none;
        }

        .queue-table td {
            padding: 20px 25px;
            border-bottom: 2px solid #000;
            border-right: 2px solid #000;
            background: #fff;
            transition: all 0.2s ease;
        }

        .queue-table td:last-child {
            border-right: none;
        }

        .queue-table tr:hover td {
            background: #fdf6e3;
            /* Light yellow hover explicitly for queue */
        }

        .queue-table tr:last-child td {
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

        .btn-sq-slate {
            background: #000;
            color: #fff;
            border: 2px solid #000;
            padding: 8px 15px;
            border-radius: 0;
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            box-shadow: 3px 3px 0px 0px var(--accent-primary);
            text-decoration: none;
        }

        .btn-sq-slate:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0px 0px var(--accent-primary);
        }

        .btn-sq-slate:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px var(--accent-primary);
        }

        .btn-sq-success {
            background: #fff;
            color: #10b981;
            border: 2px solid #000;
            padding: 8px 15px;
            border-radius: 0;
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            box-shadow: 3px 3px 0px 0px #10b981;
            text-decoration: none;
        }

        .btn-sq-success:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0px 0px #10b981;
            color: #fff;
            background: #10b981;
        }

        .btn-sq-success:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #10b981;
            background: #10b981;
            color: #fff;
        }

        .btn-sq-danger {
            background: #fff;
            color: #e11d48;
            border: 2px solid #000;
            padding: 8px 15px;
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

            <div class="queue-header">
                <div>
                    <div class="queue-title-wrapper">
                        <i class="fa-solid fa-clipboard-check" style="color: #f59e0b; font-size: 18px;"></i>
                        <h2
                            style="font-size: 18px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">
                            Antrean Verifikasi</h2>
                    </div>
                    <p
                        style="color: #000; font-size: 14px; margin: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                        Audit materi kursus yang masuk untuk kepatuhan kualitas dan kebijakan.</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('admin.courses') }}" class="btn-sq-outline">
                        <i class="fa-solid fa-boxes-stacked" style="margin-right: 8px;"></i> Pangkalan Data
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 15px 20px; margin-bottom: 30px; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 5px 5px 0px 0px #10b981; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i> {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <table class="queue-table">
                    <thead>
                        <tr>
                            <th>Identitas Kursus</th>
                            <th>Keaslian Penulis</th>
                            <th>Tanggal Pengajuan</th>
                            <th style="text-align: right;">Opsi Keputusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <div style="position: relative;">
                                            <img src="{{ $course->thumbnail }}"
                                                style="width: 80px; height: 50px; object-fit: cover; border: 2px solid #000; box-shadow: 3px 3px 0px 0px #000;">
                                        </div>
                                        <div>
                                            <div
                                                style="font-size: 15px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                                                <a href="{{ route('courses.show', $course->slug) }}" target="_blank"
                                                    class="asset-link">
                                                    {{ $course->title }}
                                                </a>
                                            </div>
                                            <div
                                                style="font-size: 11px; font-weight: 900; color: #000; display: inline-flex; align-items: center; gap: 8px; background: #e2e8f0; border: 1px solid #000; padding: 2px 6px;">
                                                HARGA: <span
                                                    style="color: #fff; background: #10b981; padding: 2px 6px; border: 1px solid #000;">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div
                                        style="font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase; margin-bottom: 4px;">
                                        {{ $course->user->name ?? 'OPERATOR TIDAK DIKENAL' }}</div>
                                    <div
                                        style="font-size: 11px; color: #475569; font-weight: 700; background: #f8fafc; border: 1px dashed #000; padding: 2px 6px; display: inline-block;">
                                        ID: {{ $course->user->email ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <div
                                        style="font-size: 13px; font-weight: 900; color: #000; text-transform: uppercase; margin-bottom: 2px;">
                                        {{ $course->created_at->format('d M Y') }}
                                    </div>
                                    <div
                                        style="font-size: 10px; font-weight: 800; color: #000; display: inline-block; border-bottom: 2px solid var(--accent-primary);">
                                        {{ $course->created_at->format('H:i') }} UTC
                                    </div>
                                </td>
                                <td style="text-align: right;">
                                    <div style="display: flex; justify-content: flex-end; gap: 10px; flex-wrap: wrap;">
                                        <a href="{{ route('courses.show', $course->slug) }}" target="_blank"
                                            class="btn-sq-slate">
                                            <i class="fa-solid fa-eye" style="margin-right: 6px;"></i> AUDIT MATERI
                                        </a>

                                        <form action="{{ route('admin.courses.updateStatus', $course->id) }}"
                                            method="POST" style="margin: 0;">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="published">
                                            <button type="submit" class="btn-sq-success">
                                                <i class="fa-solid fa-check" style="margin-right: 6px;"></i> SETUJUI
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.courses.updateStatus', $course->id) }}"
                                            method="POST" style="margin: 0;">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn-sq-danger">
                                                <i class="fa-solid fa-xmark" style="margin-right: 6px;"></i> TOLAK
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
                                            style="width: 80px; height: 80px; border: 3px solid #000; display: flex; align-items: center; justify-content: center; font-size: 32px; color: #f59e0b; background: #fffbeb; box-shadow: 6px 6px 0px 0px #000;">
                                            <i class="fa-solid fa-check-double"></i>
                                        </div>
                                        <h3
                                            style="font-size: 16px; font-weight: 900; color: #000; margin: 0; text-transform: uppercase;">
                                            Antrean Kosong</h3>
                                        <p
                                            style="color: #64748b; font-size: 13px; font-weight: 800; margin: 0; text-transform: uppercase;">
                                            Antrean verifikasi bersih. Tidak ada materi yang menunggu.</p>
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
@endsection
