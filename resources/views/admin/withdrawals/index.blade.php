@extends('layouts.app')

@section('content')
    <style>
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 30px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
        }

        .brutalist-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px #000;
        }

        .brutalist-table th,
        .brutalist-table td {
            padding: 18px 25px;
            border-bottom: 3px solid #000;
            border-right: 2px solid #000;
            text-align: left;
        }

        .brutalist-table th {
            font-size: 13px;
            font-weight: 900;
            color: #fff;
            background: #000;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .brutalist-table tr:hover {
            background-color: #f8fafc;
        }

        .brutalist-table tr.pending-row {
            background-color: #fffbeb;
        }

        .brutalist-table tr.pending-row:hover {
            background-color: #fef3c7;
        }

        .badge-pending {
            background: #f59e0b;
            color: #000;
            border: 2px solid #000;
            padding: 4px 8px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            box-shadow: 2px 2px 0px 0px #000;
        }

        .badge-completed {
            background: #10b981;
            color: #fff;
            border: 2px solid #000;
            padding: 4px 8px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            box-shadow: 2px 2px 0px 0px #000;
        }

        .badge-failed {
            background: #e11d48;
            color: #fff;
            border: 2px solid #000;
            padding: 4px 8px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            box-shadow: 2px 2px 0px 0px #000;
        }

        .btn-action {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 2px 2px 0px 0px #000;
            transition: all 0.1s;
        }

        .btn-action.btn-approve {
            background: #10b981;
            color: #fff;
        }

        .btn-action.btn-reject {
            background: #e11d48;
            color: #fff;
        }

        .btn-action:hover {
            transform: translate(-1px, -1px);
            box-shadow: 3px 3px 0px 0px #000;
        }

        .btn-action:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000;
        }

        .alert-success {
            background: #10b981;
            border: 3px solid #000;
            color: #fff;
            padding: 15px 20px;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 6px 6px 0px 0px #000;
        }

        .amount-display {
            font-size: 20px;
            font-weight: 900;
            color: #10b981;
            text-shadow: 1px 1px 0px #000;
            letter-spacing: -1px;
        }

        @media (max-width: 900px) {

            .brutalist-table,
            .brutalist-table tbody,
            .brutalist-table tr,
            .brutalist-table td {
                display: block;
                width: 100%;
            }

            .brutalist-table thead {
                display: none;
            }

            .brutalist-table tr {
                margin-bottom: 20px;
                border-bottom: 3px solid #000;
            }

            .brutalist-table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                border-right: none;
            }

            .brutalist-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                text-align: left;
                font-weight: 900;
                font-size: 11px;
                text-transform: uppercase;
            }
        }
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 40px 5%;">

            <div class="admin-header">
                <div>
                    <div
                        style="font-size: 12px; font-weight: 900; color: #fff; background: #000; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 5px; display: inline-block; padding: 4px 10px; border: 2px solid #000;">
                        <i class="fa-solid fa-money-bill-transfer" style="margin-right: 6px;"></i> Financial Node
                    </div>
                    <h1
                        style="font-size: 32px; font-weight: 900; color: #000; margin: 10px 0 0; text-transform: uppercase; letter-spacing: -1px;">
                        Payout Authorizations
                    </h1>
                </div>
            </div>

            @if (session('success'))
                <div class="alert-success">
                    <div
                        style="background: #fff; color: #10b981; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; border: 2px solid #000;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    {{ session('success') }}
                </div>
            @endif

            <table class="brutalist-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Instructor Identity</th>
                        <th>Withdrawal Volume</th>
                        <th>Time Index</th>
                        <th>Status</th>
                        <th style="text-align: right;">Authorization</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($withdrawals as $w)
                        <tr class="{{ $w->status === 'pending' ? 'pending-row' : '' }}">
                            <td data-label="ID" style="font-weight: 900;">
                                #{{ str_pad($w->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td data-label="Instructor Identity">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div
                                        style="width: 36px; height: 36px; background: #000; color: #fff; border: 2px solid #000; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 900; text-transform: uppercase;">
                                        {{ substr($w->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div
                                            style="font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase;">
                                            {{ $w->user->name }}
                                        </div>
                                        <div style="font-size: 11px; color: #475569; font-weight: 700;">
                                            {{ $w->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Withdrawal Volume">
                                <span class="amount-display">Rp {{ number_format($w->amount, 0, ',', '.') }}</span>
                            </td>
                            <td data-label="Time Index">
                                <div style="font-size: 13px; font-weight: 900;">{{ $w->created_at->format('d M Y') }}</div>
                                <div style="font-size: 11px; font-weight: 700; color: #64748b;">
                                    {{ $w->created_at->format('H:i:s') }}</div>
                            </td>
                            <td data-label="Status">
                                @if ($w->status === 'pending')
                                    <span class="badge-pending">PENDING</span>
                                @elseif($w->status === 'completed')
                                    <span class="badge-completed">DISPATCHED</span>
                                @else
                                    <span class="badge-failed">ABORTED</span>
                                @endif
                            </td>
                            <td data-label="Authorization" style="text-align: right;">
                                @if ($w->status === 'pending')
                                    <div style="display: flex; gap: 8px; justify-content: flex-end;">
                                        <form action="{{ route('admin.withdrawals.update', $w->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn-action btn-approve" title="Approve Transfer">
                                                <i class="fa-solid fa-check"></i> CONFIRM
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.withdrawals.update', $w->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="failed">
                                            <button type="submit" class="btn-action btn-reject" title="Reject Transfer">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div style="display: flex; gap: 8px; justify-content: flex-end; align-items: center;">
                                        <span
                                            style="font-size: 11px; font-weight: 900; color: #64748b; text-transform: uppercase;">LOCKED</span>
                                        <form action="{{ route('admin.withdrawals.destroy', $w->id) }}" method="POST"
                                            style="display: inline-block;" id="delete-form-{{ $w->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-action btn-reject"
                                                onclick="triggerDelete('delete-form-{{ $w->id }}', 'PAYOUT #{{ str_pad($w->id, 5, '0', STR_PAD_LEFT) }}')"
                                                style="padding: 5px 10px; font-size: 10px;" title="Purge Record">
                                                <i class="fa-solid fa-trash-can" style="margin-right: 4px;"></i> PURGE
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 60px 20px; text-align: center; background: #fff;">
                                <div style="margin-bottom: 20px;">
                                    <i class="fa-solid fa-check-double" style="font-size: 48px; color: #cbd5e1;"></i>
                                </div>
                                <h3 style="font-size: 16px; font-weight: 900; text-transform: uppercase;">Queue Empty</h3>
                                <p style="font-size: 13px; font-weight: 600; color: #64748b;">No pending instructor
                                    withdrawals found in the ledger.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="margin-top: 30px;">
                <style>
                    /* Custom Pagination for Brutalist Table */
                    .pagination {
                        display: flex;
                        list-style: none;
                        gap: 10px;
                        margin: 0;
                        padding: 0;
                        justify-content: center;
                    }

                    .pagination li.active span {
                        background: #000;
                        color: #fff;
                        font-weight: 900;
                        padding: 10px 15px;
                        border: 2px solid #000;
                        box-shadow: 4px 4px 0 0 var(--accent-primary);
                    }

                    .pagination li a {
                        background: #fff;
                        color: #000;
                        font-weight: 900;
                        padding: 10px 15px;
                        border: 2px solid #000;
                        text-decoration: none;
                        display: block;
                        box-shadow: 4px 4px 0 0 #000;
                        transition: 0.1s;
                    }

                    .pagination li a:active {
                        transform: translate(2px, 2px);
                        box-shadow: 0 0 0 0 #000;
                    }

                    .pagination li.disabled span {
                        background: #f1f5f9;
                        color: #94a3b8;
                        font-weight: 900;
                        padding: 10px 15px;
                        border: 2px solid #cbd5e1;
                    }
                </style>
                {{ $withdrawals->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>

    <!-- Custom Confirmation Modal (Withdrawal Purge) -->
    <div id="confirm-modal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.82); backdrop-filter: blur(8px); z-index: 9999; justify-content: center; align-items: flex-start; padding-top: 50px;">
        <div id="confirm-card"
            style="background: #fff; width: 500px; max-width: 95%; border: 4px solid #000; box-shadow: 15px 15px 0px rgba(0,0,0,1); transform: translateY(-100px); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 40px; text-align: center;">
                <div
                    style="width: 80px; height: 80px; background: #fff; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px; border: 3px solid #000; box-shadow: 6px 6px 0px 0px #e11d48; color: #e11d48;">
                    <i class="fa-solid fa-dumpster-fire"></i>
                </div>
                <h3
                    style="font-size: 20px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; color: #000; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 15px;">
                    Ledger Registry Purge
                </h3>
                <p
                    style="font-size: 14px; color: #000; font-weight: 700; line-height: 1.6; margin-bottom: 35px; text-transform: uppercase;">
                    Confirm permanent removal of <br><br> <span id="withdrawal-id"
                        style="background: #e11d48; color: #fff; padding: 4px 10px; font-weight: 900; border: 2px solid #000; display: inline-block; margin-bottom: 15px;">[TARGET]</span>
                    <br><br>
                    <span style="border-bottom: 2px solid #000; padding-bottom: 2px;">This action is final and
                        will<br>remove all historical trace.</span>
                </p>
                <div style="display: flex; gap: 20px; justify-content: center;">
                    <button id="confirm-yes"
                        style="flex: 1; background: #e11d48; color: #fff; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px #000; transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px #000';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px #000';">
                        CONFIRM PURGE
                    </button>
                    <button onclick="closeConfirmModal()"
                        style="flex: 1; background: #000; color: #fff; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px var(--accent-primary); transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px var(--accent-primary)';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px var(--accent-primary)';">
                        ABORT OPS
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentForm = null;

        function triggerDelete(formId, targetText) {
            currentForm = document.getElementById(formId);
            document.getElementById('withdrawal-id').innerText = targetText;
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
