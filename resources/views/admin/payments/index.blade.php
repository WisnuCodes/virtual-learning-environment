@extends('layouts.app')

@section('content')
<style>
    .admin-container {
        background-color: var(--bg-secondary);
        min-height: calc(100vh - 73px);
        background-image: 
            radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 24px 24px;
        padding: 40px 5% 80px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding-bottom: 25px;
        border-bottom: 4px solid #000;
        flex-wrap: wrap;
        gap: 20px;
    }

    .admin-title-group h1 {
        font-size: 32px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: -1.5px;
        margin: 0;
        color: #000;
    }

    .admin-title-group p {
        font-size: 14px;
        font-weight: 800;
        color: #64748b;
        text-transform: uppercase;
        margin-top: 5px;
    }

    .admin-badge {
        background: #000;
        color: #fff;
        padding: 10px 20px;
        border: 2px solid #000;
        box-shadow: 4px 4px 0px 0px var(--accent-primary);
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-card {
        background: #fff;
        border: 4px solid #000;
        box-shadow: 12px 12px 0px 0px #000;
        overflow: hidden;
    }

    .payment-table {
        width: 100%;
        border-collapse: collapse;
    }

    .payment-table th {
        padding: 20px;
        background: #f8fafc;
        border-bottom: 4px solid #000;
        text-align: left;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #000;
    }

    .payment-table td {
        padding: 25px 20px;
        border-bottom: 2px solid #f1f5f9;
        font-size: 14px;
        font-weight: 700;
    }

    .payment-table tr:hover td {
        background: #fdfdfd;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background: #000;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        border: 2px solid #000;
        box-shadow: 3px 3px 0px 0px var(--accent-primary);
        font-size: 16px;
    }

    .status-pill {
        font-size: 10px;
        font-weight: 900;
        padding: 6px 12px;
        border: 2px solid #000;
        text-transform: uppercase;
        display: inline-block;
        box-shadow: 3px 3px 0px 0px #000;
    }

    .status-pending { background: #fef3c7; color: #92400e; box-shadow: 3px 3px 0px 0px #f59e0b; }
    .status-active { background: #ecfdf5; color: #059669; box-shadow: 3px 3px 0px 0px #10b981; }
    .status-cancelled { background: #fff1f2; color: #e11d48; box-shadow: 3px 3px 0px 0px #ef4444; }

    .proof-btn {
        background: #fff;
        color: #000;
        border: 2px solid #000;
        padding: 8px 15px;
        font-size: 11px;
        font-weight: 900;
        text-decoration: none;
        text-transform: uppercase;
        box-shadow: 4px 4px 0px 0px #000;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s;
    }

    .proof-btn:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px 0px var(--accent-primary);
    }

    .action-btn {
        padding: 10px 15px;
        border: 2px solid #000;
        font-size: 11px;
        font-weight: 900;
        cursor: pointer;
        text-transform: uppercase;
        box-shadow: 4px 4px 0px 0px #000;
        transition: 0.2s;
    }

    .btn-approve { background: #10b981; color: #fff; }
    .btn-reject { background: #ef4444; color: #fff; }

    .action-btn:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px 0px #000;
    }

    .method-tag {
        font-size: 10px;
        font-weight: 900;
        background: #f1f5f9;
        padding: 4px 8px;
        border: 1px solid #000;
        text-transform: uppercase;
    }
</style>

<div class="admin-container">
    <div style="max-width: 1200px; margin: 0 auto;">

        <div class="admin-header">
            <div class="admin-title-group">
                <h1>Verifikasi Pembayaran</h1>
                <p>Kelola akses kursus berdasarkan konfirmasi transaksi siswa.</p>
            </div>
            <div class="admin-badge">
                <i class="fa-solid fa-shield-halved"></i>
                Panel Audit Keuangan
            </div>
        </div>

        <div class="table-card">
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Identitas Siswa</th>
                        <th>Kursus & Nilai</th>
                        <th>Metode & Bukti</th>
                        <th>Status</th>
                        <th>Otorisasi Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $enrollment)
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">{{ substr($enrollment->user->name, 0, 1) }}</div>
                                    <div>
                                        <div style="font-weight: 900; text-transform: uppercase;">{{ $enrollment->user->name }}</div>
                                        <div style="font-size: 11px; color: #64748b; font-weight: 800;">{{ $enrollment->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 900; color: #000; margin-bottom: 5px; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $enrollment->course->title }}
                                </div>
                                <div style="font-family: 'Courier New', Courier, monospace; font-weight: 950; font-size: 16px; color: var(--accent-primary);">
                                    Rp {{ number_format($enrollment->price_paid, 0, ',', '.') }}
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 10px; align-items: flex-start;">
                                    <span class="method-tag">{{ str_replace('_', ' ', $enrollment->payment_method) }}</span>
                                    @if($enrollment->midtrans_order_id)
                                        <span style="font-size: 10px; font-weight: 900; background: #f1f5f9; padding: 2px 6px;">
                                            Order ID: {{ $enrollment->midtrans_order_id }}
                                        </span>
                                        @if($enrollment->midtrans_payment_type)
                                            <span style="font-size: 10px; font-weight: 900; background: #e2e8f0; padding: 2px 6px;">
                                                Via: {{ str_replace('_', ' ', $enrollment->midtrans_payment_type) }}
                                            </span>
                                        @endif
                                    @else
                                        <span style="font-size: 10px; color: #94a3b8; font-weight: 900;">TIDAK ADA TRANSAKSI</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="status-pill status-{{ $enrollment->status }}">
                                    {{ $enrollment->status }}
                                </span>
                            </td>
                            <td>
                                @if($enrollment->status === 'pending')
                                    <div style="font-size: 10px; font-weight: 900; color: #f59e0b; background: #fef3c7; padding: 6px 12px; border: 2px solid #f59e0b; display: inline-block;">
                                        <i class="fa-solid fa-clock"></i> MENUNGGU PEMBAYARAN
                                    </div>
                                    <p style="font-size: 9px; color: #64748b; font-weight: 700; margin-top: 5px;">Otomatis aktif jika dibayar via Midtrans.</p>
                                @else
                                    <form action="{{ route('admin.payments.destroy', $enrollment) }}" method="POST" onsubmit="return confirm('Hapus rekor audit ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn" style="background: #fff; color: #ef4444; border-color: #ef4444;">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 100px 20px; text-align: center;">
                                <div style="font-size: 48px; color: #cbd5e1; margin-bottom: 20px;"><i class="fa-solid fa-receipt"></i></div>
                                <h3 style="font-weight: 900; color: #000; text-transform: uppercase;">Belum Ada Transaksi</h3>
                                <p style="font-weight: 800; color: #64748b;">Antrian verifikasi saat ini kosong.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 40px; display: flex; justify-content: center;">
            {{ $enrollments->links() }}
        </div>

    </div>
</div>
@endsection
