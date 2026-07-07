<div id="tab-qna" class="tab-pane">
    <div class="pane-title">
        <span><i class="fa-solid fa-comments" style="margin-right: 8px; color: var(--text-sec);"></i> Diskusi</span>
    </div>

    @if (session('success'))
        <div class="alert-sq-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Ask Question Form -->
    <div class="item-card" style="background: var(--bg-sec); border-style: dashed;">
        <div class="item-body">
            <form action="{{ route('qna.store', [$course->id, $lesson->id]) }}" method="POST">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label
                        style="display: block; font-size: 12px; font-weight: 700; color: var(--text-prim); margin-bottom: 6px; text-transform: uppercase;">Judul
                        Pertanyaan</label>
                    <input type="text" name="title" class="form-control-sq" placeholder="Contoh: 'Error di Bagian Routing'"
                        required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label
                        style="display: block; font-size: 12px; font-weight: 700; color: var(--text-prim); margin-bottom: 6px; text-transform: uppercase;">Detail</label>
                    <textarea name="body" class="form-control-sq" rows="4"
                        placeholder="Jelaskan apa yang Anda tanyakan secara detail..." required style="resize: vertical;"></textarea>
                </div>
                <div style="text-align: right;">
                    <button type="submit" class="btn-sq-primary">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Pertanyaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Questions List -->
    <div style="display: flex; flex-direction: column; gap: 25px;">
        @forelse($questions as $question)
            <div class="item-card shadow-sm">
                <div class="item-body" style="display: flex; gap: 15px;">
                    <div class="avatar-sq">
                        {{ substr($question->user->name, 0, 1) }}
                    </div>
                    <div style="flex: 1;">
                        <div
                            style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 10px; margin-bottom: 10px;">
                            <div>
                                <h5
                                    style="font-size: 16px; font-weight: 700; color: var(--text-prim); margin-bottom: 4px; line-height: 1.3;">
                                    {{ $question->title }}</h5>
                                <div
                                    style="font-size: 12px; color: var(--text-sec); font-weight: 600; text-transform: uppercase;">
                                    <span style="color: var(--text-prim);">{{ $question->user->name }}</span>
                                    &bull; {{ $question->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: flex-start;">
                                @if ($question->is_resolved)
                                    <span class="sq-badge text-success bg-success-light"><i class="fa-solid fa-check"
                                            style="margin-right: 4px;"></i> Selesai</span>
                                @endif

                                @if (Auth::id() === $question->user_id || (Auth::user()->role === 'instructor' && $course->user_id === Auth::id()))
                                    <form action="{{ route('qna.destroy', $question->id) }}" method="POST"
                                        onsubmit="return confirm('PENTING: Hapus utas diskusi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="background: transparent; border: none; color: #e11d48; cursor: pointer; padding: 4px; font-size: 14px; transition: 0.2s;"
                                            title="Hapus Diskusi" onmouseover="this.style.transform='scale(1.2)'"
                                            onmouseout="this.style.transform='scale(1)'">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <p class="pane-desc" style="margin-bottom: 0;">{{ $question->body }}</p>

                        <!-- Replies Area -->
                        <div class="reply-box">
                            <h6
                                style="font-size: 11px; font-weight: 800; color: var(--text-sec); margin-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px;">
                                <i class="fa-solid fa-reply-all"
                                    style="margin-right: 6px;"></i>{{ $question->replies->count() }} Balasan
                            </h6>

                            <div style="display: flex; flex-direction: column; gap: 15px;">
                                @foreach ($question->replies as $reply)
                                    <div class="reply-item">
                                        <div
                                            class="avatar-sq avatar-sm {{ $reply->is_instructor_reply ? 'avatar-inst' : '' }}">
                                            @if ($reply->is_instructor_reply)
                                                <i class="fa-solid fa-chalkboard-user"></i>
                                            @else
                                                {{ substr($reply->user->name, 0, 1) }}
                                            @endif
                                        </div>
                                        <div class="reply-content {{ $reply->is_instructor_reply ? 'is-inst' : '' }}">
                                            <div
                                                style="font-size: 11px; color: var(--text-sec); margin-bottom: 6px; display: flex; align-items: center; gap: 8px; font-weight: 700; text-transform: uppercase;">
                                                <span
                                                    style="color: {{ $reply->is_instructor_reply ? 'var(--text-prim)' : 'var(--text-prim)' }}">{{ $reply->user->name }}</span>
                                                @if ($reply->is_instructor_reply)
                                                    <span
                                                        style="background: var(--text-prim); color: #fff; padding: 2px 6px; font-size: 9px;">PENGAJAR</span>
                                                @endif
                                                <span>&bull;</span>
                                                <span>{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div style="font-size: 13px; color: var(--text-prim); line-height: 1.6;">
                                                {{ $reply->body }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Reply Form -->
                            <div style="margin-top: 20px; display: flex; gap: 15px; align-items:flex-start;">
                                <div class="avatar-sq avatar-sm"
                                    style="background: var(--bg-sec); color: var(--text-prim); border-color: var(--border-color);">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <form action="{{ route('qna.reply', $question->id) }}" method="POST"
                                    style="flex: 1; display:flex; flex-direction: column; gap:10px;">
                                    @csrf
                                    <textarea name="body" required class="form-control-sq" rows="2" placeholder="Tulis balasan..."
                                        style="resize:vertical;"></textarea>
                                    <div style="text-align:right;">
                                        <button type="submit" class="btn-sq-outline"
                                            style="padding: 6px 16px; font-size: 12px;">Balas</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div
                style="text-align: center; padding: 50px 20px; color: var(--text-sec); border: 2px dashed var(--border-color); background: var(--bg-sec);">
                <div
                    style="width: 60px; height: 60px; background: #fff; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                    <i class="fa-solid fa-comments" style="font-size: 24px;"></i>
                </div>
                <h5
                    style="font-size: 15px; font-weight: 800; color: var(--text-prim); margin-bottom: 5px; text-transform: uppercase;">
                    Belum Ada Diskusi</h5>
                <p style="font-size: 13px; margin: 0;">Jadi yang pertama bertanya tentang materi ini.</p>
            </div>
        @endforelse
    </div>
</div>
