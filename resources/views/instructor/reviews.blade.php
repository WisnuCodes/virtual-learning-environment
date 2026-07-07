@extends('layouts.app')

@section('content')
<style>
    .review-card {
        background: #fff;
        border: 3px solid #000;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 10px 10px 0px 0px #000;
        transition: all 0.2s ease;
    }
    .review-card:hover {
        transform: translate(-3px, -3px);
        box-shadow: 13px 13px 0px 0px var(--accent-primary);
    }
    .rating-star { color: #fbbf24; font-size: 14px; }
    .reply-area {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 3px dashed #000;
    }
    .reply-box {
        background: #f8fafc;
        border: 2px solid #000;
        padding: 20px;
        margin-top: 15px;
        position: relative;
    }
    .reply-box::before {
        content: 'BALASAN ANDA';
        position: absolute;
        top: -12px;
        left: 20px;
        background: #000;
        color: #fff;
        font-size: 10px;
        font-weight: 900;
        padding: 4px 10px;
        letter-spacing: 1px;
    }
    .btn-sq-dark {
        background: #000;
        color: #fff;
        border: 2px solid #000;
        padding: 10px 20px;
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        cursor: pointer;
        box-shadow: 4px 4px 0px 0px var(--accent-primary);
        transition: all 0.2s;
    }
    .btn-sq-dark:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px 0px var(--accent-primary);
    }
</style>

<div style="background-color: var(--bg-secondary); min-height: calc(100vh - 73px); background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 24px 24px;">
    <div style="max-width: 1000px; margin: 0 auto; padding: 40px 5%;">
        
        <div style="margin-bottom: 40px; border-bottom: 3px solid #000; padding-bottom: 20px; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; background: #000; padding: 6px 15px; border: 2px solid #000; box-shadow: 4px 4px 0px 0px var(--accent-primary); display: inline-flex;">
                    <i class="fa-solid fa-star" style="color: var(--accent-primary); font-size: 16px;"></i>
                    <h2 style="font-size: 14px; font-weight: 900; color: #fff; text-transform: uppercase; letter-spacing: 1.5px; margin: 0;">Ulasan Kursus</h2>
                </div>
                <p style="color: #000; font-size: 18px; margin: 0; font-weight: 900; text-transform: uppercase; letter-spacing: -0.5px; margin-top: 15px;">Kritik & Saran dari Siswa Anda</p>
            </div>
            <a href="{{ route('instructor.dashboard') }}" class="btn-sq-dark" style="background: #fff; color: #000; box-shadow: 4px 4px 0px 0px #000;">
                <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Dashboard
            </a>
        </div>

        @if(session('success'))
            <div style="background: #ecfdf5; border: 2px solid #000; color: #059669; padding: 15px 20px; margin-bottom: 30px; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 5px 5px 0px 0px #10b981;">
                <i class="fa-solid fa-circle-check" style="margin-right: 10px;"></i> {{ session('success') }}
            </div>
        @endif

        <div class="reviews-list">
            @forelse($reviews as $review)
                <div class="review-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                        <div style="display: flex; gap: 15px; align-items: center;">
                            <div style="width: 50px; height: 50px; background: #000; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 20px; border: 2px solid #000; box-shadow: 3px 3px 0px 0px var(--accent-primary);">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 style="font-size: 16px; font-weight: 900; color: #000; margin: 0; text-transform: uppercase;">{{ $review->user->name }}</h4>
                                <div style="display: flex; gap: 4px; margin-top: 4px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= $review->rating ? 'rating-star' : '' }}" style="color: {{ $i <= $review->rating ? '#fbbf24' : '#d1d5db' }}"></i>
                                    @endfor
                                    <span style="font-size: 11px; font-weight: 800; color: #64748b; margin-left: 8px;">• {{ $review->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: right; display: flex; align-items: center; gap: 10px;">
                            <span style="background: var(--accent-primary); color: #fff; font-size: 10px; font-weight: 900; padding: 4px 10px; border: 2px solid #000; box-shadow: 3px 3px 0px 0px #000; text-transform: uppercase;">
                                {{ $review->course->title }}
                            </span>
                            @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::id() === $review->course->user_id))
                                <form id="delete-review-{{ $review->id }}" action="{{ route('course.review.destroy', $review->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="nbConfirm('Apakah Anda yakin ingin menghapus ulasan dari {{ $review->user->name }}?', () => document.getElementById('delete-review-{{ $review->id }}').submit())" style="background: #ef4444; color: #fff; border: 2px solid #000; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 2px 2px 0px 0px #000; transition: 0.2s;">
                                        <i class="fa-solid fa-trash-can" style="font-size: 11px;"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <p style="font-size: 14px; color: #475569; font-weight: 600; line-height: 1.6; margin: 0; background: #f1f5f9; padding: 15px; border-left: 5px solid #000;">
                        "{{ $review->comment ?? 'Tidak ada komentar.' }}"
                    </p>

                    @if($review->instructor_reply)
                        <div class="reply-box">
                            <p style="font-size: 13px; color: #1e293b; font-weight: 700; line-height: 1.6; margin: 0;">
                                {{ $review->instructor_reply }}
                            </p>
                            <div style="font-size: 10px; font-weight: 800; color: #94a3b8; margin-top: 10px; text-transform: uppercase;">
                                DIBALAS PADA {{ $review->replied_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                    @else
                        <div class="reply-area">
                            <form action="{{ route('instructor.reviews.reply', $review) }}" method="POST">
                                @csrf
                                <label style="display: block; font-size: 11px; font-weight: 900; text-transform: uppercase; margin-bottom: 10px;">Berikan Balasan:</label>
                                <textarea name="reply" rows="2" style="width: 100%; border: 2px solid #000; padding: 15px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 13px; outline: none; margin-bottom: 15px;" placeholder="Tulis balasan Anda di sini..."></textarea>
                                <button type="submit" class="btn-sq-dark">
                                    <i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i> Kirim Balasan
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div style="background: #fff; border: 3px solid #000; padding: 60px 30px; text-align: center; box-shadow: 10px 10px 0px 0px #000;">
                    <i class="fa-solid fa-message-slash" style="font-size: 48px; color: #cbd5e1; margin-bottom: 20px;"></i>
                    <p style="font-size: 16px; font-weight: 900; color: #64748b; text-transform: uppercase; margin: 0;">Belum ada ulasan untuk kursus Anda.</p>
                </div>
            @endforelse

            <div style="margin-top: 40px;">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
