@extends('layouts.app')

@section('content')
<div style="padding: 60px 5%; max-width: 1200px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px; border-bottom: 4px solid #000; padding-bottom: 20px;">
        <div>
            <h1 style="font-size: 32px; font-weight: 950; text-transform: uppercase; letter-spacing: -1px; margin: 0;">
                <i class="fa-solid fa-bullhorn" style="color: #f43f5e; margin-right: 10px;"></i> Manajemen Banner Promo
            </h1>
            <p style="font-size: 14px; font-weight: 700; color: #64748b; margin-top: 5px; text-transform: uppercase; letter-spacing: 1px;">
                Atur banner penawaran yang muncul di bagian paling atas aplikasi.
            </p>
        </div>
        @if(Auth::user()->role === 'admin')
            <div style="background: #000; color: #fff; padding: 5px 15px; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; border: 2px solid #000; box-shadow: 4px 4px 0px #10b981;">
                Mode Admin: Kendali Penuh
            </div>
        @endif
    </div>

    <div style="display: grid; grid-template-columns: 1fr 380px; gap: 40px; align-items: start;">
        <!-- Banner List -->
        <div>
            <h3 style="font-size: 18px; font-weight: 900; text-transform: uppercase; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-list-check" style="color: #10b981;"></i> Daftar Koleksi Banner
            </h3>

            @forelse($banners as $banner)
                <div style="background: #fff; border: 3px solid #000; padding: 25px; margin-bottom: 25px; box-shadow: 8px 8px 0px #000; position: relative; transition: 0.2s;" 
                     onmouseover="this.style.transform='translate(-2px, -2px)'; this.style.boxShadow='10px 10px 0px #000'"
                     onmouseout="this.style.transform='none'; this.style.boxShadow='8px 8px 0px #000'">
                    
                    @if($banner->is_active)
                        <div style="position: absolute; top: -15px; right: 20px; background: #10b981; color: #000; padding: 5px 15px; font-size: 10px; font-weight: 950; border: 2px solid #000; box-shadow: 3px 3px 0px #000; text-transform: uppercase; letter-spacing: 1px;">
                            <i class="fa-solid fa-circle-check"></i> Sedang Aktif
                        </div>
                    @endif

                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="width: 50px; height: 50px; background: #f1f5f9; border: 2px solid #000; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
                            {{ $banner->emoji }}
                        </div>
                        <div style="flex-grow: 1;">
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                                <span style="background: #f43f5e; color: #fff; padding: 2px 8px; font-size: 10px; font-weight: 900; border: 1px solid #000;">{{ $banner->badge_text }}</span>
                                <span style="font-weight: 900; font-size: 14px; text-transform: uppercase;">{{ $banner->title }}</span>
                            </div>
                            <p style="font-weight: 700; color: #334155; font-size: 14px; line-height: 1.5; margin-bottom: 15px;">{{ $banner->message }}</p>
                            
                            <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                                <div style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">
                                    Dibuat oleh: <span style="color: #000;">{{ $banner->user->name }}</span> • {{ $banner->created_at->diffForHumans() }}
                                </div>
                                <div style="display: flex; gap: 10px;">
                                    <form action="{{ route('banners.toggle', $banner) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" style="background: {{ $banner->is_active ? '#64748b' : '#000' }}; color: #fff; border: 2px solid #000; padding: 8px 15px; font-size: 10px; font-weight: 900; text-transform: uppercase; cursor: pointer; box-shadow: 3px 3px 0px #10b981;">
                                            {{ $banner->is_active ? 'Matikan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Hapus banner ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #fff; color: #ef4444; border: 2px solid #000; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 3px 3px 0px #ef4444;">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="padding: 60px; border: 4px dashed #cbd5e1; text-align: center; background: #f8fafc;">
                    <i class="fa-solid fa-layer-group" style="font-size: 40px; color: #cbd5e1; margin-bottom: 20px;"></i>
                    <p style="font-weight: 800; color: #64748b; text-transform: uppercase;">Belum ada banner yang dibuat.</p>
                </div>
            @endforelse
        </div>

        <!-- Create Form -->
        <div style="position: sticky; top: 120px;">
            <div style="background: #000; border: 4px solid #000; padding: 30px; box-shadow: 12px 12px 0px #10b981;">
                <h3 style="color: #fff; font-size: 18px; font-weight: 900; text-transform: uppercase; margin-bottom: 25px; letter-spacing: 1px;">
                    <i class="fa-solid fa-plus-circle" style="color: #10b981; margin-right: 8px;"></i> Buat Banner Baru
                </h3>
                
                <form action="{{ route('banners.store') }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; color: #94a3b8; font-size: 10px; font-weight: 900; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 1px;">Isi Pesan Banner</label>
                        <textarea name="message" required style="width: 100%; padding: 15px; border: 2px solid #333; background: #1a1a1a; color: #fff; font-family: inherit; font-weight: 600; font-size: 13px;" rows="3" placeholder="Contoh: Dapatkan diskon 50% untuk semua kursus pemrograman minggu ini!"></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; color: #94a3b8; font-size: 10px; font-weight: 900; text-transform: uppercase; margin-bottom: 8px;">Badge (Max 20)</label>
                            <input type="text" name="badge_text" placeholder="HOT!" style="width: 100%; padding: 10px; border: 2px solid #333; background: #1a1a1a; color: #fff; font-weight: 800; font-size: 12px;">
                        </div>
                        <div>
                            <label style="display: block; color: #94a3b8; font-size: 10px; font-weight: 900; text-transform: uppercase; margin-bottom: 8px;">Emoji</label>
                            <input type="text" name="emoji" placeholder="🚨" style="width: 100%; padding: 10px; border: 2px solid #333; background: #1a1a1a; color: #fff; font-weight: 800; font-size: 12px;">
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; color: #94a3b8; font-size: 10px; font-weight: 900; text-transform: uppercase; margin-bottom: 8px;">Judul Banner</label>
                        <input type="text" name="title" placeholder="PERHATIAN:" style="width: 100%; padding: 10px; border: 2px solid #333; background: #1a1a1a; color: #fff; font-weight: 800; font-size: 12px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; color: #94a3b8; font-size: 10px; font-weight: 900; text-transform: uppercase; margin-bottom: 8px;">Teks Tombol</label>
                        <input type="text" name="button_text" placeholder="AMBIL SEKARANG" style="width: 100%; padding: 10px; border: 2px solid #333; background: #1a1a1a; color: #fff; font-weight: 800; font-size: 12px;">
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="display: block; color: #94a3b8; font-size: 10px; font-weight: 900; text-transform: uppercase; margin-bottom: 8px;">Link Tombol (URL atau Route)</label>
                        <input type="text" name="button_link" placeholder="{{ route('register') }}" style="width: 100%; padding: 10px; border: 2px solid #333; background: #1a1a1a; color: #fff; font-weight: 800; font-size: 12px;">
                    </div>

                    <button type="submit" style="width: 100%; background: #10b981; color: #000; border: 2px solid #000; padding: 15px; font-weight: 950; text-transform: uppercase; cursor: pointer; transition: 0.2s; box-shadow: 6px 6px 0px #fff;">
                        SIMPAN BANNER <i class="fa-solid fa-save" style="margin-left: 5px;"></i>
                    </button>
                </form>
            </div>
            
            <div style="margin-top: 20px; padding: 20px; background: #fefce8; border: 2px solid #000; font-size: 11px; font-weight: 700; color: #854d0e; text-transform: uppercase;">
                <i class="fa-solid fa-circle-info"></i> Hanya satu banner yang dapat aktif dalam satu waktu secara global.
            </div>
        </div>
    </div>
</div>
@endsection
