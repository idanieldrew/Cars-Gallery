<?php

namespace Modules\admin\app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Modules\admin\app\Channels\SmsChannel;

class PublishCarNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable)
    {
        return ['mail',SmsChannel::class];
    }
}