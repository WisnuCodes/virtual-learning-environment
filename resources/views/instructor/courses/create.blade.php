@extends('layouts.app')

@section('content')
    <style>
        .create-header {
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-bottom: 15px;
            border-bottom: 2px solid #000;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            background: #fff;
            padding: 20px;
            border: 2px dashed #000;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding-top: 25px;
            border-top: 2px solid #000;
            margin-top: 30px;
        }

        .input-sq {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            font-weight: 700;
            border: 2px solid #000;
            border-radius: 0;
            font-family: 'Poppins', sans-serif;
            background: #fff;
            outline: none;
            transition: all 0.2s ease;
            box-shadow: 2px 2px 0px 0px #000;
        }

        .input-sq:focus {
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
            border-color: #000;
        }

        .input-error {
            background: #fff1f2;
            border-color: #e11d48;
            box-shadow: 2px 2px 0px 0px #e11d48;
        }

        .input-error:focus {
            box-shadow: 4px 4px 0px 0px #e11d48;
        }

        .custom-select {
            width: 100%;
            padding: 12px;
            font-size: 13px;
            font-weight: 800;
            border: 2px solid #000;
            border-radius: 0;
            font-family: inherit;
            background: #fff;
            outline: none;
            cursor: pointer;
            text-transform: uppercase;
            box-sizing: border-box;
            appearance: none;
            -webkit-appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2220%22%20height%3D%2220%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M5%208l5%205%205-5%22%20stroke%3D%22%23000000%22%20stroke-width%3D%223%22%20fill%3D%22none%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fsvg%3E');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            padding-right: 35px;
            box-shadow: 2px 2px 0px 0px #000;
            transition: all 0.2s ease;
        }

        .custom-select:focus {
            transform: translate(-2px, -2px);
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
        }

        .btn-sq-primary {
            background: var(--accent-primary);
            color: #fff;
            border: 2px solid #000;
            padding: 12px 24px;
            border-radius: 0;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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
            padding: 12px 24px;
            border-radius: 0;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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

        label.sq-label {
            display: block;
            font-size: 12px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .form-card {
            background: #ffffff;
            border: 3px solid #000;
            border-radius: 0;
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
            overflow: hidden;
            margin-bottom: 40px;
        }

        .form-card-header {
            background: var(--accent-primary);
            padding: 15px 25px;
            border-bottom: 3px solid #000;
            color: #fff;
        }

        @media (max-width: 768px) {
            .create-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .create-header>a {
                width: 100%;
                justify-content: center;
                display: flex;
            }

            .form-grid-3 {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .thumbnail-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
                width: 100%;
            }

            .form-actions button,
            .form-actions a {
                width: 100%;
                justify-content: center;
                display: flex;
            }
        }
    </style>
    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
        <div style="max-width: 800px; margin: 0 auto; padding: 40px 5%;">

            <div class="create-header">
                <div>
                    <h2
                        style="font-size: 28px; font-weight: 900; color: var(--text-primary); text-transform: uppercase; letter-spacing: -0.5px; margin: 0; margin-bottom: 4px;">
                        Buat Kursus Baru</h2>
                    <p style="color: var(--text-secondary); font-size: 14px; margin: 0; font-weight: 500;">Tentukan aset kurikulum utama dan posisinya di pasar.</p>
                </div>
                <a href="{{ route('instructor.dashboard') }}" class="btn-sq-outline">
                    <i class="fa-solid fa-arrow-left" style="margin-right: 6px;"></i> Kembali
                </a>
            </div>

            @if ($errors->any())
                <div
                    style="background: #fff1f2; border: 2px solid #000; color: #b91c1c; padding: 15px 20px; margin-bottom: 25px; font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 4px 4px 0px 0px #e11d48;">
                    <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 5px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-card">
                <div class="form-card-header">
                    <span
                        style="font-size: 13px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-cube"></i> Informasi Dasar Kursus
                    </span>
                </div>

                <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data"
                    style="padding: 30px;">
                    @csrf

                    <div style="margin-bottom: 24px;">
                        <label class="sq-label">Judul Kursus</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            placeholder="CONTOH: ARSITEKTUR SISTEM LANJUTAN" class="input-sq"
                            style="font-size: 16px; text-transform: uppercase;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                        <div>
                            <label class="sq-label">Kategori</label>
                            <select name="category_id" required class="custom-select">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="sq-label">Harga (Rp)</label>
                            <input type="number" step="0.01" name="price" id="price_input"
                                value="{{ old('price', '0.00') }}" required class="input-sq">
                        </div>
                        <div>
                            <label class="sq-label" style="color: #e11d48;">Diskon (Rp)</label>
                            <input type="number" step="0.01" name="discount_price" id="discount_input"
                                value="{{ old('discount_price') }}" placeholder="OPSIONAL" class="input-sq input-error">
                        </div>
                        <div>
                            <label class="sq-label" style="color: #e11d48;">Batas Diskon</label>
                            <input type="datetime-local" name="discount_until" id="discount_until_input"
                                value="{{ old('discount_until') }}" class="input-sq input-error">
                        </div>
                    </div>

                    <div
                        style="margin-bottom: 24px; background: #f8fafc; border: 2px solid #000; padding: 15px; display: flex; align-items: center; gap: 12px; box-shadow: 4px 4px 0px 0px #000;">
                        <input type="checkbox" id="is_free_toggle"
                            style="width: 20px; height: 20px; cursor: pointer; accent-color: var(--accent-primary);">
                        <label for="is_free_toggle"
                            style="font-size: 13px; font-weight: 900; color: #000; text-transform: uppercase; cursor: pointer;">
                            <i class="fa-solid fa-gift" style="margin-right: 6px; color: var(--accent-primary);"></i> Tandai
                            sebagai Kursus Gratis
                        </label>
                    </div>

                    <script>
                        document.getElementById('is_free_toggle').addEventListener('change', function() {
                            const priceInput = document.getElementById('price_input');
                            const discountInput = document.getElementById('discount_input');
                            const discountUntilInput = document.getElementById('discount_until_input');
                            if (this.checked) {
                                priceInput.value = '0.00';
                                priceInput.readOnly = true;
                                priceInput.style.background = '#f1f5f9';
                                discountInput.value = '';
                                discountInput.readOnly = true;
                                discountInput.style.background = '#f1f5f9';
                                discountUntilInput.value = '';
                                discountUntilInput.readOnly = true;
                                discountUntilInput.style.background = '#f1f5f9';
                            } else {
                                priceInput.readOnly = false;
                                priceInput.style.background = '#fff';
                                discountInput.readOnly = false;
                                discountInput.style.background = '#fff1f2';
                                discountUntilInput.readOnly = false;
                                discountUntilInput.style.background = '#fff1f2';
                            }
                        });
                    </script>

                    <div style="margin-bottom: 24px;">
                        <label class="sq-label">Deskripsi Lengkap</label>
                        <textarea name="description" rows="5" required
                            placeholder="Tuliskan tujuan internal kursus dan hasil pembelajaran..." class="input-sq"
                            style="resize: vertical;">{{ old('description') }}</textarea>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label class="sq-label">Gambar Pratinjau (Thumbnail)</label>

                        <div class="thumbnail-grid">
                            <div>
                                <span
                                    style="font-size: 10px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 8px;">
                                    <i class="fa-solid fa-upload" style="margin-right: 4px;"></i> Unggah File Gambari
                                </span>
                                <input type="file" name="thumbnail_file" accept="image/*" class="input-sq"
                                    style="padding: 8px; font-size: 12px; cursor: pointer;">
                            </div>
                            <div>
                                <span
                                    style="font-size: 10px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 8px;">
                                    <i class="fa-solid fa-link" style="margin-right: 4px;"></i> URL Gambar Jarak Jauh
                                </span>
                                <input type="url" name="thumbnail" value="{{ old('thumbnail') }}"
                                    placeholder="https://registry.io/asset.jpg" class="input-sq">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('instructor.dashboard') }}" class="btn-sq-outline">
                            <i class="fa-solid fa-xmark" style="margin-right: 6px;"></i> Batal
                        </a>
                        <button type="submit" class="btn-sq-primary">
                            <i class="fa-solid fa-cloud-arrow-up" style="margin-right: 6px;"></i> Simpan Kursus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
