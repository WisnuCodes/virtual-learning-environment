@extends('layouts.app')

@section('content')
    <style>
        .forum-container {
            max-width: 1000px;
            margin: 40px auto 80px;
            padding: 0 5%;
        }

        .thread-main {
            background: #fff;
            border: 4px solid #000;
            padding: 50px;
            box-shadow: 15px 15px 0px 0px #000;
            margin-bottom: 50px;
            position: relative;
        }

        .reply-card {
            background: #fff;
            border: 3px solid #000;
            padding: 30px;
            margin-bottom: 25px;
            margin-left: 40px;
            position: relative;
            box-shadow: 8px 8px 0px 0px #f1f5f9;
        }

        .reply-card::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            width: 3px;
            height: 100%;
            background: #cbd5e1;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            background: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
            font-size: 20px;
            border: 3px solid var(--accent-primary);
        }

        .content-body {
            font-size: 16px;
            line-height: 1.7;
            font-weight: 700;
            color: #334155;
            white-space: pre-line;
        }

        .reply-form {
            background: #f8fafc;
            border: 3px solid #000;
            padding: 30px;
            margin-top: 40px;
        }

        .form-textarea {
            width: 100%;
            padding: 20px;
            border: 3px solid #000;
            font-weight: 700;
            font-size: 15px;
            outline: none;
            margin-bottom: 20px;
        }

        .btn-reply {
            background: var(--accent-primary);
            color: #000;
            border: 3px solid #000;
            padding: 15px 30px;
            font-weight: 950;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 6px 6px 0px 0px #000;
        }

        .category-tag {
            position: absolute;
            top: -20px;
            right: 40px;
            background: #000;
            color: #fff;
            padding: 8px 20px;
            font-weight: 950;
            text-transform: uppercase;
            font-size: 12px;
            border: 3px solid #000;
            box-shadow: 4px 4px 0px 0px var(--accent-primary);
        }
    </style>

    <div class="forum-container">
        <a href="{{ route('forum.category', $thread->category->slug) }}" style="color: #000; text-decoration: none; font-weight: 900; font-size: 13px; text-transform: uppercase; display: flex; align-items: center; gap: 8px; margin-bottom: 30px;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke {{ $thread->category->name }}
        </a>

        <div class="thread-main">
            <div class="category-tag">{{ $thread->category->name }}</div>
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr($thread->user->name, 0, 1)) }}</div>
                <div>
                    <h4 style="font-weight: 950; margin: 0; font-size: 18px;">{{ $thread->user->name }}</h4>
                    <span style="font-size: 12px; font-weight: 700; color: #94a3b8;">Diposting {{ $thread->created_at->diffForHumans() }}</span>
                </div>
            </div>

            <h1 style="font-size: 32px; font-weight: 950; text-transform: uppercase; letter-spacing: -1px; margin-bottom: 25px; line-height: 1.1;">
                {{ $thread->title }}
            </h1>

            <div class="content-body">
                {{ $thread->content }}
            </div>

            <div style="margin-top: 40px; border-top: 2px solid #f1f5f9; padding-top: 20px; display: flex; gap: 20px;">
                <span style="font-size: 12px; font-weight: 950; color: #64748b; text-transform: uppercase;">
                    <i class="fa-solid fa-eye"></i> {{ $thread->views }} Views
                </span>
                <span style="font-size: 12px; font-weight: 950; color: #64748b; text-transform: uppercase;">
                    <i class="fa-solid fa-comment"></i> {{ $thread->replies->count() }} Balasan
                </span>
            </div>
        </div>

        <h2 style="font-size: 20px; font-weight: 950; text-transform: uppercase; margin-bottom: 30px;">
            Diskusi ({{ $thread->replies->count() }})
        </h2>

        @foreach($replies as $reply)
            <div class="reply-card">
                <div class="user-info" style="margin-bottom: 15px;">
                    <div class="user-avatar" style="width: 35px; height: 35px; font-size: 14px; border-width: 2px;">
                        {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 style="font-weight: 950; margin: 0; font-size: 14px;">{{ $reply->user->name }}</h4>
                        <span style="font-size: 11px; font-weight: 700; color: #94a3b8;">{{ $reply->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="content-body" style="font-size: 14px;">
                    {{ $reply->content }}
                </div>
            </div>
        @endforeach

        <div style="margin-top: 30px;">
            {{ $replies->links() }}
        </div>

        @auth
            <div class="reply-form">
                <h3 style="font-size: 18px; font-weight: 950; text-transform: uppercase; margin-bottom: 20px;">Berikan Balasan</h3>
                <form action="{{ route('forum.reply.store', $thread->slug) }}" method="POST">
                    @csrf
                    <textarea name="content" class="form-textarea" rows="5" placeholder="Tulis pendapat atau jawaban Anda..." required></textarea>
                    <button type="submit" class="btn-reply">Kirim Balasan</button>
                </form>
            </div>
        @else
            <div style="background: #f1f5f9; border: 3px dashed #cbd5e1; padding: 30px; text-align: center; margin-top: 40px;">
                <p style="font-weight: 800; color: #64748b; margin-bottom: 15px;">Silakan login untuk ikut berdiskusi.</p>
                <a href="{{ route('login') }}" class="btn-submit" style="text-decoration: none; display: inline-block;">Login Sekarang</a>
            </div>
        @endauth
    </div>
@endsection
