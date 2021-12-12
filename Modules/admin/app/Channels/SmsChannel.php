<?php

namespace Modules\admin\app\Channels;

use Illuminate\Support\Facades\Http;

class SmsChannel
{
    public $lines =  [];
    public $from;
    public $to;
    public $apikey;

    public function __construct($lines=[])
    {
        $this->lines = $lines;
        $this->from = config('sms.linenumber');
        $this->apikey = config('sms.apikey');
        return $this;
    }

    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    public function to($to)
    {
        $this->to = $to;
        return $this;
    }

    public function line($line)
    {
        $this->lines[] = $line;
        return $this;
    }

    public function send()
    {
        $sendSms = Http::withHeaders([
            'apikey' => config('sms.ghasedak.apikey')
        ])->asForm()->post('https://api.ghasedak.me/v2/sms/send/simple',[
            'message' =>$this->lines[0],
            'receptor' =>$this->to,
            'linenumber' => config('sms.ghasedak.linenumber')
        ]);

        return $sendSms->json();
    }
}