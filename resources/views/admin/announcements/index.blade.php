@extends('layouts.app')

@section('content')
    <style>
        .broadcast-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 35px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .broadcast-title-wrapper {
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

        .admin-panel {
            background: #fff;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px #000;
        }

        .admin-panel-header {
            padding: 20px 25px;
            border-bottom: 3px solid #000;
            background: #f8fafc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sq-input {
            width: 100%;
            padding: 12px;
            border: 2px solid #000;
            font-size: 13px;
            font-weight: 800;
            outline: none;
            background: #fff;
            color: #000;
            transition: all 0.2s ease;
            box-shadow: inset 2px 2px 0px 0px rgba(0, 0, 0, 0.05);
            font-family: inherit;
        }

        .sq-input:focus {
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            transform: translate(-2px, -2px);
        }

        .sq-label {
            display: block;
            font-size: 11px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .sq-select {
            width: 100%;
            padding: 12px;
            border: 2px solid #000;
            font-size: 12px;
            font-weight: 900;
            outline: none;
            background: #fff;
            color: #000;
            transition: all 0.2s ease;
            box-shadow: inset 2px 2px 0px 0px rgba(0, 0, 0, 0.05);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 12px;
            padding-right: 40px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .sq-select:focus {
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            transform: translate(-2px, -2px);
        }

        .sq-select option {
            font-weight: 900;
        }

        /* Signal types for dropdown */
        .sq-select option[value="info"] {
            color: #3b82f6;
        }

        .sq-select option[value="critical"] {
            color: #ef4444;
        }

        .sq-select option[value="warning"] {
            color: #d97706;
        }

        .sq-select option[value="success"] {
            color: #10b981;
        }

        .btn-sq-primary {
            background: var(--accent-primary);
            color: #fff;
            border: 3px solid #000;
            padding: 15px 25px;
            border-radius: 0;
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 6px 6px 0px 0px #000;
            width: 100%;
        }

        .btn-sq-primary:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000;
            color: #fff;
        }

        .btn-sq-primary:active {
            transform: translate(3px, 3px);
            box-shadow: 0px 0px 0px 0px #000;
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

        .log-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .log-table th {
            padding: 15px 20px;
            font-size: 11px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 3px solid #000;
            background: #f8fafc;
            border-right: 2px solid #000;
            text-align: left;
        }

        .log-table th:last-child {
            border-right: none;
        }

        .log-table td {
            padding: 20px 20px;
            border-bottom: 2px solid #000;
            border-right: 2px solid #000;
            background: #fff;
            transition: all 0.2s ease;
        }

        .log-table td:last-child {
            border-right: none;
        }

        .log-table tr:hover td {
            background: #f8fafc;
        }

        .log-table tr:last-child td {
            border-bottom: none;
        }

        .signal-indicator {
            width: 12px;
            height: 12px;
            border: 2px solid #000;
            display: inline-block;
        }

        .signal-indicator.active {
            background: #10b981;
            box-shadow: 0 0 8px #10b981;
        }

        .signal-indicator.offline {
            background: #cbd5e1;
            box-shadow: none;
        }
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1300px; margin: 0 auto; padding: 40px 5%;">

            <div class="broadcast-header">
                <div>
                    <div class="broadcast-title-wrapper">
                        <i class="fa-solid fa-tower-cell" style="color: var(--accent-primary); font-size: 18px;"></i>
                        <h2
                            style="font-size: 18px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">
                            Sistem Pengumuman Strategis</h2>
                    </div>
                    <p
                        style="color: #000; font-size: 14px; margin: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                        Siarkan pengumuman global berprioritas tinggi dan pembaruan operasional.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn-sq-outline">
                    <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Dasbor Admin
                </a>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 15px 20px; margin-bottom: 30px; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 5px 5px 0px 0px #10b981; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i> {{ session('success') }}
                </div>
            @endif

            <div style="display: grid; grid-template-columns: minmax(350px, 400px) 1fr; gap: 40px; align-items: start;">
                <!-- Deploy Form -->
                <div class="admin-panel">
                    <div class="admin-panel-header">
                        <h3
                            style="font-size: 14px; font-weight: 900; text-transform: uppercase; color: #000; margin: 0; display: flex; align-items: center; gap: 10px; letter-spacing: 1px;">
                            <i class="fa-solid fa-satellite" style="color: var(--accent-primary);"></i> Buat Pengumuman
                        </h3>
                    </div>
                    <div style="padding: 25px;">
                        <form action="{{ route('admin.announcements.store') }}" method="POST">
                            @csrf
                            <div style="margin-bottom: 20px;">
                                <label class="sq-label">Judul Pengumuman</label>
                                <input type="text" name="title" required placeholder="Cth. JADWAL PEMELIHARAAN SISTEM"
                                    class="sq-input">
                            </div>

                            <div style="margin-bottom: 20px;">
                                <label class="sq-label">Target Penerima</label>
                                <select name="target_role" required class="sq-select">
                                    <option value="all">Global (Semua Pengguna)</option>
                                    <option value="student">Hanya Siswa</option>
                                    <option value="instructor">Hanya Instruktur</option>
                                    <option value="admin">Hanya Admin</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 20px;">
                                <label class="sq-label">Tingkat Kepentingan</label>
                                <select name="type" required class="sq-select">
                                    <option value="info" style="color: #3b82f6;">Biru: Informasi</option>
                                    <option value="critical" style="color: #ef4444;">Merah: Kritis / Penting</option>
                                    <option value="warning" style="color: #d97706;">Kuning: Peringatan</option>
                                    <option value="success" style="color: #10b981;">Hijau: Operasional / Sukses</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 25px;">
                                <label class="sq-label">Isi Pesan</label>
                                <textarea name="message" rows="5" required placeholder="Tuliskan detail pembaruan operasional..." class="sq-input"
                                    style="resize: vertical; min-height: 100px; line-height: 1.5;"></textarea>
                            </div>

                            <div
                                style="margin-bottom: 30px; background: #f8fafc; padding: 20px; border: 2px dashed #000; display: flex; flex-direction: column; gap: 15px;">
                                <div>
                                    <label class="sq-label" style="font-size: 10px; display: flex; align-items: center; gap: 6px;">
                                        <i class="fa-regular fa-clock" style="color: var(--accent-primary);"></i> TANGGAL MULAI SIARAN
                                    </label>
                                    <input type="datetime-local" name="starts_at" class="sq-input"
                                        style="padding: 10px; font-size: 13px;">
                                </div>
                                <div>
                                    <label class="sq-label" style="font-size: 10px; display: flex; align-items: center; gap: 6px;">
                                        <i class="fa-solid fa-power-off" style="color: #ef4444;"></i> TANGGAL BERAKHIR SIARAN
                                    </label>
                                    <input type="datetime-local" name="ends_at" class="sq-input"
                                        style="padding: 10px; font-size: 13px;">
                                </div>
                            </div>

                            <button type="submit" class="btn-sq-primary">
                                <i class="fa-solid fa-satellite-dish" style="margin-right: 12px; font-size: 18px;"></i>
                                SIARKAN PENGUMUMAN
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Active Logs -->
                <div class="admin-panel">
                    <div class="admin-panel-header">
                        <h3
                            style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: #000; margin: 0; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-clipboard-list" style="color: var(--accent-primary);"></i> Riwayat Siaran
                        </h3>
                        <div
                            style="font-size: 12px; font-weight: 900; color: #fff; background: #000; padding: 4px 10px; border: 2px solid #000; display: inline-flex; align-items: center; box-shadow: 3px 3px 0px 0px var(--accent-primary);">
                            INDEKS: {{ str_pad($announcements->total(), 3, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="log-table">
                            <thead>
                                <tr>
                                    <th>Judul Pengumuman</th>
                                    <th>Target Penerima</th>
                                    <th>Status</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($announcements as $ann)
                                    <tr>
                                        <td>
                                            <div style="display: flex; gap: 15px;">
                                                <div
                                                    style="font-size: 24px; color: {{ $ann->type === 'critical'
                                                        ? '#ef4444'
                                                        : ($ann->type === 'warning'
                                                            ? '#d97706'
                                                            : ($ann->type === 'success'
                                                                ? '#10b981'
                                                                : '#3b82f6')) }};">
                                                    <i class="fa-solid fa-bullhorn"></i>
                                                </div>
                                                <div>
                                                    <div
                                                        style="font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase; margin-bottom: 4px;">
                                                        {{ $ann->title }}</div>
                                                    <div
                                                        style="font-size: 12px; color: #475569; max-width: 250px; font-weight: 600; line-height: 1.4; margin-bottom: 8px;">
                                                        {{ \Illuminate\Support\Str::limit($ann->message, 80) }}</div>
                                                    <div
                                                        style="font-size: 10px; color: #000; font-weight: 800; background: #f1f5f9; padding: 2px 6px; display: inline-block; border: 1px solid #cbd5e1; text-transform: uppercase;">
                                                        OP: {{ $ann->user->name }} <span style="margin: 0 4px;">|</span>
                                                        {{ $ann->created_at->format('d M, H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                style="font-size: 10px; font-weight: 900; color: #000; border: 2px solid #000; padding: 4px 8px; text-transform: uppercase; display: inline-block; box-shadow: 2px 2px 0px 0px #000; background: #fff;">
                                                <i class="fa-solid fa-crosshairs"
                                                    style="margin-right: 4px; color: var(--accent-primary);"></i>
                                                {{ $ann->target_role }}
                                            </span>
                                        </td>
                                        <td>
                                            <div
                                                style="display: flex; align-items: center; gap: 10px; background: #f8fafc; padding: 6px 10px; border: 2px solid #000; display: inline-flex;">
                                                <div
                                                    class="signal-indicator {{ $ann->is_active ? 'active' : 'offline' }}">
                                                </div>
                                                <span
                                                    style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase;">
                                                    {{ $ann->is_active ? 'SIARAN: AKTIF' : 'SIARAN: MATI' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td style="text-align: right;">
                                            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                                <form action="{{ route('admin.announcements.toggle', $ann->id) }}"
                                                    method="POST" style="margin: 0;">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn-sq-slate" title="Ubah Status">
                                                        <i class="fa-solid {{ $ann->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"
                                                            style="font-size: 14px;"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.announcements.destroy', $ann->id) }}"
                                                    method="POST" style="margin: 0;"
                                                    id="delete-form-{{ $ann->id }}">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn-sq-danger"
                                                        onclick="triggerDelete('delete-form-{{ $ann->id }}', '{{ addslashes($ann->title) }}')"
                                                        title="Hapus Pengumuman">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="padding: 60px 20px; text-align: center;">
                                            <div
                                                style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
                                                <div
                                                    style="width: 80px; height: 80px; border: 3px solid #000; display: flex; align-items: center; justify-content: center; font-size: 32px; color: #cbd5e1; background: #f8fafc; box-shadow: 6px 6px 0px 0px #000;">
                                                    <i class="fa-solid fa-walkie-talkie"></i>
                                                </div>
                                                <h3
                                                    style="font-size: 16px; font-weight: 900; color: #000; margin: 0; text-transform: uppercase;">
                                                    Data Kosong</h3>
                                                <p
                                                    style="color: #64748b; font-size: 13px; font-weight: 800; margin: 0; text-transform: uppercase;">
                                                    Tidak ada pengumuman yang tercatat.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($announcements->hasPages())
                        <div
                            style="padding: 20px 25px; border-top: 3px solid #000; background: #fff; display: flex; justify-content: center;">
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
                            {{ $announcements->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Confirmation Modal (Broadcast Wipe) -->
    <div id="confirm-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(8px); z-index: 1200; justify-content: center; align-items: flex-start; padding-top: 50px;">
        <div id="confirm-card"
            style="background: #fff; width: 500px; max-width: 90%; border: 4px solid #000; box-shadow: 15px 15px 0px rgba(0,0,0,1); transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 40px; text-align: center;">
                <div
                    style="width: 80px; height: 80px; background: #fff; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px; border: 3px solid #000; box-shadow: 6px 6px 0px 0px #e11d48; color: #e11d48; position: relative;">
                    <i class="fa-solid fa-satellite-dish" style="opacity: 0.15; position: absolute; font-size: 50px;"></i>
                    <i class="fa-solid fa-xmark" style="position: relative;"></i>
                </div>
                <h3
                    style="font-size: 20px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; color: #000; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 15px;">
                    Hapus Pengumuman
                </h3>
                <p
                    style="font-size: 14px; color: #000; font-weight: 700; line-height: 1.6; margin-bottom: 35px; text-transform: uppercase;">
                    HENTIKAN siaran untuk <br><br> <span id="broadcast-name"
                        style="background: #e11d48; color: #fff; padding: 4px 10px; font-weight: 900; border: 2px solid #000; display: inline-block; margin-bottom: 15px;">[TITLE]</span>
                    <br><br>
                    <span style="border-bottom: 2px solid #000; padding-bottom: 2px;">Pengumuman akan dihapus secara permanen <br>dari semua terminal penerima.</span>
                </p>
                <div style="display: flex; gap: 20px; justify-content: center;">
                    <button id="confirm-yes"
                        style="flex: 1; background: #e11d48; color: #fff; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px #000; transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px #000';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px #000';">
                        HAPUS SIARAN
                    </button>
                    <button onclick="closeConfirmModal()"
                        style="flex: 1; background: #000; color: #fff; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px var(--accent-primary); transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px var(--accent-primary)';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px var(--accent-primary)';">
                        BATALKAN
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentForm = null;

        function triggerDelete(formId, broadcastTitle) {
            currentForm = document.getElementById(formId);
            document.getElementById('broadcast-name').innerText = broadcastTitle;
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

        // Dynamic media queries adjustment through JS since @media blocks might interfere with some nested views
        document.addEventListener('DOMContentLoaded', function() {
            const handleResize = () => {
                const gridContainer = document.querySelector('[style*="grid-template-columns"]');
                if (window.innerWidth < 900) {
                    if (gridContainer) gridContainer.style.gridTemplateColumns = '1fr';
                } else {
                    if (gridContainer) gridContainer.style.gridTemplateColumns = 'minmax(350px, 400px) 1fr';
                }
            };

            window.addEventListener('resize', handleResize);
            handleResize(); // trigger once on load
        });
    </script>
@endsection
