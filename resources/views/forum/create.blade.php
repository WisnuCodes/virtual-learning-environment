@extends('layouts.app')

@section('content')
    <style>
        .forum-header {
            background: #fff;
            padding: 40px 5%;
            border-bottom: 3px solid #000;
        }

        .forum-container {
            max-width: 1000px;
            margin: 40px auto 80px;
            padding: 0 5%;
        }

        .form-card {
            background: #fff;
            border: 3px solid #000;
            padding: 40px;
            box-shadow: 12px 12px 0px 0px #000;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 950;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 15px;
            border: 3px solid #000;
            font-weight: 700;
            font-size: 15px;
            outline: none;
            transition: 0.2s;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
            transform: translate(-2px, -2px);
        }

        .btn-submit {
            background: #000;
            color: #fff;
            border: 3px solid #000;
            padding: 15px 30px;
            font-weight: 950;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
            transition: 0.2s;
        }

        .btn-submit:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
        }
    </style>

    <div class="forum-header">
        <div style="max-width: 1000px; margin: 0 auto;">
            <a href="{{ route('forum.index') }}" style="color: #000; text-decoration: none; font-weight: 900; font-size: 13px; text-transform: uppercase; display: flex; align-items: center; gap: 8px; margin-bottom: 20px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Forum
            </a>
            <h1 style="font-size: 42px; font-weight: 950; text-transform: uppercase; letter-spacing: -2px;">Buat <span style="color: var(--accent-primary);">Diskusi Baru</span></h1>
            <p style="font-weight: 800; color: #64748b;">Mulai percakapan baru dengan komunitas.</p>
        </div>
    </div>

    <div class="forum-container">
        <div class="form-card">
            <form action="{{ route('forum.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Pilih Kategori</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (isset($category) && $category->id == $cat->id) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Diskusi</label>
                    <input type="text" name="title" class="form-input" placeholder="Masukkan judul yang jelas..." required>
                </div>

                <div class="form-group">
                    <label class="form-label">Konten Diskusi</label>
                    <textarea name="content" class="form-textarea" rows="10" placeholder="Apa yang ingin Anda bahas?" required></textarea>
                </div>

                <button type="submit" class="btn-submit">Posting Diskusi</button>
            </form>
        </div>
    </div>
@endsection
