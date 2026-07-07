@extends('layouts.app')

@section('content')
<div style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
    <div style="max-width: 800px; margin: 0 auto; padding: 40px 5%;">
        
        <div style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 3px solid #000; padding-bottom: 15px;">
            <div>
                <h1 style="font-size: 28px; font-weight: 900; color: #000; margin: 0; text-transform: uppercase;">Materi Baru</h1>
                <p style="color: #475569; font-size: 14px; font-weight: 700; margin: 5px 0 0 0;">Menambahkan materi ke bagian: <strong style="color: #000;">{{ $section->title }}</strong></p>
            </div>
            <a href="{{ route('instructor.curriculum.index', $course->id) }}" class="btn-sq-outline" style="background: #fff; color: #000; border: 2px solid #000; padding: 10px 16px; font-size: 12px; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; text-transform: uppercase; box-shadow: 3px 3px 0px 0px #000; transition: 0.2s;">
                <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Kembali
            </a>
        </div>

        <div style="background: #fff; border: 3px solid #000; box-shadow: 8px 8px 0px 0px var(--accent-primary);">
            <div style="background: var(--accent-primary); padding: 15px 25px; border-bottom: 3px solid #000;">
                <h3 style="font-size: 15px; font-weight: 900; color: #fff; margin: 0; text-transform: uppercase; letter-spacing: 1px;"><i class="fa-solid fa-plus-circle" style="margin-right: 8px;"></i> Detail Materi Unit</h3>
            </div>
            
            <form action="{{ route('instructor.lessons.store', [$course->id, $section->id]) }}" method="POST" enctype="multipart/form-data" style="padding: 30px;">
                @csrf
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Judul Materi</label>
                    <input type="text" name="title" required placeholder="CONTOH: KONSEP DASAR" style="width: 100%; padding: 12px; font-size: 14px; font-weight: 700; border: 2px solid #000; background: #fff; box-shadow: 2px 2px 0px 0px #000; outline: none; text-transform: uppercase; box-sizing: border-box;">
                </div>
                
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Tautan YouTube / Eksternal (Eksternal)</label>
                    <input type="url" name="video_url" placeholder="https://registry.io/asset" style="width: 100%; padding: 12px; font-size: 14px; font-weight: 700; border: 2px solid #000; background: #fff; box-shadow: 2px 2px 0px 0px #000; outline: none; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Upload File Video Lokal (Opsional)</label>
                    <input type="file" name="video_file" accept="video/mp4,video/x-m4v,video/*" style="width: 100%; padding: 12px; font-size: 14px; font-weight: 700; border: 2px solid #000; background: #fff; box-shadow: 2px 2px 0px 0px #000; outline: none; cursor: pointer; box-sizing: border-box;">
                    <small style="color: #64748b; font-weight: 700; margin-top: 6px; display: block;">Maksimal ukuran 200MB. Jika diisi, tautan YouTube/Eksternal di atas akan diabaikan.</small>
                </div>
                
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 12px; font-weight: 900; color: #000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Materi Teks</label>
                    <textarea name="content" rows="6" placeholder="Opsional materi dokumentasi tambahan..." style="width: 100%; padding: 12px; font-size: 14px; font-weight: 500; border: 2px solid #000; background: #fff; box-shadow: 2px 2px 0px 0px #000; outline: none; resize: vertical; box-sizing: border-box;"></textarea>
                </div>

                <div style="margin-bottom: 30px; border: 2px solid #000; padding: 15px; background: #f8fafc;">
                    <label style="display:flex; align-items:center; gap:12px; cursor:pointer; font-size: 14px; font-weight: 900; color: #000; text-transform: uppercase;">
                        <input type="checkbox" name="is_free_preview" value="1" style="width: 20px; height: 20px; accent-color: var(--accent-primary);">
                        <span>Buka Akses (Pratinjau Gratis)</span>
                    </label>
                </div>
                
                <div style="display: flex; gap: 15px;">
                    <button type="submit" style="flex: 1; background: var(--accent-primary); color: #fff; border: 2px solid #000; padding: 15px; font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; box-shadow: 4px 4px 0px #000; transition: 0.1s;">Simpan Materi</button>
                    <a href="{{ route('instructor.curriculum.index', $course->id) }}" style="background: #fff; color: #000; border: 2px solid #000; padding: 15px 30px; font-size: 14px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; box-shadow: 4px 4px 0px #000; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
