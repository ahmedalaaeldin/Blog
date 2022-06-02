<?php

namespace App\Http\Middleware;

use Closure;

class AuthCustom
{
    public function handle($request, Closure $next)
    {
       
        if (session()->has('key')){
            $response = $next($request);
        }else{
            return  redirect()->route('login');
        }
        // Perform action

        return $response;
    }
}
?>