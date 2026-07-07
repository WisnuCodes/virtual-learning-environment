@extends('layouts.app')

@section('content')
    <style>
        .engine-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 35px;
            border-bottom: 3px solid #000;
            padding-bottom: 20px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .engine-title-wrapper {
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

        .engine-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .engine-table th {
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

        .engine-table th:last-child {
            border-right: none;
        }

        .engine-table td {
            padding: 20px 25px;
            border-bottom: 2px solid #000;
            border-right: 2px solid #000;
            background: #fff;
            transition: all 0.2s ease;
        }

        .engine-table td:last-child {
            border-right: none;
        }

        .engine-table tr:hover td {
            background: #f8fafc;
        }

        .engine-table tr:last-child td {
            border-bottom: none;
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
            letter-spacing: 1px;
            box-shadow: 4px 4px 0px 0px #000;
            text-decoration: none;
        }

        .btn-sq-primary:hover {
            transform: translate(-3px, -3px);
            box-shadow: 7px 7px 0px 0px #000;
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

        .btn-sq-danger:disabled {
            background: #f1f5f9;
            color: #94a3b8;
            border-color: #cbd5e1;
            box-shadow: none;
            cursor: not-allowed;
            transform: none;
        }

        .btn-sq-danger:disabled:hover {
            transform: none;
            box-shadow: none;
            background: #f1f5f9;
            color: #94a3b8;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(8px);
            z-index: 1200;
            justify-content: center;
            align-items: flex-start;
            padding-top: 50px;
        }

        .modal-card {
            background: #fff;
            width: 500px;
            max-width: 90%;
            border: 4px solid #000;
            box-shadow: 15px 15px 0px rgba(0, 0, 0, 1);
            transform: translateY(-100px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
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
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 40px 5%;">

            <div class="engine-header">
                <div>
                    <div class="engine-title-wrapper">
                        <i class="fa-solid fa-server" style="color: var(--accent-primary); font-size: 18px;"></i>
                        <h2
                            style="font-size: 18px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">
                            Categorization Engine</h2>
                    </div>
                    <p
                        style="color: #000; font-size: 14px; margin: 0; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">
                        Manage labels and structural
                        taxonomy for platform content.</p>
                </div>

                <div style="display: flex; gap: 15px;">
                    <button onclick="openModal('add-category-modal', 'add-category-card')" class="btn-sq-primary">
                        <i class="fa-solid fa-folder-plus" style="margin-right: 8px;"></i> PUSH TAXONOMY
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn-sq-outline">
                        <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> DASHBOARD
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
                <table class="engine-table">
                    <thead>
                        <tr>
                            <th>Registry Label</th>
                            <th>System Path</th>
                            <th>Active Asset Count</th>
                            <th style="text-align: right;">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <div
                                        style="display: flex; align-items: center; gap: 12px; font-size: 15px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px;">
                                        <div
                                            style="width: 14px; height: 14px; background: var(--accent-primary); border: 2px solid #000; box-shadow: 2px 2px 0px 0px #000;">
                                        </div>
                                        {{ $category->name }}
                                    </div>
                                </td>
                                <td>
                                    <span
                                        style="font-family: 'Courier New', Courier, monospace; font-size: 12px; font-weight: 900; color: #000; background: #f8fafc; padding: 4px 8px; border: 2px solid #000; box-shadow: 2px 2px 0px 0px #000; display: inline-block;">/{{ $category->slug }}</span>
                                </td>
                                <td>
                                    @if ($category->courses_count > 0)
                                        <span
                                            style="font-size: 14px; font-weight: 900; color: #fff; background: #000; padding: 4px 10px; border: 2px solid #000; display: inline-flex; align-items: center; gap: 8px; box-shadow: 2px 2px 0px 0px var(--accent-primary);">
                                            {{ str_pad($category->courses_count, 2, '0', STR_PAD_LEFT) }} <span
                                                style="font-size: 10px; color: var(--accent-primary); border-left: 2px solid #fff; padding-left: 6px;">UNITS</span>
                                        </span>
                                    @else
                                        <span
                                            style="font-size: 14px; font-weight: 900; color: #94a3b8; background: #f1f5f9; padding: 4px 10px; border: 2px solid #cbd5e1; display: inline-flex; align-items: center; gap: 8px;">
                                            00 <span
                                                style="font-size: 10px; color: #cbd5e1; border-left: 2px solid #cbd5e1; padding-left: 6px;">UNITS</span>
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        style="margin: 0; display: inline-flex; justify-content: flex-end;"
                                        id="delete-form-{{ $category->id }}">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn-sq-danger"
                                            onclick="triggerDelete('delete-form-{{ $category->id }}', '{{ addslashes($category->name) }}')"
                                            title="Delete Category" {{ $category->courses_count > 0 ? 'disabled' : '' }}>
                                            <i class="fa-solid fa-folder-minus" style="margin-right: 6px;"></i> PURGE DATA
                                        </button>
                                    </form>
                                    @if ($category->courses_count > 0)
                                        <div
                                            style="font-size: 9px; color: #64748b; font-weight: 800; text-transform: uppercase; margin-top: 5px;">
                                            Locked (Assets Linked)</div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 60px 20px; text-align: center; border-bottom: none;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
                                        <div
                                            style="width: 80px; height: 80px; border: 3px solid #000; display: flex; align-items: center; justify-content: center; font-size: 32px; color: #cbd5e1; background: #f8fafc; box-shadow: 6px 6px 0px 0px #000;">
                                            <i class="fa-solid fa-database"></i>
                                        </div>
                                        <h3
                                            style="font-size: 16px; font-weight: 900; color: #000; margin: 0; text-transform: uppercase;">
                                            Empty Registry</h3>
                                        <p
                                            style="color: #64748b; font-size: 13px; font-weight: 800; margin: 0; text-transform: uppercase;">
                                            Taxonomy is currently empty. Define new categories to organize content.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($categories->hasPages())
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
                        {{ $categories->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="add-category-modal" class="modal-overlay">
        <div id="add-category-card" class="modal-card">
            <div
                style="padding: 25px; border-bottom: 3px solid #000; display: flex; justify-content: space-between; align-items: center; background: #000; color: #fff;">
                <h3
                    style="font-size: 16px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-folder-plus" style="color: var(--accent-primary);"></i> Initialize Taxonomy
                </h3>
                <button onclick="closeModal('add-category-modal', 'add-category-card')"
                    style="background:none; border:none; font-size: 24px; color: #fff; cursor:pointer; line-height: 1; transition: 0.2s;"
                    onmouseover="this.style.color='var(--accent-primary)'" onmouseout="this.style.color='#fff'"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST" style="padding: 30px;">
                @csrf
                <div style="margin-bottom: 30px;">
                    <label
                        style="display:block; font-size: 12px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; color: #000; margin-bottom: 12px; border-left: 4px solid var(--accent-primary); padding-left: 8px;">
                        Registry Label
                    </label>
                    <input type="text" name="name" placeholder="E.G. WEB DEVELOPMENT" required class="sq-input">
                    <div
                        style="font-size: 10px; color: #000; margin-top: 12px; font-weight: 800; background: #f8fafc; padding: 8px 12px; border: 2px dashed #cbd5e1; display: flex; align-items: center; gap: 8px; text-transform: uppercase;">
                        <i class="fa-solid fa-gear" style="color: var(--text-secondary);"></i> System will generate unique
                        slug internally.
                    </div>
                </div>
                <div style="display: flex; gap: 15px;">
                    <button type="submit"
                        style="flex: 1; background: var(--accent-primary); color: #fff; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 4px 4px 0px 0px #000; transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='6px 6px 0px 0px #000';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='4px 4px 0px 0px #000';">
                        COMMIT TAXONOMY
                    </button>
                    <button type="button" onclick="closeModal('add-category-modal', 'add-category-card')"
                        style="flex: 1; background: #fff; color: #000; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 4px 4px 0px 0px #000; transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='6px 6px 0px 0px #000'; this.style.background='#f8fafc';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='4px 4px 0px 0px #000'; this.style.background='#fff';">
                        ABORT
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Custom Confirmation Modal (Purge) -->
    <div id="confirm-modal" class="modal-overlay">
        <div id="confirm-card" class="modal-card">
            <div style="padding: 40px; text-align: center;">
                <div
                    style="width: 80px; height: 80px; background: #fff; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px; border: 3px solid #000; box-shadow: 6px 6px 0px 0px #e11d48; color: #e11d48; position: relative;">
                    <i class="fa-solid fa-folder-minus" style="opacity: 0.15; position: absolute; font-size: 50px;"></i>
                    <i class="fa-solid fa-triangle-exclamation" style="position: relative;"></i>
                </div>
                <h3
                    style="font-size: 20px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; color: #000; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 15px;">
                    Confidential Purge
                </h3>
                <p
                    style="font-size: 14px; color: #000; font-weight: 700; line-height: 1.6; margin-bottom: 35px; text-transform: uppercase;">
                    Are you sure you want to delete <br><br> <span id="taxonomy-name"
                        style="background: #e11d48; color: #fff; padding: 4px 10px; font-weight: 900; border: 2px solid #000; display: inline-block; margin-bottom: 15px;">[TAXONOMY]</span>
                    <br><br>
                    <span style="border-bottom: 2px solid #000; padding-bottom: 2px;">This structural data will be
                        permanently<br>removed from the system registry.</span>
                </p>
                <div style="display: flex; gap: 20px; justify-content: center;">
                    <button id="confirm-yes"
                        style="flex: 1; background: #e11d48; color: #fff; border: 2px solid #000; padding: 15px; font-size: 13px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 6px 6px 0px 0px #000; transition: all 0.2s ease;"
                        onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='8px 8px 0px 0px #000';"
                        onmouseout="this.style.transform='translate(0, 0)'; this.style.boxShadow='6px 6px 0px 0px #000';">
                        CONFIRM PURGE
                    </button>
                    <button onclick="closeModal('confirm-modal', 'confirm-card')"
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
        let currentDeleteForm = null;

        function openModal(modalId, cardId) {
            const modal = document.getElementById(modalId);
            const card = document.getElementById(cardId);
            modal.style.display = 'flex';
            setTimeout(() => {
                card.style.transform = 'translateY(0)';
                card.style.opacity = '1';
            }, 10);
        }

        function closeModal(modalId, cardId) {
            const card = document.getElementById(cardId);
            const modal = document.getElementById(modalId);
            card.style.transform = 'translateY(-100px)';
            card.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 400);
        }

        function triggerDelete(formId, taxonomyName) {
            currentDeleteForm = document.getElementById(formId);
            document.getElementById('taxonomy-name').innerText = taxonomyName;
            openModal('confirm-modal', 'confirm-card');
        }

        document.getElementById('confirm-yes').addEventListener('click', function() {
            if (currentDeleteForm) {
                currentDeleteForm.submit();
            }
        });
    </script>
@endsection
