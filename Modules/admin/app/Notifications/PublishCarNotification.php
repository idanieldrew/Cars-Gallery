<?php

namespace Modules\admin\app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Modules\admin\app\Channels\SmsChannel;

class PublishCarNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        $this->toSms($notifiable);
        return [SmsChannel::class];
    }

    public function toSms($notifiable)
    {
        return (new SmsChannel())
            ->from('dani')
            ->to($notifiable->phone)
            ->line("hello");
    }
}