@extends('layouts.app')

@section('content')
    <style>
        .directory-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 35px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .directory-title-wrapper {
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

        .user-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .user-table th {
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

        .user-table th:last-child {
            border-right: none;
        }

        .user-table td {
            padding: 20px 25px;
            border-bottom: 2px solid #000;
            border-right: 2px solid #000;
            background: #fff;
            transition: all 0.2s ease;
        }

        .user-table td:last-child {
            border-right: none;
        }

        .user-table tr:hover td {
            background: #f8fafc;
        }

        .user-table tr:last-child td {
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

        .btn-sq-warning {
            background: #fff;
            color: #d97706;
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
            box-shadow: 3px 3px 0px 0px #d97706;
            text-decoration: none;
        }

        .btn-sq-warning:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0px 0px #d97706;
            color: #fff;
            background: #d97706;
        }

        .btn-sq-warning:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #d97706;
            background: #d97706;
            color: #fff;
        }

        .btn-sq-info {
            background: #fff;
            color: #2563eb;
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
            box-shadow: 3px 3px 0px 0px #2563eb;
            text-decoration: none;
        }

        .btn-sq-info:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0px 0px #2563eb;
            color: #fff;
            background: #2563eb;
        }

        .btn-sq-info:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #2563eb;
            background: #2563eb;
            color: #fff;
        }

        .modal-input {
            width: 100%;
            padding: 12px 15px;
            background: #f8fafc;
            border: 3px solid #000;
            font-family: inherit;
            font-weight: 800;
            font-size: 14px;
            color: #000;
            outline: none;
            box-shadow: inset 4px 4px 0px #e2e8f0;
            transition: all 0.2s;
        }

        .modal-input:focus {
            background: #fff;
            border-color: var(--accent-primary);
            box-shadow: 4px 4px 0px 0px #000;
        }

        .role-select {
            padding: 8px 12px;
            border: 2px solid #000;
            border-radius: 0;
            font-size: 12px;
            background: #fff;
            color: #000;
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

        .role-select:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px 0px #000;
        }

        .role-select:focus {
            outline: none;
            background-color: #f8fafc;
        }
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 40px 5%;">

            <div class="directory-header">
                <div>
                    <div class="directory-title-wrapper">
                        <i class="fa-solid fa-address-book" style="color: var(--accent-primary); font-size: 18px;"></i>
                        <h2
                            style="font-size: 18px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">
                            Direktori Pengguna</h2>
                    </div>
                    <p
                        style="color: #000; font-size: 14px; margin: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                        Kontrol akses sistem dan pemantauan aktivitas pengguna.</p>
                </div>
                <div style="display: flex; gap: 15px;">
                    <a href="{{ route('admin.dashboard') }}" class="btn-sq-outline">
                        <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Kembali
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
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>Identitas</th>
                            <th>Metrik Aktivitas</th>
                            <th>Hak Akses</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <div
                                            style="width: 45px; height: 45px; background: #000; display: flex; align-items: center; justify-content: center; font-weight: 900; color: #fff; font-size: 18px; border: 2px solid #000; box-shadow: 3px 3px 0px 0px var(--accent-primary); text-transform: uppercase;">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div
                                                style="font-size: 15px; font-weight: 900; color: #000; line-height: 1.2; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                                                {{ $user->name }}</div>
                                            <div style="font-size: 12px; color: #475569; font-weight: 700;">
                                                {{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        style="font-size: 14px; color: #000; font-weight: 900; display: inline-flex; align-items: center; gap: 8px; background: #f8fafc; padding: 6px 12px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #000; text-transform: uppercase;">
                                        <i class="fa-solid fa-chart-line" style="color: var(--accent-primary);"></i>
                                        {{ $user->metrics ?? '0 XP' }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST"
                                        style="margin: 0;">
                                        @csrf @method('PUT')
                                        <select name="role" onchange="this.form.submit()" class="role-select">
                                            <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>
                                                Siswa</option>
                                            <option value="instructor" {{ $user->role === 'instructor' ? 'selected' : '' }}>
                                                Instruktur</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                        <button type="button" class="btn-sq-info"
                                            onclick="triggerEdit({{ $user->id }})" title="Ubah Identitas">
                                            <i class="fa-solid fa-pen-to-square" style="margin-right: 6px;"></i> EDIT
                                        </button>

                                        @if ($user->role === 'instructor')
                                            <form action="{{ route('admin.users.purgeLedger', $user->id) }}" method="POST"
                                                style="margin: 0;" id="purge-form-{{ $user->id }}">
                                                @csrf
                                                <button type="button" class="btn-sq-warning"
                                                    onclick="triggerPurge('purge-form-{{ $user->id }}', '{{ addslashes($user->name) }}')"
                                                    title="Hapus Saldo Keuangan">
                                                    <i class="fa-solid fa-bolt" style="margin-right: 6px;"></i> HAPUS SALDO
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            style="margin: 0;" id="delete-form-{{ $user->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn-sq-danger"
                                                onclick="triggerDelete('delete-form-{{ $user->id }}', '{{ addslashes($user->name) }}')"
                                                title="Hapus Akun Pengguna">
                                                <i class="fa-solid fa-user-slash" style="margin-right: 6px;"></i> HAPUS AKUN
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>

    </div>

    <!-- Custom Confirmation Modal (Sensitive Ops) -->
    <div id="confirm-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(8px); z-index: 1200; justify-content: center; align-items: flex-start; padding-top: 50px;">
        <div id="confirm-card"
            style="background: #fff; width: 500px; max-width: 90%; border: 4px solid #000; box-shadow: 15px 15px 0px rgba(0,0,0,1); transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 40px; text-align: center;">
                <div id="modal-icon-container"
                    style="width: 80px; height: 80px; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px; border: 3px solid #000; box-shadow: 6px 6px 0px 0px #000; background: #fff;">
                    <i id="modal-icon" class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h3 id="modal-title"
                    style="font-size: 20px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; color: #000; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 15px;">
                    Tindakan Kritis
                </h3>
                <p id="modal-message"
                    style="font-size: 14px; color: #000; font-weight: 700; line-height: 1.6; margin-bottom: 35px; text-transform: uppercase;">
                    Apakah Anda yakin?
                </p>
                <div style="display: flex; gap: 20px; justify-content: center;">
                    <button id="confirm-yes"
                        style="flex: 1; background: #e11d48; color: #fff; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px #000; transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px #000';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px #000';">
                        KONFIRMASI
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

    <!-- Edit User Modal -->
    <div id="edit-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(10px); z-index: 1300; justify-content: center; align-items: center; padding: 20px;">
        <div id="edit-card"
            style="background: #fff; width: 600px; max-width: 100%; border: 5px solid #000; box-shadow: 20px 20px 0px var(--accent-primary); transform: scale(0.9); opacity: 0; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div
                style="background: #000; padding: 20px 30px; display: flex; justify-content: space-between; align-items: center;">
                <h3
                    style="color: #fff; font-size: 16px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; margin: 0;">
                    <i class="fa-solid fa-user-pen" style="color: var(--accent-primary); margin-right: 12px;"></i> Ubah Identitas
                </h3>
                <button onclick="closeEditModal()"
                    style="background: none; border: none; color: #fff; font-size: 20px; cursor: pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="edit-user-form" method="POST" style="padding: 40px;">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 25px;">
                    <label
                        style="display: block; font-size: 12px; font-weight: 900; text-transform: uppercase; margin-bottom: 10px;">Nama Lengkap</label>
                    <input type="text" name="name" id="edit-name" class="modal-input" required>
                </div>

                <div style="margin-bottom: 35px;">
                    <label
                        style="display: block; font-size: 12px; font-weight: 900; text-transform: uppercase; margin-bottom: 10px;">Alamat Email</label>
                    <input type="email" name="email" id="edit-email" class="modal-input" required>
                </div>

                <div style="display: flex; gap: 20px;">
                    <button type="submit"
                        style="flex: 2; background: var(--accent-primary); color: #fff; border: 3px solid #000; padding: 18px; font-size: 14px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px #000; transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px #000';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px #000';">
                        SIMPAN PERUBAHAN <i class="fa-solid fa-upload" style="margin-left: 8px;"></i>
                    </button>
                    <button type="button" onclick="closeEditModal()"
                        style="flex: 1; background: #fff; color: #000; border: 3px solid #000; padding: 18px; font-size: 14px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px #cbd5e1; transition: all 0.2s ease;">
                        BATAL
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentForm = null;

        function openModal(modalId, cardId) {
            const modal = document.getElementById(modalId);
            const card = document.getElementById(cardId);
            modal.style.display = 'flex';
            setTimeout(() => {
                if (cardId === 'confirm-card') {
                    card.style.transform = 'translateY(0)';
                } else {
                    card.style.transform = 'scale(1)';
                }
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

        function triggerEdit(userId) {
            // Fetch user data via AJAX
            fetch(`/admin/users/${userId}/edit`)
                .then(response => response.json())
                .then(user => {
                    document.getElementById('edit-name').value = user.name;
                    document.getElementById('edit-email').value = user.email;
                    document.getElementById('edit-user-form').action = `/admin/users/${userId}`;
                    openModal('edit-modal', 'edit-card');
                });
        }

        function closeEditModal() {
            const card = document.getElementById('edit-card');
            const modal = document.getElementById('edit-modal');
            card.style.transform = 'scale(0.9)';
            card.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        function triggerPurge(formId, userName) {
            currentForm = document.getElementById(formId);
            document.getElementById('modal-title').innerText = "Hapus Saldo Keuangan";
            document.getElementById('modal-message').innerHTML =
                `Apakah Anda yakin ingin MENGHAPUS sepenuhnya saldo keuangan untuk pengguna <span style="background: #e11d48; color: #fff; padding: 2px 6px; font-weight: 900;">${userName}</span>?<br><br>Semua riwayat transaksi dan pendapatan akan dihapus. <br><br> <span style="border-bottom: 2px solid #000; padding-bottom: 2px;">TINDAKAN INI TIDAK DAPAT DIBATALKAN.</span>`;
            document.getElementById('modal-icon').className = "fa-solid fa-bolt-lightning";
            document.getElementById('modal-icon-container').style.background = "#fff";
            document.getElementById('modal-icon-container').style.color = "#d97706";
            openModal('confirm-modal', 'confirm-card');
        }

        function triggerDelete(formId, userName) {
            currentForm = document.getElementById(formId);
            document.getElementById('modal-title').innerText = "Penghapusan Akun";
            document.getElementById('modal-message').innerHTML =
                `Apakah Anda yakin ingin MENGHAPUS secara permanen pengguna <span style="background: #e11d48; color: #fff; padding: 2px 6px; font-weight: 900;">${userName}</span>?<br><br>Semua catatan terkait dan akses sistem akan dihentikan segera.`;
            document.getElementById('modal-icon').className = "fa-solid fa-user-slash";
            document.getElementById('modal-icon-container').style.background = "#000";
            document.getElementById('modal-icon-container').style.color = "#fff";
            openModal('confirm-modal', 'confirm-card');
        }

        document.getElementById('confirm-yes').addEventListener('click', function() {
            if (currentForm) currentForm.submit();
        });
    </script>
@endsection
