@extends('layouts.app')

@section('content')
<style>
    .rating-hero {
        background-color: var(--bg-primary);
        padding: 60px 5%;
        border-bottom: 4px solid #000;
        position: relative;
        overflow: hidden;
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 24px 24px;
        text-align: center;
    }

    .rating-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 60px 5%;
    }

    .nb-btn-outline {
        background: #fff;
        color: #000;
        border: 3px solid #000;
        padding: 12px 25px;
        font-size: 14px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 6px 6px 0px 0px #000;
        text-decoration: none;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .nb-btn-outline:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px 0px #000;
        background: #f8fafc;
    }

    .rating-card {
        background: #fff;
        border: 3px solid #000;
        padding: 25px;
        box-shadow: 6px 6px 0px 0px #bae6fd;
        margin-bottom: 30px;
    }

    .avg-card {
        background: #f8fafc;
        border: 4px solid #000;
        padding: 30px;
        box-shadow: 10px 10px 0px 0px var(--accent-primary);
        text-align: center;
        margin-bottom: 50px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 40px;
    }

    .pagination .page-item .page-link {
        border: 3px solid #000;
        background: #fff;
        color: #000;
        font-weight: 900;
        padding: 10px 15px;
        box-shadow: 4px 4px 0px 0px #000;
        text-decoration: none;
    }

    .pagination .page-item.active .page-link {
        background: var(--accent-primary);
        color: #fff;
    }
    
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        color: #000;
        border: 3px solid #000;
        padding: 10px 20px;
        font-weight: 900;
        font-size: 13px;
        text-transform: uppercase;
        text-decoration: none;
        box-shadow: 4px 4px 0px 0px #000;
        transition: 0.2s;
        position: absolute;
        top: 30px;
        left: 5%;
        z-index: 100;
    }

    .btn-back:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px 0px var(--accent-primary);
    }
</style>

<div class="rating-hero">
    <a href="{{ route('home') }}" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i> Beranda
    </a>
    <h1 style="font-size: 48px; font-weight: 950; text-transform: uppercase; letter-spacing: -2px; line-height: 0.9; margin-bottom: 20px;">
        Suara <span style="color: var(--accent-primary);">Pengguna</span> <br>RuangKelas
    </h1>
    <p style="font-weight: 800; color: #475569; max-width: 600px; margin: 0 auto;">
        Kami menghargai setiap masukan Anda untuk terus membangun platform pembelajaran terbaik di Indonesia.
    </p>
</div>

<div class="rating-container">
    <div class="avg-card">
        <div style="font-size: 64px; font-weight: 950; line-height: 1; margin-bottom: 10px;">{{ number_format($avgLmsRating, 1) }}</div>
        <div style="color: #fbbf24; font-size: 24px; margin-bottom: 15px;">
            @for($i=1; $i<=5; $i++)
                <i class="fa-{{ $i <= round($avgLmsRating) ? 'solid' : 'regular' }} fa-star"></i>
            @endfor
        </div>
        <h3 style="font-weight: 900; text-transform: uppercase; letter-spacing: 1px; font-size: 14px;">Rata-rata Rating dari {{ $totalLmsRatings }} Pengguna</h3>
    </div>

    <div style="display: grid; grid-template-columns: 1fr; gap: 0;">
        @foreach($lmsRatings as $rating)
            <div class="rating-card">
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                    <div style="width: 50px; height: 50px; background: #000; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 900; border: 3px solid #000;">
                        {{ substr($rating->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div style="font-weight: 900; text-transform: uppercase; font-size: 16px;">{{ $rating->user->name }}</div>
                        <div style="color: #fbbf24; font-size: 14px;">
                            @for($i=1; $i<=5; $i++)
                                <i class="fa-{{ $i <= $rating->rating ? 'solid' : 'regular' }} fa-star"></i>
                            @endfor
                        </div>
                    </div>
                    <div style="margin-left: auto; display: flex; align-items: center; gap: 10px;">
                        <div style="font-size: 12px; font-weight: 800; color: #94a3b8; background: #f1f5f9; padding: 5px 12px; border: 2px solid #000;">
                            {{ $rating->created_at->format('d M Y') }}
                        </div>
                        @if(Auth::check() && Auth::user()->role === 'admin')
                            <form id="delete-rating-{{ $rating->id }}" action="{{ route('lms-rating.destroy', $rating->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="nbConfirm('Hapus ulasan dari {{ $rating->user->name }}?', () => document.getElementById('delete-rating-{{ $rating->id }}').submit())" style="background: #ef4444; color: #fff; border: 2px solid #000; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 2px 2px 0px 0px #000; transition: 0.2s;" onmouseover="this.style.transform='translate(-1px, -1px)'; this.style.boxShadow='3px 3px 0px 0px #000;'" onmouseout="this.style.transform='none'; this.style.boxShadow='2px 2px 0px 0px #000;'">
                                    <i class="fa-solid fa-trash-can" style="font-size: 12px;"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <p style="font-weight: 700; color: #334155; font-size: 16px; line-height: 1.6; margin: 0; font-style: italic;">
                    "{{ $rating->comment ?: 'Tidak ada komentar.' }}"
                </p>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $lmsRatings->links() }}
    </div>
</div>
@endsection
