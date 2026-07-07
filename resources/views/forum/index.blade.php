@extends('layouts.app')

@section('content')
    <style>
        .forum-hero {
            background-color: var(--bg-primary);
            padding: 60px 5% 80px;
            border-bottom: 3px solid #000;
            position: relative;
            overflow: hidden;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .forum-title {
            font-size: 64px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: -3px;
            line-height: 0.9;
            margin-bottom: 20px;
        }

        .forum-container {
            max-width: 1200px;
            margin: -40px auto 80px;
            padding: 0 5%;
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 40px;
            position: relative;
            z-index: 10;
        }

        .category-card {
            background: #fff;
            border: 3px solid #000;
            padding: 30px;
            display: flex;
            gap: 25px;
            transition: 0.2s;
            text-decoration: none;
            color: inherit;
            margin-bottom: 20px;
            box-shadow: 8px 8px 0px 0px #000;
        }

        .category-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 12px 12px 0px 0px var(--accent-primary);
        }

        .category-icon {
            width: 60px;
            height: 60px;
            background: #f1f5f9;
            border: 2px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .category-info h3 {
            font-size: 20px;
            font-weight: 950;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .category-info p {
            font-size: 14px;
            font-weight: 700;
            color: #64748b;
            line-height: 1.5;
        }

        .thread-item {
            background: #fff;
            border: 3px solid #000;
            padding: 20px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.2s;
            text-decoration: none;
            color: inherit;
        }

        .thread-item:hover {
            border-color: var(--accent-primary);
            background: #f8fafc;
        }

        .sidebar-box {
            background: #fff;
            border: 3px solid #000;
            padding: 25px;
            box-shadow: 8px 8px 0px 0px #000;
            margin-bottom: 30px;
        }

        .btn-create {
            display: block;
            background: #000;
            color: #fff;
            border: 3px solid #000;
            padding: 18px;
            text-align: center;
            font-weight: 950;
            text-transform: uppercase;
            text-decoration: none;
            box-shadow: 6px 6px 0px 0px var(--accent-primary);
            margin-bottom: 30px;
            transition: 0.2s;
        }

        .btn-create:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px 0px var(--accent-primary);
        }

        .badge {
            background: #000;
            color: #fff;
            padding: 4px 10px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
        }

        @media (max-width: 950px) {
            .forum-container {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="forum-hero">
        <div style="max-width: 1200px; margin: 0 auto; width: 100%;">
            <div style="display: inline-block; background: #000; color: #fff; padding: 4px 12px; font-weight: 900; font-size: 11px; text-transform: uppercase; border: 2px solid #000; margin-bottom: 20px;">
                Community Hub
            </div>
            <h1 class="forum-title">Forum <span style="color: var(--accent-primary);">Diskusi</span></h1>
            <p style="font-weight: 800; color: #475569; max-width: 600px;">Wadah bagi para siswa dan instruktur untuk berbagi pengetahuan, bertanya, dan tumbuh bersama di ekosistem RuangKelas.</p>
        </div>
    </div>

    <div class="forum-container">
        <div class="forum-main">
            <h2 style="font-size: 24px; font-weight: 950; text-transform: uppercase; margin-bottom: 25px; display: flex; align-items: center; gap: 15px;">
                <span style="width: 8px; height: 24px; background: #000;"></span> Jelajahi Kategori
            </h2>

            @foreach($categories as $cat)
                <a href="{{ route('forum.category', $cat->slug) }}" class="category-card">
                    <div class="category-icon">
                        <i class="fa-solid {{ $cat->icon }}"></i>
                    </div>
                    <div class="category-info">
                        <h3>{{ $cat->name }}</h3>
                        <p>{{ $cat->description }}</p>
                        <div style="margin-top: 15px; font-size: 12px; font-weight: 900; text-transform: uppercase; color: #000;">
                            {{ $cat->threads_count }} Topik Diskusi <i class="fa-solid fa-arrow-right-long" style="margin-left: 10px; color: var(--accent-primary);"></i>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <aside class="forum-sidebar">
            <a href="{{ route('forum.create') }}" class="btn-create">
                <i class="fa-solid fa-plus" style="margin-right: 10px;"></i> Buat Diskusi Baru
            </a>

            <div class="sidebar-box">
                <h3 style="font-size: 16px; font-weight: 950; text-transform: uppercase; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 10px;">
                    Diskusi Terbaru
                </h3>
                @forelse($latestThreads as $thread)
                    <a href="{{ route('forum.thread', $thread->slug) }}" style="display: block; text-decoration: none; color: inherit; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
                        <h4 style="font-size: 13px; font-weight: 900; margin-bottom: 5px; line-height: 1.4;">{{ Str::limit($thread->title, 50) }}</h4>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 10px; font-weight: 700; color: #94a3b8;">{{ $thread->user->name }}</span>
                            <span class="badge" style="background: var(--accent-primary); color: #000;">{{ $thread->category->name }}</span>
                        </div>
                    </a>
                @empty
                    <p style="font-size: 12px; font-weight: 700; color: #94a3b8;">Belum ada diskusi terbaru.</p>
                @endforelse
            </div>

            <div class="sidebar-box" style="background: var(--accent-primary);">
                <h3 style="font-size: 16px; font-weight: 950; text-transform: uppercase; margin-bottom: 15px;">
                    Aturan Komunitas
                </h3>
                <ul style="padding-left: 20px; font-size: 12px; font-weight: 700; color: #000; line-height: 1.6;">
                    <li>Gunakan bahasa yang sopan.</li>
                    <li>Cek topik serupa sebelum bertanya.</li>
                    <li>Dilarang spam atau berjualan.</li>
                    <li>Saling menghargai antar member.</li>
                </ul>
            </div>
        </aside>
    </div>
@endsection
