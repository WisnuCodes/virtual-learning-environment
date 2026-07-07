@extends('layouts.app')

@section('content')
    <style>
        .finance-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 35px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .finance-title-wrapper {
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #fff;
            border: 3px solid #000;
            padding: 30px;
            box-shadow: 8px 8px 0px 0px #000;
            position: relative;
            overflow: hidden;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 900;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
            display: block;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 900;
            color: #000;
            font-family: 'Courier New', Courier, monospace;
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

        .finance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .finance-table th {
            padding: 15px 20px;
            font-size: 11px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 3px solid #000;
            background: #f8fafc;
            text-align: left;
        }

        .finance-table td {
            padding: 20px;
            border-bottom: 2px solid #000;
            font-size: 13px;
            font-weight: 600;
        }

        .type-badge {
            font-size: 10px;
            font-weight: 900;
            padding: 4px 10px;
            border: 2px solid #000;
            text-transform: uppercase;
            display: inline-block;
        }

        .type-income { background: #ecfdf5; color: #059669; }
        .type-expense { background: #fff1f2; color: #e11d48; }

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
        }
    </style>

    <div style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 40px 5%;">

            <div class="finance-header">
                <div>
                    <div class="finance-title-wrapper">
                        <i class="fa-solid fa-money-bill-transfer" style="color: var(--accent-primary); font-size: 18px;"></i>
                        <h2 style="font-size: 18px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">
                            Buku Kas & Arus Historis</h2>
                    </div>
                    <p style="color: #000; font-size: 14px; margin: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                        Audit menyeluruh pemasukan platform dan pengeluaran instruktur.</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn-sq-outline">
                    <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Pusat Kontrol
                </a>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Total Pemasukan (Gross)</span>
                    <div class="stat-value text-success">Rp {{ number_format($grossRevenue, 0, ',', '.') }}</div>
                    <i class="fa-solid fa-arrow-trend-up" style="position: absolute; right: 20px; bottom: 20px; font-size: 40px; color: rgba(16, 185, 129, 0.1);"></i>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Total Dana Cair (Payout)</span>
                    <div class="stat-value text-danger">Rp {{ number_format($totalPaidOut, 0, ',', '.') }}</div>
                    <i class="fa-solid fa-hand-holding-dollar" style="position: absolute; right: 20px; bottom: 20px; font-size: 40px; color: rgba(225, 29, 72, 0.1);"></i>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Permintaan Tertunda</span>
                    <div class="stat-value text-warning">Rp {{ number_format($pendingPayouts, 0, ',', '.') }}</div>
                    <i class="fa-solid fa-clock-rotate-left" style="position: absolute; right: 20px; bottom: 20px; font-size: 40px; color: rgba(245, 158, 11, 0.1);"></i>
                </div>
            </div>

            <div class="admin-panel">
                <div class="admin-panel-header">
                    <h3 style="font-size: 14px; font-weight: 900; text-transform: uppercase; color: #000; margin: 0; display: flex; align-items: center; gap: 10px; letter-spacing: 1px;">
                        <i class="fa-solid fa-list-ul" style="color: var(--accent-primary);"></i> Ledger Transaksi Terbaru
                    </h3>
                    <div style="font-size: 11px; font-weight: 900; background: #000; color: #fff; padding: 4px 10px; border: 2px solid #000; box-shadow: 3px 3px 0px 0px var(--accent-primary);">
                        LOG: {{ $history->count() }} ENTRI
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table class="finance-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Tipe</th>
                                <th>Deskripsi</th>
                                <th>Entitas</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($history as $item)
                                <tr>
                                    <td style="color: #64748b; font-size: 12px;">{{ $item->date->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="type-badge {{ $item->type === 'income' ? 'type-income' : 'type-expense' }}">
                                            {{ $item->type === 'income' ? 'Masuk' : 'Keluar' }}
                                        </span>
                                    </td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <div style="width: 24px; height: 24px; background: #f1f5f9; border: 1px solid #000; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 900;">
                                                {{ substr($item->user, 0, 1) }}
                                            </div>
                                            {{ $item->user }}
                                        </div>
                                    </td>
                                    <td style="font-family: monospace; font-weight: 900; {{ $item->type === 'income' ? 'color: #059669;' : 'color: #e11d48;' }}">
                                        {{ $item->type === 'income' ? '+' : '-' }} Rp {{ number_format($item->amount, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 900; text-transform: uppercase;">
                                            <div style="width: 8px; height: 8px; border-radius: 50%; background: {{ $item->status === 'completed' ? '#10b981' : ($item->status === 'pending' ? '#f59e0b' : '#ef4444') }};"></div>
                                            {{ $item->status }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 60px; text-align: center; color: #94a3b8; font-weight: 800; text-transform: uppercase;">
                                        <i class="fa-solid fa-folder-open" style="font-size: 40px; display: block; margin-bottom: 15px; opacity: 0.2;"></i>
                                        Belum ada riwayat transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
