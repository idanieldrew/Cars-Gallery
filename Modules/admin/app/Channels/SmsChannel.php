<?php

namespace Modules\admin\app\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class SmsChannel
{
    protected $msg;

    protected $phone;
    public function __construct(string $msg,string $phone)
    {
        $this->msg = $msg;
        $this->phone = $phone;
    }

    public function send()
    {

    }

    public function sendSMS($notifiable,Notification $notification)
    {
        $sendSms = Http::withHeaders([
            'apikey' => config('apikey')
        ])->asForm()->post('https://api.ghasedak.com/v2/sms/send/simple',[$this->msg,$this->phone]);

        return $sendSms->json();
    }
}