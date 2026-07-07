@extends('layouts.app')

@section('content')
    <style>
        .audit-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 35px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }

        .audit-actions {
            display: flex;
            gap: 15px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #fff;
            padding: 30px;
            position: relative;
            overflow: hidden;
            border: 2px solid #000;
            box-shadow: 6px 6px 0px 0px #000;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px 0px #000;
        }

        .stat-card-primary {
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
        }

        .stat-card-primary:hover {
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
        }

        .ledger-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .btn-sq-primary {
            background: var(--accent-primary);
            color: #fff;
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

        @media (max-width: 768px) {
            .audit-header {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }

            .audit-actions {
                width: 100%;
                flex-direction: column;
            }

            .audit-actions form,
            .audit-actions button,
            .audit-actions a {
                width: 100%;
                justify-content: center;
                display: flex;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            /* Responsive Table (Cards) */
            .table-container {
                overflow: visible !important;
            }

            .ledger-table {
                min-width: 100%;
            }

            .ledger-table thead {
                display: none;
            }

            .ledger-table,
            .ledger-table tbody,
            .ledger-table tr,
            .ledger-table td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            .ledger-table tr {
                background: #fff;
                margin-bottom: 25px;
                border: 2px solid #000;
                box-shadow: 4px 4px 0px 0px var(--accent-primary);
            }

            .ledger-table td {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                padding: 15px 20px !important;
                border-bottom: 2px solid #000 !important;
                border-right: none !important;
                text-align: left !important;
                gap: 8px;
            }

            .ledger-table td:nth-child(1)::before {
                content: "Identitas Pembeli:";
                font-size: 11px;
                font-weight: 900;
                color: #000;
                text-transform: uppercase;
                margin-bottom: 4px;
                letter-spacing: 1px;
            }

            .ledger-table td:nth-child(2)::before {
                content: "Nama Kursus:";
                font-size: 11px;
                font-weight: 900;
                color: #000;
                text-transform: uppercase;
                margin-bottom: 4px;
                letter-spacing: 1px;
            }

            .ledger-table td:nth-child(3)::before {
                content: "Waktu Transaksi:";
                font-size: 11px;
                font-weight: 900;
                color: #000;
                text-transform: uppercase;
                margin-bottom: 4px;
                letter-spacing: 1px;
            }

            .ledger-table td:nth-child(4)::before {
                content: "Nilai Pendapatan:";
                font-size: 11px;
                font-weight: 900;
                color: #000;
                text-transform: uppercase;
                margin-bottom: 4px;
                letter-spacing: 1px;
            }

            .ledger-table td:last-child {
                border-bottom: none !important;
                background: #f8fafc;
            }

            .ledger-table td:last-child>div:first-child {
                font-size: 24px !important;
            }
        }
    </style>
    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 40px 5%;">

            <div class="audit-header">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px; background: #e2e8f0; display: inline-block; padding: 4px 8px; border: 2px solid #000;">
                        <i class="fa-solid fa-server" style="margin-right: 6px;"></i> Infrastruktur Keuangan
                    </div>
                    <h1
                        style="font-size: 36px; font-weight: 900; color: #000; margin: 10px 0 0; letter-spacing: -1.5px; text-transform: uppercase;">
                        Audit Pendapatan</h1>
                    <p style="color: #475569; font-size: 14px; font-weight: 600; margin-top: 5px;">Pemantauan operasional monetisasi aset dan aliran likuiditas.</p>
                </div>

                <div class="audit-actions">
                    <a href="{{ route('instructor.dashboard') }}" class="btn-sq-outline">
                        <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> KEMBALI KE PANEL
                    </a>
                    <form id="payout-form" action="{{ route('instructor.earnings.payout') }}" method="POST">
                        @csrf
                        <button type="button" onclick="showPayoutModal()" class="btn-sq-primary"
                            style="background: #10b981;">
                            <i class="fa-solid fa-money-bill-transfer" style="margin-right: 8px;"></i> PENCAIRAN DANA
                        </button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div
                    style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 12px 15px; margin-bottom: 30px; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 10px; box-shadow: 4px 4px 0px 0px #10b981;">
                    <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i> {{ session('success') }}
                </div>
            @endif

            <div class="stats-grid">
                <!-- Net Yield -->
                <div class="stat-card stat-card-primary">
                    <div
                        style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; display: flex; align-items: center;">
                        <i class="fa-solid fa-wallet"
                            style="margin-right: 8px; font-size: 14px; color: var(--accent-primary);"></i> Total Pendapatan Bersih
                    </div>
                    <div style="font-size: 38px; font-weight: 900; color: #000; letter-spacing: -1.5px; line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        Rp {{ number_format($netEarnings, 0, ',', '.') }}</div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 25px;">
                        <span
                            style="background: #ecfdf5; color: #059669; font-size: 10px; font-weight: 900; padding: 4px 8px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #10b981; text-transform: uppercase;">SALDO AKTIF</span>
                        <span style="font-size: 11px; color: #475569; font-weight: 800;">Setelah Biaya Sistem 10%</span>
                    </div>
                </div>

                <!-- Monthly Velocity -->
                <div class="stat-card">
                    <div
                        style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; display: flex; align-items: center;">
                        <i class="fa-solid fa-chart-line" style="margin-right: 8px; font-size: 14px; color: #2563eb;"></i>
                        Volume Revenue Bulanan
                    </div>
                    <div style="font-size: 38px; font-weight: 900; color: #000; letter-spacing: -1.5px; line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        Rp {{ number_format($thisMonthRevenue, 0, ',', '.') }}</div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 25px;">
                        <span
                            style="background: #eff6ff; color: #2563eb; font-size: 10px; font-weight: 900; padding: 4px 8px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #3b82f6; text-transform: uppercase;">SIKLUS BERJALAN</span>
                        <span style="font-size: 11px; color: #475569; font-weight: 800;">Periode Operasional Saat Ini</span>
                    </div>
                </div>

                <!-- Acquisition Volume -->
                <div class="stat-card">
                    <div
                        style="font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; display: flex; align-items: center;">
                        <i class="fa-solid fa-cart-shopping"
                            style="margin-right: 8px; font-size: 14px; color: #7c3aed;"></i> Total Siswa Terdaftar
                    </div>
                    <div style="font-size: 38px; font-weight: 900; color: #000; letter-spacing: -1.5px; line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ sprintf('%03d', $totalEnrollments) }}</div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 25px;">
                        <span
                            style="background: #f5f3ff; color: #7c3aed; font-size: 10px; font-weight: 900; padding: 4px 8px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #8b5cf6; text-transform: uppercase;">UNIT TERVERIFIKASI</span>
                        <span style="font-size: 11px; color: #475569; font-weight: 800;">Akses Kursus yang Disalurkan</span>
                    </div>
                </div>
            </div>

            <div style="background: #fff; border: 2px solid #000; overflow: hidden; box-shadow: 8px 8px 0px 0px #000;">
                <div
                    style="background: #f8fafc; border-bottom: 2px solid #000; padding: 20px 25px; display: flex; justify-content: space-between; align-items: center;">
                    <h3
                        style="font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">
                        <i class="fa-solid fa-list-check" style="margin-right: 10px; color: var(--accent-primary);"></i>
                        Buku Besar Transaksi
                    </h3>
                    <div
                        style="display: flex; align-items: center; gap: 10px; background: #fff; border: 2px solid #000; padding: 4px 10px; box-shadow: 2px 2px 0px 0px #000;">
                        <span
                            style="width: 10px; height: 10px; background: #10b981; border: 1px solid #000; display: block; box-shadow: 1px 1px 0px 0px #000;"></span>
                        <span
                            style="font-size: 10px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px;">Pengindeksan Akurat</span>
                    </div>
                </div>

                <div style="overflow-x: auto;" class="table-container">
                    <table class="ledger-table">
                        <thead>
                            <tr style="text-align: left; background: #fff; border-bottom: 2px solid #000;">
                                <th
                                    style="padding: 18px 25px; font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; border-right: 2px solid #000;">
                                    Identitas Pembeli</th>
                                <th
                                    style="padding: 18px 25px; font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; border-right: 2px solid #000;">
                                    Nama Kursus</th>
                                <th
                                    style="padding: 18px 25px; font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; border-right: 2px solid #000;">
                                    Waktu Transaksi</th>
                                <th
                                    style="padding: 18px 25px; font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; text-align: right;">
                                    Nilai Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $trx)
                                <tr style="border-bottom: 2px solid #000; transition: all 0.2s ease; background: #fff;"
                                    onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                                    <td style="padding: 20px 25px; border-right: 2px solid #000;">
                                        <div style="display: flex; align-items: center; gap: 15px;">
                                            <div
                                                style="width: 40px; height: 40px; background: #000; color: #fff; border: 2px solid #000; box-shadow: 2px 2px 0px 0px var(--accent-primary); display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 900; text-transform: uppercase;">
                                                {{ substr($trx->user->name ?? '?', 0, 1) }}
                                            </div>
                                            <div>
                                                <div
                                                    style="font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase;">
                                                    {{ $trx->user->name ?? 'Anonymous' }}</div>
                                                <div style="font-size: 12px; color: #475569; font-weight: 700;">
                                                    {{ $trx->user->email ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding: 20px 25px; border-right: 2px solid #000;">
                                        <div
                                            style="font-size: 14px; font-weight: 900; color: #000; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-transform: uppercase;">
                                            {{ $trx->course->title ?? 'Deleted Course' }}
                                        </div>
                                        <div
                                            style="display: inline-block; font-size: 10px; font-weight: 900; color: #000; border: 2px solid #000; background: #f1f5f9; padding: 4px 8px; margin-top: 8px; box-shadow: 2px 2px 0px 0px #000;">
                                            ID: {{ str_pad($trx->course_id, 5, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </td>
                                    <td style="padding: 20px 25px; border-right: 2px solid #000;">
                                        <div style="font-size: 14px; color: #000; font-weight: 900;">
                                            <i class="fa-regular fa-calendar"
                                                style="margin-right: 4px; color: var(--accent-primary);"></i>
                                            {{ $trx->created_at->format('d M Y') }}
                                        </div>
                                        <div style="font-size: 12px; color: #475569; font-weight: 800; margin-top: 4px;">
                                            <i class="fa-regular fa-clock" style="margin-right: 4px;"></i>
                                            {{ $trx->created_at->format('H:i:s') }}
                                        </div>
                                    </td>
                                    <td style="padding: 20px 25px; text-align: right; background: #f8fafc;">
                                        <div
                                            style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">
                                            Kotor: Rp {{ number_format($trx->price_paid, 0, ',', '.') }}</div>
                                        <div
                                            style="font-size: 10px; font-weight: 900; color: #e11d48; text-transform: uppercase; margin: 2px 0;">
                                            Biaya (10%): -Rp {{ number_format($trx->price_paid * 0.1, 0, ',', '.') }}</div>
                                        <div
                                            style="font-size: 20px; font-weight: 900; color: #10b981; border-top: 1px dashed #cbd5e1; padding-top: 5px; margin-top: 5px;">
                                            +Rp {{ number_format($trx->price_paid * 0.9, 0, ',', '.') }}
                                        </div>
                                        <div
                                            style="font-size: 9px; color: #000; font-weight: 900; text-transform: uppercase; margin-top: 2px; letter-spacing: 0.5px;">
                                            Pendapatan Bersih Instruktur</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        style="padding: 80px 20px; text-align: center; border-bottom: none; background: #fff;">
                                        <div
                                            style="width: 80px; height: 80px; border: 3px solid #000; display: inline-flex; align-items: center; justify-content: center; font-size: 36px; color: #000; margin-bottom: 20px; background: #f8fafc; box-shadow: 6px 6px 0px 0px #000;">
                                            <i class="fa-solid fa-box-open"></i>
                                        </div>
                                        <h3
                                            style="font-size: 16px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px;">
                                            Belum Ada Transaksi</h3>
                                        <p
                                            style="font-size: 14px; color: #475569; font-weight: 700; max-width: 350px; margin: 15px auto 0;">
                                            Buku besar belum memiliki transaksi. Aktivitas penjualan kursus Anda akan dipertanggungjawabkan di sini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($transactions->hasPages())
                    <div
                        style="padding: 25px; border-top: 2px solid #000; background: #fff; display: flex; justify-content: center;">
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
                        {{ $transactions->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>

            <!-- Payout Request Queue Section -->
            <div
                style="margin-top: 50px; background: #fff; border: 3px solid #000; box-shadow: 10px 10px 0px 0px var(--accent-primary); overflow: hidden;">
                <div
                    style="background: #000; border-bottom: 3px solid #000; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center;">
                    <h3
                        style="font-size: 14px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 2px; margin: 0;">
                        <i class="fa-solid fa-clock-rotate-left"
                            style="margin-right: 10px; color: var(--accent-primary);"></i> Antrean Permintaan Pencairan
                    </h3>
                    <div
                        style="background: var(--accent-primary); color: #000; font-size: 10px; font-weight: 900; padding: 2px 8px; border: 2px solid #000;">
                        PELACAKAN VERIFIKASI
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f1f5f9; border-bottom: 3px solid #000; text-align: left;">
                                <th
                                    style="padding: 15px 25px; font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; border-right: 2px solid #000;">
                                    ID Antrean</th>
                                <th
                                    style="padding: 15px 25px; font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; border-right: 2px solid #000;">
                                    Jumlah Penarikan</th>
                                <th
                                    style="padding: 15px 25px; font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; border-right: 2px solid #000;">
                                    Waktu Transaksi</th>
                                <th
                                    style="padding: 15px 25px; font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; text-align: center;">
                                    Status Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdrawals as $w)
                                <tr style="border-bottom: 2px solid #000; background: #fff;">
                                    <td
                                        style="padding: 18px 25px; font-weight: 900; color: #64748b; border-right: 2px solid #000;">
                                        #{{ str_pad($w->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td style="padding: 18px 25px; border-right: 2px solid #000;">
                                        <span
                                            style="font-size: 18px; font-weight: 900; color: #000;">Rp {{ number_format($w->amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td style="padding: 18px 25px; border-right: 2px solid #000;">
                                        <div style="font-size: 13px; font-weight: 800; color: #000;">
                                            {{ $w->created_at->format('d M Y') }}</div>
                                        <div style="font-size: 11px; color: #64748b; font-weight: 700;">
                                            {{ $w->created_at->format('H:i:s') }}</div>
                                    </td>
                                    <td style="padding: 18px 25px; text-align: center;">
                                        @if ($w->status === 'pending')
                                            <div
                                                style="display: inline-flex; align-items: center; gap: 8px; background: #fffbeb; border: 2px solid #f59e0b; padding: 6px 12px; box-shadow: 3px 3px 0px 0px #f59e0b; font-size: 11px; font-weight: 900; color: #92400e; text-transform: uppercase;">
                                                <i class="fa-solid fa-spinner fa-spin"></i> MENUNGGU VERIFIKASI
                                            </div>
                                        @elseif($w->status === 'completed')
                                            <div
                                                style="display: inline-flex; align-items: center; gap: 8px; background: #ecfdf5; border: 2px solid #10b981; padding: 6px 12px; box-shadow: 3px 3px 0px 0px #10b981; font-size: 11px; font-weight: 900; color: #064e3b; text-transform: uppercase;">
                                                <i class="fa-solid fa-check-double"></i> DANA DICAIRKAN
                                            </div>
                                        @else
                                            <div
                                                style="display: inline-flex; align-items: center; gap: 8px; background: #fef2f2; border: 2px solid #e11d48; padding: 6px 12px; box-shadow: 3px 3px 0px 0px #e11d48; font-size: 11px; font-weight: 900; color: #991b1b; text-transform: uppercase;">
                                                <i class="fa-solid fa-triangle-exclamation"></i> TRANSAKSI DITOLAK
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding: 40px; text-align: center;">
                                        <div
                                            style="font-size: 12px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">
                                            Tidak ada permintaan penarikan aktif dalam antrean.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Payout Confirmation Modal -->
    <div id="payoutModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); z-index: 9999; justify-content: center; align-items: center; backdrop-filter: blur(4px);">
        <div
            style="background: #fff; width: 100%; max-width: 500px; border: 4px solid #000; box-shadow: 15px 15px 0px #10b981; padding: 2px;">
            <div
                style="background: #000; color: #10b981; padding: 15px 20px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; display: flex; align-items: center; justify-content: space-between;">
                <span><i class="fa-solid fa-triangle-exclamation" style="margin-right: 10px;"></i> OTORISASI DIPERLUKAN</span>
                <button type="button" onclick="hidePayoutModal()"
                    style="background: transparent; border: none; color: #fff; cursor: pointer; font-size: 16px;"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>

            <div style="padding: 30px;">
                <h2
                    style="font-size: 24px; font-weight: 900; color: #000; margin: 0 0 15px 0; text-transform: uppercase; line-height: 1.1;">
                    Lanjutkan Pencairan Dana?</h2>

                <div
                    style="background: #fff; border: 3px solid #000; padding: 20px; margin-bottom: 25px; position: relative; box-shadow: 4px 4px 0px 0px #cbd5e1;">
                    <div
                        style="font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 2px; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 15px;">
                        <i class="fa-solid fa-receipt" style="margin-right: 5px; color: #000;"></i> RINGKASAN PENARIKAN
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label
                            style="display: block; font-size: 11px; font-weight: 900; color: #000; text-transform: uppercase; margin-bottom: 8px;">Jumlah Penarikan (Rp):</label>
                        <div style="position: relative;">
                            <span
                                style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); font-weight: 900; color: #10b981; font-size: 16px;">Rp</span>
                            <input type="number" id="custom_amount" step="1" min="1"
                                max="{{ $availablePayout }}" value="{{ number_format($availablePayout, 0, '.', '') }}"
                                style="width: 100%; background: #f8fafc; border: 3px solid #000; padding: 12px 12px 12px 45px; font-size: 24px; font-weight: 900; color: #000; outline: none; box-shadow: inset 4px 4px 0px #e2e8f0; font-family: inherit;">
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: 8px;">
                            <span style="font-size: 10px; font-weight: 800; color: #64748b; text-transform: uppercase;">Saldo Tersedia:</span>
                            <span
                                style="font-size: 10px; font-weight: 900; color: #10b981; text-transform: uppercase;">Rp {{ number_format($availablePayout, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div
                        style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border: 2px solid #000; padding: 10px;">
                        <span style="font-size: 10px; font-weight: 900; color: #475569; text-transform: uppercase;">
                            Tujuan Penarikan:</span>
                        <span style="font-size: 11px; font-weight: 900; color: #000;"><i
                                class="fa-solid fa-building-columns" style="margin-right: 5px;"></i> REKENING BANK TERHUBUNG</span>
                    </div>

                    <div
                        style="margin-top: 15px; font-size: 11px; font-weight: 800; color: #e11d48; text-transform: uppercase; background: #fff1f2; padding: 8px; border-left: 4px solid #e11d48;">
                        <i class="fa-solid fa-circle-exclamation" style="margin-right: 5px;"></i> Tindakan ini akan memotong saldo saldo dan memproses penarikan (estimasi 3-5 hari).
                    </div>
                </div>

                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" onclick="hidePayoutModal()"
                        style="background: #fff; border: 2px solid #000; padding: 12px 20px; font-weight: 900; color: #000; text-transform: uppercase; cursor: pointer; box-shadow: 4px 4px 0px #000; transition: all 0.1s;"
                        onmousedown="this.style.transform='translate(2px, 2px)'; this.style.boxShadow='0 0 0 #000'"
                        onmouseup="this.style.transform='translate(0,0)'; this.style.boxShadow='4px 4px 0 #000'">
                        BATAL
                    </button>
                    <button type="button" onclick="submitCustomPayout()"
                        style="background: #10b981; border: 2px solid #000; padding: 12px 20px; font-weight: 900; color: #fff; text-transform: uppercase; cursor: pointer; box-shadow: 4px 4px 0px #000; transition: all 0.1s;"
                        onmousedown="this.style.transform='translate(2px, 2px)'; this.style.boxShadow='0 0 0 #000'"
                        onmouseup="this.style.transform='translate(0,0)'; this.style.boxShadow='4px 4px 0 #000'">
                        KONFIRMASI PENARIKAN <i class="fa-solid fa-check" style="margin-left: 5px;"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showPayoutModal() {
            const modal = document.getElementById('payoutModal');
            modal.style.display = 'flex';
        }

        function hidePayoutModal() {
            const modal = document.getElementById('payoutModal');
            modal.style.display = 'none';
        }

        function submitCustomPayout() {
            const amountInput = document.getElementById('custom_amount');
            const amount = parseFloat(amountInput.value);
            const max = parseFloat(amountInput.getAttribute('max'));

            if (isNaN(amount) || amount <= 0) {
                alert('VOLUME TIDAK VALID: target penarikan harus lebih dari nol.');
                return;
            }

            if (amount > max) {
                alert('OVERFLOW ERROR: Jumlah penarikan melebihi saldo tersedia (Rp ' + max.toLocaleString('id-ID') + ').');
                return;
            }

            // Create hidden input in form to pass the amount
            const form = document.getElementById('payout-form');
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'amount';
            hiddenInput.value = amount;
            form.appendChild(hiddenInput);

            form.submit();
        }
    </script>
@endsection
