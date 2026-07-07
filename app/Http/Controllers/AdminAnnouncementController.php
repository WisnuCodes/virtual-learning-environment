<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAnnouncementController extends Controller
{
    private function checkRole()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Admin access required.');
        }
    }

    public function index()
    {
        $this->checkRole();
        $announcements = Announcement::with('user')->latest()->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function store(Request $request)
    {
        $this->checkRole();

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,critical,success,warning',
            'target_role' => 'required|in:all,student,instructor,admin',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        Announcement::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'target_role' => $request->target_role,
            'is_active' => true,
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
        ]);

        return back()->with('success', 'Global announcement has been successfully deployed.');
    }

    public function toggle(Announcement $announcement)
    {
        $this->checkRole();
        $announcement->update(['is_active' => !$announcement->is_active]);
        return back()->with('success', 'Announcement status updated.');
    }

    public function destroy(Announcement $announcement)
    {
        $this->checkRole();
        Announcement::destroy($announcement->id);
        return back()->with('success', 'Announcement removed from system.');
    }
}
