<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class CheckLogin
{
    protected $auth;
    
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    
    public function handle($request, Closure $next){
        if(auth()->guest()){
            return redirect()->route('login');
        }
        return $next($request);
    }
}