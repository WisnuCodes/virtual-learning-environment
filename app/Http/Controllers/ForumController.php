<?php

namespace App\Http\Controllers;

use App\Models\ForumCategory;
use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $categories = ForumCategory::withCount('threads')->get();
        $latestThreads = ForumThread::with(['user', 'category'])->latest()->take(5)->get();
        
        return view('forum.index', compact('categories', 'latestThreads'));
    }

    public function category(ForumCategory $category)
    {
        $threads = ForumThread::where('category_id', $category->id)
            ->with(['user'])
            ->withCount('replies')
            ->latest()
            ->paginate(15);
            
        return view('forum.category', compact('category', 'threads'));
    }

    public function thread(ForumThread $thread)
    {
        $thread->increment('views');
        $replies = $thread->replies()->with('user')->oldest()->paginate(20);
        
        return view('forum.show', compact('thread', 'replies'));
    }

    public function createThread(ForumCategory $category = null)
    {
        $categories = ForumCategory::all();
        return view('forum.create', compact('categories', 'category'));
    }

    public function storeThread(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:forum_categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $thread = ForumThread::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->content,
        ]);

        // Notify Instructors
        $instructors = \App\Models\User::where('role', 'instructor')->get();
        foreach ($instructors as $instructor) {
            if ($instructor->id !== Auth::id()) {
                $instructor->notify(new \App\Notifications\LmsNotification([
                    'title' => 'Pertanyaan Baru di Forum!',
                    'message' => "Seseorang baru saja memposting diskusi baru: \"{$request->title}\".",
                    'link' => route('forum.thread', $thread->slug),
                    'icon' => 'fa-solid fa-comments'
                ]));
            }
        }

        return redirect()->route('forum.thread', $thread->slug)->with('success', 'Diskusi berhasil dibuat!');
    }

    public function storeReply(Request $request, ForumThread $thread)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $reply = ForumReply::create([
            'user_id' => Auth::id(),
            'thread_id' => $thread->id,
            'content' => $request->content,
        ]);

        // Notify Thread Owner
        if ($thread->user_id !== Auth::id()) {
            $thread->user->notify(new \App\Notifications\LmsNotification([
                'title' => 'Balasan Baru!',
                'message' => "Diskusi Anda \"{$thread->title}\" menerima balasan baru.",
                'link' => route('forum.thread', $thread->slug),
                'icon' => 'fa-solid fa-reply'
            ]));
        }

        return back()->with('success', 'Balasan berhasil dikirim!');
    }
}
