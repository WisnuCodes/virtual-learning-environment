@extends('layouts.app')

@section('content')
    <style>
        .edit-header {
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-bottom: 20px;
            border-bottom: 3px solid #000;
        }

        .form-card {
            background: #ffffff;
            border: 4px solid #000;
            border-radius: 0;
            box-shadow: 12px 12px 0px 0px var(--accent-primary);
            overflow: hidden;
            margin-bottom: 40px;
            position: relative;
        }

        .form-card-header {
            background: #000;
            padding: 15px 25px;
            border-bottom: 4px solid #000;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .input-sq {
            width: 100%;
            padding: 14px;
            font-size: 14px;
            font-weight: 700;
            border: 3px solid #000;
            border-radius: 0;
            font-family: inherit;
            background: #fff;
            outline: none;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 4px 4px 0px 0px #000;
        }

        .input-sq:focus {
            transform: translate(-3px, -3px);
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
            border-color: #000;
        }

        .custom-select {
            appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2220%22%20height%3D%2220%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M5%208l5%205%205-5%22%20stroke%3D%22%23000000%22%20stroke-width%3D%223%22%20fill%3D%22none%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3C%2Fsvg%3E');
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 18px;
            padding-right: 45px;
        }

        .sq-label {
            display: block;
            font-size: 11px;
            font-weight: 900;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .btn-sq-primary {
            background: var(--accent-primary);
            color: #fff;
            border: 3px solid #000;
            padding: 15px 30px;
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 6px 6px 0px 0px #000;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-sq-primary:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000;
        }

        .btn-sq-outline {
            background: #fff;
            color: #000;
            border: 3px solid #000;
            padding: 14px 25px;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            box-shadow: 4px 4px 0px 0px #000;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-sq-outline:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #000;
            background: #f8fafc;
        }

        @media (max-width: 768px) {
            .form-grid-3 {
                grid-template-columns: 1fr !important;
            }
        }
    </style>

    <div
        style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px; position: relative; overflow: hidden;">
        <!-- Background Text Decor -->
        <div
            style="position: absolute; top: 10%; right: -5%; font-size: 180px; color: rgba(0,0,0,0.03); font-weight: 900; pointer-events: none; z-index: 0; transform: rotate(10deg); white-space: nowrap;">
            MOD_COURSE
        </div>

        <div style="max-width: 850px; margin: 0 auto; padding: 40px 5%; position: relative; z-index: 1;">

            <div class="edit-header">
                <div>
                    <h2
                        style="font-size: 32px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: -1px; margin: 0; margin-bottom: 5px;">
                        Edit Kursus
                    </h2>
                    <p style="color: #64748b; font-size: 14px; margin: 0; font-weight: 700; text-transform: uppercase;">
                        Pengaturan parameter untuk: <span
                            style="background: #000; color: #fff; padding: 2px 8px; margin-left: 5px;">{{ $course->title }}</span>
                    </p>
                </div>
                <a href="{{ route('instructor.dashboard') }}" class="btn-sq-outline">
                    <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Kembali
                </a>
            </div>

            @if ($errors->any())
                <div
                    style="background: #fff; border: 3px solid #000; color: #e11d48; padding: 20px; margin-bottom: 30px; font-size: 12px; font-weight: 900; text-transform: uppercase; box-shadow: 6px 6px 0px 0px #e11d48; display: flex; align-items: flex-start; gap: 15px;">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size: 24px;"></i>
                    <div>
                        <ul style="margin: 0; padding: 0; list-style: none;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="form-card">
                <div class="form-card-header">
                    <span
                        style="font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 2px; display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-screwdriver-wrench" style="color: var(--accent-primary);"></i> Spesifikasi Utama
                    </span>
                    <span style="font-size: 9px; font-weight: 900; opacity: 0.5;">ID: {{ $course->id }}</span>
                </div>

                <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST"
                    enctype="multipart/form-data" style="padding: 35px;">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 30px;">
                        <label class="sq-label">Judul Kursus</label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}" required
                            class="input-sq" style="font-size: 16px;">
                    </div>

                    <div class="form-grid-4"
                        style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
                        <div>
                            <label class="sq-label">Kategori</label>
                            <select name="category_id" required class="input-sq custom-select" style="font-size: 13px;">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ strtoupper($category->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="sq-label">Harga (Rp)</label>
                            <input type="number" step="0.01" name="price" id="price_input"
                                value="{{ old('price', $course->price) }}" required class="input-sq"
                                {{ $course->price == 0 ? 'readonly' : '' }}>
                        </div>
                        <div>
                            <label class="sq-label" style="color: #e11d48;">Diskon (Rp)</label>
                            <input type="number" step="0.01" name="discount_price" id="discount_input"
                                value="{{ old('discount_price', $course->discount_price) }}" class="input-sq"
                                style="background: #fff1f2; border-color: #fda4af;"
                                {{ $course->price == 0 ? 'readonly' : '' }}>
                        </div>
                        <div>
                            <label class="sq-label" style="color: #e11d48;">Batas Diskon</label>
                            <input type="datetime-local" name="discount_until" id="discount_until_input"
                                value="{{ old('discount_until', $course->discount_until ? $course->discount_until->format('Y-m-d\TH:i') : '') }}" class="input-sq"
                                style="background: #fff1f2; border-color: #fda4af;"
                                {{ $course->price == 0 ? 'readonly' : '' }}>
                        </div>
                    </div>

                    <!-- Free Asset Toggle Section -->
                    <div
                        style="margin-bottom: 30px; background: #f8fafc; border: 3px solid #000; padding: 20px; display: flex; align-items: center; gap: 15px; box-shadow: 6px 6px 0px 0px #000;">
                        <input type="checkbox" id="is_free_toggle" {{ $course->price == 0 ? 'checked' : '' }}
                            style="width: 24px; height: 24px; cursor: pointer; accent-color: var(--accent-primary);">
                        <label for="is_free_toggle"
                            style="font-size: 13px; font-weight: 900; color: #000; text-transform: uppercase; cursor: pointer;">
                            <i class="fa-solid fa-gift" style="margin-right: 8px; color: var(--accent-primary);"></i> Tandai
                            sebagai Kursus Gratis
                        </label>
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label class="sq-label">Deskripsi Lengkap</label>
                        <textarea name="description" rows="6" required class="input-sq"
                            style="resize: vertical; font-weight: 500; font-size: 14px; line-height: 1.6;">{{ old('description', $course->description) }}</textarea>
                    </div>

                    <div style="margin-bottom: 40px; background: #f1f5f9; border: 3px dashed #000; padding: 30px;">
                        <label class="sq-label" style="margin-bottom: 20px;"><i class="fa-solid fa-camera-retro"
                                style="margin-right: 8px;"></i> Identitas Visual (Gambar Pratinjau)</label>

                        <div style="display: grid; grid-template-columns: 220px 1fr; gap: 30px;">
                            <div
                                style="background: #000; padding: 8px; border: 2px solid #000; box-shadow: 6px 6px 0px 0px var(--accent-primary);">
                                <img src="{{ $course->thumbnail }}"
                                    style="width: 100%; aspect-ratio: 16/9; object-fit: cover; border: 1px solid #fff;">
                                <div
                                    style="color: #fff; font-size: 9px; font-weight: 900; text-align: center; margin-top: 5px; text-transform: uppercase;">
                                    Gambar Saat Ini</div>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 20px;">
                                <div>
                                    <label style="display:block; font-size: 10px; font-weight: 900; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">A. Unggah File Gambar Baru</label>
                                    <input type="file" name="thumbnail_file" accept="image/*" class="input-sq"
                                        style="padding: 10px; font-size: 12px; border-style: dashed; background: #fff;">
                                </div>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div style="flex: 1; height: 2px; background: #cbd5e1;"></div>
                                    <span style="font-size: 10px; font-weight: 900; color: #94a3b8;">ATAU TAUTAN</span>
                                    <div style="flex: 1; height: 2px; background: #cbd5e1;"></div>
                                </div>
                                <div>
                                    <label style="display:block; font-size: 10px; font-weight: 900; color: #64748b; margin-bottom: 8px; text-transform: uppercase;">B. URL Gambar Jarak Jauh</label>
                                    <input type="url" name="thumbnail"
                                        value="{{ old('thumbnail', $course->thumbnail) }}"
                                        placeholder="https://cdn.nexus.io/asset.jpg" class="input-sq">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        style="display: flex; justify-content: flex-end; gap: 20px; padding-top: 30px; border-top: 4px solid #000;">
                        <button type="submit" class="btn-sq-primary">
                            <i class="fa-solid fa-cloud-arrow-up" style="margin-right: 10px;"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
                priceInput.style.transform = 'none';
                priceInput.style.boxShadow = 'none';

                discountInput.value = '';
                discountInput.readOnly = true;
                discountInput.style.background = '#f1f5f9';
                discountInput.style.transform = 'none';
                discountInput.style.boxShadow = 'none';

                discountUntilInput.value = '';
                discountUntilInput.readOnly = true;
                discountUntilInput.style.background = '#f1f5f9';
                discountUntilInput.style.transform = 'none';
                discountUntilInput.style.boxShadow = 'none';
            } else {
                priceInput.readOnly = false;
                priceInput.style.background = '#fff';
                priceInput.style.boxShadow = '4px 4px 0px 0px #000';

                discountInput.readOnly = false;
                discountInput.style.background = '#fff1f2';
                discountInput.style.boxShadow = '4px 4px 0px 0px #000';

                discountUntilInput.readOnly = false;
                discountUntilInput.style.background = '#fff1f2';
                discountUntilInput.style.boxShadow = '4px 4px 0px 0px #000';
            }
        });

        // Initialize state if pre-checked
        if (document.getElementById('is_free_toggle').checked) {
            const priceInput = document.getElementById('price_input');
            const discountInput = document.getElementById('discount_input');
            const discountUntilInput = document.getElementById('discount_until_input');

            priceInput.style.background = '#f1f5f9';
            priceInput.style.boxShadow = 'none';
            discountInput.style.background = '#f1f5f9';
            discountInput.style.boxShadow = 'none';
            discountUntilInput.style.background = '#f1f5f9';
            discountUntilInput.style.boxShadow = 'none';
        }
    </script>
@endsection
