<div class="playlist-header">
    <h3
        style="font-size: 18px; color: var(--text-prim); font-weight: 800; line-height: 1.3; margin: 0; letter-spacing: -0.5px;">
        {{ $course->title }}</h3>
    <div
        style="font-size: 12px; color: var(--text-sec); font-weight: 600; margin-top: 6px; text-transform: uppercase; letter-spacing: 0.5px;">
        Konten Kursus</div>
</div>

@foreach ($course->sections as $section)
    <div class="playlist-section">
        <div class="playlist-section-title">
            {{ $section->title }}
        </div>

        @foreach ($section->lessons as $item)
            @php
                $isActive = $item->id == $lesson->id;
                $isCompleted = \Illuminate\Support\Facades\Auth::check()
                    ? \App\Models\LessonProgress::where('user_id', Auth::id())
                        ->where('lesson_id', $item->id)
                        ->where('is_completed', true)
                        ->exists()
                    : false;

                $iconClass = $isActive ? 'fa-circle-play' : ($isCompleted ? 'fa-circle-check' : 'fa-circle-play');
                $iconColor = $isActive
                    ? 'color: #ffffff;'
                    : ($isCompleted
                        ? 'color: #10b981;'
                        : 'color: var(--text-prim);');
                $textColor = $isActive
                    ? 'color: #ffffff; font-weight: 800;'
                    : 'color: var(--text-prim); font-weight: 600;';
                $activeClass = $isActive ? 'active' : '';
            @endphp

            <div onclick="window.location.href='{{ route('courses.watch', [$course->slug, $item->id]) }}'"
                class="playlist-item {{ $activeClass }}">
                <div style="display: flex; align-items: flex-start; gap: 15px; flex: 1;">
                    <i class="fa-solid {{ $iconClass }}"
                        style="{{ $iconColor }} font-size: 15px; margin-top: 3px;"></i>
                    <div style="font-size: 14px; line-height: 1.5; {{ $textColor }}">
                        {{ $item->title }}
                    </div>
                </div>

                @if (Auth::check() && $isCompleted)
                    <div style="margin-left: 10px;">
                        <span class="sq-badge text-success bg-success-light" title="Selesai"><i
                                class="fa-solid fa-check-double"></i></span>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endforeach


