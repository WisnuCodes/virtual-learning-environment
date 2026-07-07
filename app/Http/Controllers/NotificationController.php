<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $user = Auth::user();
        if (!$user) return response()->json(['count' => 0, 'notifications' => []]);

        $notifications = $user->notifications()->latest()->limit(20)->get()->map(function($n) {
            return [
                'id' => $n->id,
                'title' => $n->data['title'] ?? 'Notifikasi Baru',
                'message' => $n->data['message'] ?? '',
                'link' => $n->data['link'] ?? '#',
                'icon' => $n->data['icon'] ?? 'fa-solid fa-bell',
                'read_at' => $n->read_at,
                'created_at_human' => $n->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'count' => $user->unreadNotifications()->count(),
            'notifications' => $notifications
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(['success' => true]);
    }

    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
}
