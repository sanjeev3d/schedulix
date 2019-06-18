<?php

namespace App\Http\Middleware;

use Request;
use Closure;
use Auth;
use Log;
use Route;
class LoginRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $userType = Auth()->user()->role_id;
        $url = Request::path();
        //dd($url,$userType);
        Log::info('LoginRoute middleware url -'.print_r($url,true));
        Log::info('User Type === '.$userType);
        return $next($request);
    }
}
