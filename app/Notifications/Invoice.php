<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

use Illuminate\Notifications\Notification;

class Invoice extends Notification
{
    use Queueable;


    public $section = [];
    public function __construct($s = [])
    {
        $this->section = $s;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'section' => $this->section
        ];
    }
}
