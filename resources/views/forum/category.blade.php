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

        .thread-card {
            background: #fff;
            border: 3px solid #000;
            padding: 25px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-decoration: none;
            color: inherit;
            transition: 0.2s;
            box-shadow: 6px 6px 0px 0px #000;
        }

        .thread-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
            border-color: var(--accent-primary);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            border: 2px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 14px;
        }

        .stats-badge {
            background: #f1f5f9;
            border: 2px solid #000;
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .btn-new {
            background: #000;
            color: #fff;
            border: 3px solid #000;
            padding: 12px 25px;
            font-weight: 950;
            text-transform: uppercase;
            text-decoration: none;
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
    </style>

    <div class="forum-header">
        <div style="max-width: 1000px; margin: 0 auto; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <a href="{{ route('forum.index') }}" style="color: #000; text-decoration: none; font-weight: 900; font-size: 12px; text-transform: uppercase; display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Forum
                </a>
                <h1 style="font-size: 42px; font-weight: 950; text-transform: uppercase; letter-spacing: -2px; line-height: 1;">
                    {{ $category->name }}
                </h1>
                <p style="font-weight: 800; color: #64748b; margin-top: 10px;">{{ $category->description }}</p>
            </div>
            <a href="{{ route('forum.create', $category->slug) }}" class="btn-new">
                <i class="fa-solid fa-plus"></i> Thread Baru
            </a>
        </div>
    </div>

    <div class="forum-container">
        @forelse($threads as $thread)
            <a href="{{ route('forum.thread', $thread->slug) }}" class="thread-card">
                <div style="display: flex; gap: 20px; align-items: center;">
                    <div class="user-avatar">
                        {{ strtoupper(substr($thread->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 style="font-size: 18px; font-weight: 950; margin-bottom: 5px;">{{ $thread->title }}</h3>
                        <p style="font-size: 12px; font-weight: 700; color: #94a3b8;">
                            Oleh <strong>{{ $thread->user->name }}</strong> • {{ $thread->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                <div style="display: flex; gap: 15px;">
                    <div class="stats-badge">
                        <i class="fa-solid fa-comment" style="margin-right: 5px;"></i> {{ $thread->replies_count }}
                    </div>
                    <div class="stats-badge">
                        <i class="fa-solid fa-eye" style="margin-right: 5px;"></i> {{ $thread->views }}
                    </div>
                </div>
            </a>
        @empty
            <div style="text-align: center; padding: 100px 20px; border: 3px dashed #cbd5e1;">
                <i class="fa-solid fa-folder-open" style="font-size: 48px; color: #cbd5e1; margin-bottom: 20px;"></i>
                <h3 style="font-weight: 950; color: #94a3b8; text-transform: uppercase;">Belum Ada Diskusi</h3>
                <p style="font-weight: 700; color: #cbd5e1;">Jadilah yang pertama memulai diskusi di kategori ini!</p>
            </div>
        @endforelse

        <div style="margin-top: 40px;">
            {{ $threads->links() }}
        </div>
    </div>
@endsection
