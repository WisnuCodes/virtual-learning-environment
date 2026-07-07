@extends('layouts.app')

@section('content')
<style>
    :root {
        --brutal-shadow: 6px 6px 0px 0px #000;
        --brutal-shadow-hover: 10px 10px 0px 0px var(--accent-primary);
    }

    .courses-hero {
        background-color: var(--bg-primary);
        padding: 50px 5% 40px;
        border-bottom: 4px solid #000;
        position: relative;
        overflow: hidden;
        background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px);
        background-size: 24px 24px;
        text-align: center;
    }

    .courses-hero h1 {
        font-size: 42px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: -2px;
        line-height: 1;
        margin-bottom: 12px;
        position: relative;
        z-index: 2;
    }

    .courses-hero h1 span {
        color: var(--accent-primary);
    }

    .courses-hero p {
        font-size: 14px;
        font-weight: 800;
        color: #475569;
        max-width: 500px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Compact Control Panel */
    .filter-section {
        background: #fff;
        border-bottom: 3px solid #000;
        padding: 15px 5%;
        position: sticky;
        top: 73px;
        z-index: 100;
    }

    .filter-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .category-scroll {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .category-scroll::-webkit-scrollbar { display: none; }

    .category-pill {
        padding: 8px 16px;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        border: 2px solid #000;
        background: #fff;
        color: #000;
        text-decoration: none;
        white-space: nowrap;
        transition: 0.2s;
        box-shadow: 3px 3px 0px 0px #000;
    }

    .category-pill.active {
        background: var(--accent-primary);
        color: #fff;
        transform: translate(-1px, -1px);
        box-shadow: 4px 4px 0px 0px #000;
    }

    .search-box {
        position: relative;
        width: 280px;
    }

    .search-box input {
        width: 100%;
        padding: 10px 40px 10px 15px;
        border: 3px solid #000;
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        outline: none;
        box-shadow: 4px 4px 0px 0px #000;
    }

    .search-box i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
        color: #000;
    }

    /* Sleek Grid */
    .catalog-wrapper {
        padding: 50px 5%;
        background-color: var(--bg-secondary);
        min-height: 500px;
    }

    .catalog-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .asset-card {
        background: #fff;
        border: 3px solid #000;
        box-shadow: var(--brutal-shadow);
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .asset-card:hover {
        transform: translate(-4px, -4px);
        box-shadow: var(--brutal-shadow-hover);
    }

    .asset-thumb {
        height: 160px;
        background: #000;
        position: relative;
        overflow: hidden;
        border-bottom: 3px solid #000;
    }

    .asset-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }

    .asset-card:hover .asset-thumb img {
        transform: scale(1.05);
    }

    .badge-category {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #fff;
        color: #000;
        padding: 4px 10px;
        font-size: 9px;
        font-weight: 950;
        text-transform: uppercase;
        border: 2px solid #000;
        z-index: 10;
    }

    .asset-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .instructor-name {
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        color: #64748b;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .asset-title {
        font-size: 16px;
        font-weight: 950;
        color: #000;
        text-decoration: none;
        line-height: 1.2;
        margin-bottom: 15px;
        text-transform: uppercase;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 38px;
    }

    .asset-stats {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        padding-top: 15px;
        border-top: 2px dashed #e2e8f0;
    }

    .stat-pill {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 900;
        color: #000;
    }

    .asset-footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .price-container {
        display: flex;
        flex-direction: column;
    }

    .old-price {
        font-size: 10px;
        text-decoration: line-through;
        color: #94a3b8;
        font-weight: 800;
    }

    .current-price {
        font-size: 18px;
        font-weight: 950;
        color: #000;
    }

    .btn-explore {
        background: #000;
        color: #fff;
        padding: 10px 18px;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        border: 2px solid #000;
        box-shadow: 3px 3px 0px 0px var(--accent-primary);
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-explore:hover {
        background: var(--accent-primary);
        transform: translate(-2px, -2px);
        box-shadow: 5px 5px 0px 0px #000;
    }

    .pagination-container {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .filter-container {
            flex-direction: column;
            align-items: stretch;
        }
        .search-box { width: 100%; }
        .courses-hero h1 { font-size: 32px; }
    }
</style>

<section class="courses-hero">
    <h1 data-aos="fade-up">Explore <span>Catalog</span></h1>
    <p data-aos="fade-up" data-aos-delay="100">Temukan kurikulum industri paling progresif.</p>
</section>

<div class="filter-section">
    <div class="filter-container">
        <div class="category-scroll">
            <a href="{{ route('courses.index') }}" class="category-pill {{ !request()->has('category') ? 'active' : '' }}">Semua</a>
            @foreach($categories as $cat)
                <a href="{{ route('courses.index', ['category' => $cat->slug]) }}" 
                   class="category-pill {{ request()->category === $cat->slug ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <form action="{{ route('courses.index') }}" method="GET" class="search-box">
            @if(request()->has('category'))
                <input type="hidden" name="category" value="{{ request()->category }}">
            @endif
            <input type="text" name="search" placeholder="Cari Materi..." value="{{ request()->search }}">
            <i class="fa-solid fa-magnifying-glass"></i>
        </form>
    </div>
</div>

<div class="catalog-wrapper">
    <div class="catalog-container">
        @if($courses->isEmpty())
            <div style="text-align: center; padding: 60px 20px; border: 3px dashed #000; background: #fff; box-shadow: 10px 10px 0px 0px #000;">
                <i class="fa-solid fa-folder-open" style="font-size: 48px; margin-bottom: 20px; color: #cbd5e1;"></i>
                <h3 style="font-size: 20px; font-weight: 950; text-transform: uppercase;">Tidak Ditemukan</h3>
                <p style="font-weight: 800; color: #64748b; font-size: 13px; margin-bottom: 20px;">Coba gunakan kata kunci atau kategori lain.</p>
                <a href="{{ route('courses.index') }}" class="btn-explore" style="display: inline-block;">Reset</a>
            </div>
        @else
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 25px;">
                @foreach($courses as $course)
                    <article class="asset-card">
                        <div class="asset-thumb">
                            <span class="badge-category">{{ $course->category->name }}</span>
                            <a href="{{ route('courses.show', $course->slug) }}">
                                <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}">
                            </a>
                        </div>
                        <div class="asset-body">
                            <div class="instructor-name">
                                <i class="fa-solid fa-user-circle"></i> {{ $course->user->name }}
                            </div>

                            <a href="{{ route('courses.show', $course->slug) }}" class="asset-title">
                                {{ $course->title }}
                            </a>

                            <div class="asset-stats">
                                @php
                                    $avg = round($course->reviews()->avg('rating'), 1) ?: 0;
                                    $count = $course->enrollments()->where('status', 'active')->count();
                                @endphp
                                <div class="stat-pill">
                                    <i class="fa-solid fa-star" style="color: #fbbf24;"></i> {{ $avg }}
                                </div>
                                <div class="stat-pill" style="color: #64748b;">
                                    <i class="fa-solid fa-users"></i> {{ $count }}
                                </div>
                            </div>
                            
                            <div class="asset-footer">
                                <div class="price-container">
                                    @php $isDiscount = $course->discount_price > 0 && (!$course->discount_until || $course->discount_until > now()); @endphp
                                    @if($isDiscount)
                                        <span class="old-price">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                        <span class="current-price">Rp {{ number_format($course->discount_price, 0, ',', '.') }}</span>
                                    @elseif($course->price == 0)
                                        <span class="current-price" style="color: var(--accent-primary);">FREE</span>
                                    @else
                                        <span class="current-price">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('courses.show', $course->slug) }}" class="btn-explore">Detail</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="pagination-container">
                {{ $courses->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
