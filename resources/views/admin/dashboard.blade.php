@extends('layouts.app')

@section('content')
    <style>
        .admin-stat-card {
            background: #fff;
            border: 3px solid #000;
            padding: 30px;
            position: relative;
            box-shadow: 8px 8px 0px 0px #000;
            transition: all 0.2s ease;
        }

        .admin-stat-card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 11px 11px 0px 0px var(--accent-primary);
        }

        .admin-stat-icon {
            width: 50px;
            height: 50px;
            border: 2px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 3px 3px 0px 0px #000;
        }

        .admin-panel {
            background: #fff;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px #000;
        }

        .admin-panel-header {
            padding: 20px 25px;
            border-bottom: 3px solid #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
        }

        .btn-sq-danger {
            background: #ef4444;
            color: #fff;
            border: 2px solid #000;
            padding: 15px 25px;
            font-size: 13px;
            font-weight: 900;
            transition: all 0.2s ease;
            cursor: pointer;
            box-shadow: 5px 5px 0px 0px #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
        }

        .btn-sq-danger:hover {
            transform: translate(-2px, -2px);
            box-shadow: 7px 7px 0px 0px #000;
            background: #dc2626;
        }

        .btn-sq-danger:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        .btn-sq-slate {
            background: #000;
            color: #fff;
            border: 2px solid #000;
            padding: 15px 25px;
            font-size: 13px;
            font-weight: 900;
            transition: all 0.2s ease;
            cursor: pointer;
            box-shadow: 5px 5px 0px 0px var(--accent-primary);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-sq-slate:hover {
            transform: translate(-2px, -2px);
            box-shadow: 7px 7px 0px 0px var(--accent-primary);
        }

        .btn-sq-slate:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px var(--accent-primary);
        }

        .btn-sq-mini {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            padding: 6px 12px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            box-shadow: 3px 3px 0px 0px #000;
            transition: all 0.2s ease;
        }

        .btn-sq-mini:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px 0px #000;
            background: var(--accent-primary);
            color: #fff;
        }

        .btn-sq-mini:active {
            transform: translate(1px, 1px);
            box-shadow: 0px 0px 0px 0px #000;
        }
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 40px 5%;">

            <div
                style="margin-bottom: 40px; border-bottom: 3px solid #000; padding-bottom: 20px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 20px;">
                <div>
                    <div
                        style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; background: #000; padding: 6px 15px; border: 2px solid #000; box-shadow: 4px 4px 0px 0px var(--accent-primary); display: inline-flex;">
                        <i class="fa-solid fa-tower-observation" style="color: var(--accent-primary); font-size: 16px;"></i>
                        <h2
                            style="font-size: 14px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">
                            Pusat Kontrol Admin</h2>
                    </div>
                    <p
                        style="color: #000; font-size: 18px; margin: 0; font-weight: 900; text-transform: uppercase; letter-spacing: -0.5px; margin-top: 15px;">
                        Ringkasan platform dan statistik sistem real-time.</p>
                </div>
            </div>

            <!-- Metric Cards -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 50px;">
                <div class="admin-stat-card">
                    <div
                        style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 25px;">
                        <div>
                            <div
                                style="color: #000; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; background: #e2e8f0; display: inline-block; padding: 4px 8px; border: 2px solid #000;">
                                Populasi Pengguna</div>
                            <div
                                style="font-size: 42px; font-weight: 900; color: #000; line-height: 1; letter-spacing: -1px;">
                                {{ number_format($totalUsers) }}</div>
                        </div>
                        <div class="admin-stat-icon" style="background: #eef2ff; color: #4338ca;">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <div style="display: flex; gap: 15px; border-top: 2px dashed #cbd5e1; padding-top: 15px;">
                        <div style="font-size: 12px; font-weight: 800; color: #000; text-transform: uppercase;">
                            <span style="color: var(--accent-primary); font-size: 14px; margin-right: 4px;">■</span>
                            {{ $totalStudents }} Siswa
                        </div>
                        <div style="font-size: 12px; font-weight: 800; color: #000; text-transform: uppercase;">
                            <span style="color: #3b82f6; font-size: 14px; margin-right: 4px;">■</span>
                            {{ $totalInstructors }} Pengajar
                        </div>
                    </div>
                </div>

                <div class="admin-stat-card">
                    <div
                        style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 25px;">
                        <div>
                            <div
                                style="color: #000; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; background: #e2e8f0; display: inline-block; padding: 4px 8px; border: 2px solid #000;">
                                Registrasi Kursus</div>
                            <div
                                style="font-size: 42px; font-weight: 900; color: #000; line-height: 1; letter-spacing: -1px;">
                                {{ number_format($totalCourses) }}</div>
                        </div>
                        <div class="admin-stat-icon" style="background: #ecfdf5; color: #10b981;">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                    </div>
                    <div
                        style="font-size: 12px; font-weight: 800; color: #000; border-top: 2px dashed #cbd5e1; padding-top: 15px; text-transform: uppercase;">
                        Katalog kursus aktif di seluruh platform
                    </div>
                </div>

                <div class="admin-stat-card">
                    <div
                        style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 25px;">
                        <div>
                            <div
                                style="color: #000; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; background: #e2e8f0; display: inline-block; padding: 4px 8px; border: 2px solid #000;">
                                Sirkulasi Bruto</div>
                            <div
                                style="font-size: 42px; font-weight: 900; color: #000; line-height: 1; letter-spacing: -1px; display: flex; align-items: baseline; gap: 6px;">
                                <span style="font-size: 20px; color: #94a3b8; font-weight: 800;">Rp</span>
                                {{ number_format($totalRevenue, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="admin-stat-icon" style="background: #fffbeb; color: #f59e0b;">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                    </div>
                    <div
                        style="font-size: 12px; font-weight: 800; color: #000; border-top: 2px dashed #cbd5e1; padding-top: 15px; text-transform: uppercase;">
                        Pendapatan platform & arus historis
                    </div>
                </div>

                <div class="admin-stat-card">
                    <div
                        style="display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 25px;">
                        <div>
                            <div
                                style="color: #000; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; background: #fffbeb; display: inline-block; padding: 4px 8px; border: 2px solid #000;">
                                Pembayaran Tertunda</div>
                            <div
                                style="font-size: 42px; font-weight: 900; color: {{ $pendingPayments > 0 ? '#f59e0b' : '#000' }}; line-height: 1; letter-spacing: -1px;">
                                {{ number_format($pendingPayments) }}</div>
                        </div>
                        <div class="admin-stat-icon" style="background: #fffbeb; color: #f59e0b;">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                    </div>
                    <div style="border-top: 2px dashed #cbd5e1; padding-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-size: 12px; font-weight: 800; color: #000; text-transform: uppercase;">
                            Butuh Verifikasi Segera
                        </div>
                        <a href="{{ route('admin.payments') }}" class="btn-sq-mini" style="margin: 0; background: #000; color: #fff;">Review</a>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); gap: 40px;">
                <!-- Recent Users -->
                <div class="admin-panel">
                    <div class="admin-panel-header">
                        <h3
                            style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; color: #000; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-user-plus" style="color: var(--accent-primary);"></i> Pendaftaran Terbaru
                        </h3>
                        <a href="{{ route('admin.users') }}" class="btn-sq-mini">Lihat Semua</a>
                    </div>
                    <div style="padding: 10px 25px 25px;">
                        @foreach ($recentUsers as $user)
                            <div
                                style="padding: 15px 0; border-bottom: 2px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; transition: all 0.2s ease;">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div
                                        style="width: 40px; height: 40px; background: #000; display: flex; align-items: center; justify-content: center; font-weight: 900; color: #fff; font-size: 16px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px var(--accent-primary);">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div
                                            style="font-size: 15px; font-weight: 900; color: #000; text-transform: uppercase;">
                                            {{ $user->name }}</div>
                                        <div
                                            style="font-size: 12px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-top: 4px;">
                                            <span
                                                style="color: #000; background: #f1f5f9; padding: 2px 6px; border: 1px solid #cbd5e1;">{{ $user->role }}</span>
                                            •
                                            {{ $user->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <i class="fa-solid fa-caret-right" style="font-size: 16px; color: #94a3b8;"></i>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Courses -->
                <div class="admin-panel">
                    <div class="admin-panel-header">
                        <h3
                            style="font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; color: #000; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-satellite-dish" style="color: var(--accent-primary);"></i> Aktivitas Ekosistem Terbaru
                        </h3>
                        <a href="{{ route('admin.courses') }}" class="btn-sq-mini">Daftar</a>
                    </div>
                    <div style="padding: 10px 25px 25px;">
                        @forelse($recentCourses as $course)
                            <div
                                style="padding: 15px 0; border-bottom: 2px solid #f1f5f9; display: flex; align-items: center; gap: 15px;">
                                <img src="{{ $course->thumbnail }}"
                                    style="width: 60px; height: 40px; object-fit: cover; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #000;">
                                <div style="flex: 1;">
                                    <div
                                        style="font-size: 14px; font-weight: 900; color: #000; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 250px; text-transform: uppercase;">
                                        {{ $course->title }}</div>
                                    <div
                                        style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-top: 4px;">
                                        PENGAJAR: {{ $course->user->name ?? 'TIDAK DIKETAHUI' }}</div>
                                </div>
                                <div
                                    style="font-size: 16px; font-weight: 900; color: #10b981; background: #ecfdf5; padding: 4px 8px; border: 2px solid #10b981;">
                                    Rp {{ number_format($course->price, 0, ',', '.') }}
                                </div>
                            </div>
                        @empty
                            <div style="padding: 60px 20px; text-align: center;">
                                <i class="fa-solid fa-server"
                                    style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px;"></i>
                                <p
                                    style="color: #64748b; font-size: 13px; font-weight: 800; text-transform: uppercase; margin: 0;">
                                    Belum ada aktivitas terbaru terdeteksi.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Strategic Governance Section -->
            <div
                style="margin-top: 50px; border: 4px solid #ef4444; background: #fff; padding: 40px; position: relative; box-shadow: 12px 12px 0px 0px rgba(239, 68, 68, 0.2);">
                <div
                    style="position: absolute; top: -15px; left: -15px; background: #ef4444; color: #fff; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 20px; border: 3px solid #000; box-shadow: 4px 4px 0px 0px #000;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>

                <div
                    style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 30px;">
                    <div style="flex: 1; min-width: 300px;">
                        <div
                            style="font-size: 12px; font-weight: 900; color: #fff; background: #ef4444; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px; display: inline-block; padding: 6px 12px; border: 2px solid #000;">
                            Pengambilalihan Infrastruktur Penting</div>
                        <h3
                            style="font-size: 28px; font-weight: 900; color: #000; margin: 0; text-transform: uppercase; letter-spacing: -1px;">
                            Manajemen Buku Kas Strategis</h3>
                        <p
                            style="color: #000; font-size: 14px; margin-top: 15px; font-weight: 800; border-left: 4px solid #ef4444; padding-left: 15px;">
                            Hanya personel yang berwenang. Tindakan ini akan <span onclick="openPurgeDetail()" style="color: #ef4444; text-decoration: underline; cursor: pointer; background: #fff1f2; padding: 0 4px;">menghapus secara permanen semua log keuangan</span> di seluruh ekosistem. <i class="fa-solid fa-circle-info" style="margin-left: 4px; font-size: 12px;"></i></p>
                    </div>
                    <form action="{{ route('admin.global.purgeLedger') }}" method="POST" id="global-purge-form"
                        style="margin: 0;">
                        @csrf
                        <button type="button" onclick="triggerGlobalPurge()" class="btn-sq-danger">
                            <i class="fa-solid fa-radiation" style="margin-right: 12px; font-size: 16px;"></i> INISIALISASI PENGHAPUSAN BUKU KAS GLOBAL
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Detail Explanation Modal -->
        <div id="purge-detail-modal"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(10px); z-index: 1300; justify-content: center; align-items: center; padding: 20px;">
            <div id="purge-detail-card"
                style="background: #fff; width: 700px; max-width: 100%; border: 5px solid #000; box-shadow: 20px 20px 0px #000; transform: scale(0.9); opacity: 0; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); position: relative; overflow: hidden;">
                
                <div style="background: #000; color: #fff; padding: 20px 30px; display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 16px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; margin: 0;">
                        <i class="fa-solid fa-book-dead" style="color: #ef4444; margin-right: 12px;"></i> Manifest Operasi Purge
                    </h3>
                    <button onclick="closePurgeDetail()" style="background: none; border: none; color: #fff; font-size: 20px; cursor: pointer;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div style="padding: 40px; max-height: 70vh; overflow-y: auto;">
                    <div style="background: #fff1f2; border: 2px solid #ef4444; padding: 20px; margin-bottom: 30px; display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 24px; color: #ef4444;"></i>
                        <div>
                            <div style="font-size: 14px; font-weight: 900; color: #ef4444; text-transform: uppercase; margin-bottom: 5px;">Peringatan Level Tinggi</div>
                            <p style="font-size: 13px; color: #000; font-weight: 700; line-height: 1.5; margin: 0;">Operasi ini akan melakukan reset total pada seluruh infrastruktur finansial platform. Data yang dihapus tidak dapat dipulihkan melalui prosedur standar.</p>
                        </div>
                    </div>

                    <h4 style="font-size: 14px; font-weight: 900; text-transform: uppercase; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px;">Dampak Penghapusan Detil:</h4>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                        <div style="background: #f8fafc; border: 2px solid #000; padding: 15px;">
                            <div style="font-weight: 900; font-size: 12px; margin-bottom: 10px; color: #ef4444;"><i class="fa-solid fa-user-xmark"></i> ENROLLMENT</div>
                            <p style="font-size: 12px; color: #475569; font-weight: 600; margin: 0;">Semua riwayat pembelian kursus akan dihapus. Siswa akan kehilangan akses ke kursus yang telah dibayar.</p>
                        </div>
                        <div style="background: #f8fafc; border: 2px solid #000; padding: 15px;">
                            <div style="font-weight: 900; font-size: 12px; margin-bottom: 10px; color: #ef4444;"><i class="fa-solid fa-money-bill-transfer"></i> PENDAPATAN</div>
                            <p style="font-size: 12px; color: #475569; font-weight: 600; margin: 0;">Saldo instruktur dan komisi platform akan di-reset ke nol. Riwayat bagi hasil akan musnah.</p>
                        </div>
                        <div style="background: #f8fafc; border: 2px solid #000; padding: 15px;">
                            <div style="font-weight: 900; font-size: 12px; margin-bottom: 10px; color: #ef4444;"><i class="fa-solid fa-receipt"></i> TRANSAKSI</div>
                            <p style="font-size: 12px; color: #475569; font-weight: 600; margin: 0;">Log audit keuangan dan riwayat penarikan dana (withdrawals) akan dihapus secara permanen.</p>
                        </div>
                        <div style="background: #f8fafc; border: 2px solid #000; padding: 15px;">
                            <div style="font-weight: 900; font-size: 12px; margin-bottom: 10px; color: #ef4444;"><i class="fa-solid fa-database"></i> LEDGER</div>
                            <p style="font-size: 12px; color: #475569; font-weight: 600; margin: 0;">Integritas buku besar (ledger) akan dimulai dari awal (Zero State). Semua metrik finansial di dashboard akan kembali ke Rp 0.</p>
                        </div>
                    </div>

                    <div style="background: #f1f5f9; padding: 20px; border: 2px solid #000; font-size: 12px; font-weight: 700; color: #000;">
                        <i class="fa-solid fa-shield-halved" style="margin-right: 8px;"></i> Rekomendasi: Lakukan <span style="text-decoration: underline;">Backup Database</span> secara penuh sebelum mengeksekusi tindakan ini jika Anda memerlukan catatan historis untuk keperluan pajak atau audit hukum.
                    </div>
                </div>

                <div style="padding: 25px 40px; background: #f8fafc; border-top: 3px solid #000; display: flex; justify-content: flex-end;">
                    <button onclick="closePurgeDetail()" class="btn-sq-slate" style="padding: 12px 30px;">SAYA MENGERTI</button>
                </div>
            </div>
        </div>

        <!-- Custom Confirmation Modal (High Alert) -->
        <div id="confirm-modal"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.85); backdrop-filter: blur(8px); z-index: 1200; justify-content: center; align-items: flex-start; padding-top: 50px;">
            <div id="confirm-card"
                style="background: #fff; width: 600px; max-width: 90%; border: 6px solid #ef4444; box-shadow: 20px 20px 0px rgba(239, 68, 68, 0.4); transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">

                <div style="background: #ef4444; padding: 15px 25px; border-bottom: 3px solid #000; text-align: center;">
                    <h3
                        style="font-size: 20px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; color: #fff; margin: 0;">
                        <i class="fa-solid fa-triangle-exclamation" style="margin-right: 10px;"></i> PENGAMBILALIHAN SISTEM TERDETEKSI
                    </h3>
                </div>

                <div style="padding: 40px; text-align: center;">
                    <div
                        style="width: 100px; height: 100px; background: #fff; color: #ef4444; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; font-size: 48px; border: 4px solid #ef4444; animation: pulse-warning 1s infinite; box-shadow: 8px 8px 0px 0px #000;">
                        <i class="fa-solid fa-radiation"></i>
                    </div>

                    <p
                        style="font-size: 15px; color: #000; font-weight: 900; line-height: 1.6; margin-bottom: 40px; text-transform: uppercase; padding: 0;">
                        Apakah Anda yakin? Tindakan ini akan <span
                            style="color: #fff; background: #ef4444; padding: 2px 6px;">MENGHAPUS seluruh buku kas
                            pendaftaran global</span>. Setiap siswa akan kehilangan akses kursus dan semua data keuangan akan dihapus. <br><br>
                        <span
                            style="border-bottom: 3px solid #000; padding-bottom: 4px; display: inline-block; margin-top: 10px;">TINDAKAN INI TIDAK DAPAT DIBATALKAN.</span>
                    </p>
                    <div style="display: flex; gap: 20px; align-items: center; justify-content: center;">
                        <button id="confirm-yes" class="btn-sq-danger" style="flex: 1; padding: 18px;">
                            EKSEKUSI PENGHAPUSAN GLOBAL
                        </button>
                        <button onclick="closeConfirmModal()" class="btn-sq-slate" style="flex: 1; padding: 18px;">
                            BATALKAN PENGHAPUSAN
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes pulse-warning {
                0% {
                    transform: scale(1);
                    box-shadow: 8px 8px 0px 0px #000;
                }

                50% {
                    transform: scale(1.05);
                    box-shadow: 12px 12px 0px 0px rgba(239, 68, 68, 0.5);
                }

                100% {
                    transform: scale(1);
                    box-shadow: 8px 8px 0px 0px #000;
                }
            }

            @media (max-width: 768px) {
                .admin-panel {
                    grid-column: span 2;
                }

                div[style*="grid-template-columns: minmax(0, 1fr) minmax(0, 1fr)"] {
                    display: flex !important;
                    flex-direction: column;
                }
            }
        </style>

        <script>
            function openPurgeDetail() {
                const modal = document.getElementById('purge-detail-modal');
                const card = document.getElementById('purge-detail-card');
                modal.style.display = 'flex';
                setTimeout(() => {
                    card.style.transform = 'scale(1)';
                    card.style.opacity = '1';
                }, 10);
            }

            function closePurgeDetail() {
                const card = document.getElementById('purge-detail-card');
                const modal = document.getElementById('purge-detail-modal');
                card.style.transform = 'scale(0.9)';
                card.style.opacity = '0';
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            }

            function triggerGlobalPurge() {
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
                document.getElementById('global-purge-form').submit();
            });
        </script>
    </div>
@endsection



