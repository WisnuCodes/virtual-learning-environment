<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LmsNotification extends Notification
{
    use Queueable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->data['title'] ?? 'Notifikasi Baru',
            'message' => $this->data['message'] ?? '',
            'link' => $this->data['link'] ?? '#',
            'icon' => $this->data['icon'] ?? 'fa-solid fa-bell',
        ];
    }
}
