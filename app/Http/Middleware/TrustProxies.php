<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    protected $proxies = '10.242.11.117'; // atau bisa IP dari nginx jika fixed
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
