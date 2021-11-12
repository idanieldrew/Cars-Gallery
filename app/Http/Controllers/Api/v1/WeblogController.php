<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class WeblogController extends Controller
{
    public function weblog()
    {
        $resp = Http::get("http://127.0.0.1:8001");

        return $resp;
    }
}
