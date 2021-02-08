<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AcceptHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Access-Control-Allow-Origin', '*');
        $request->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, X-CSRF-TOKEN, Accept, Authorization, X-XSRF-TOKEN,Depth,User-Agent,X-File-Size,X-Requested-With,X-Requested-By,If-Modified-Since,X-File-Name,X-File-Type,Cache-Control,Origin');
        $request->headers->set('Access-Control-Expose-Headers', 'Authorization, authenticated');
        $request->headers->set('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS,DELETE');
        $request->headers->set('Access-Control-Allow-Credentials', 'true');
        $request->headers->set('Accept','application/json');

        return $next($request);
    }
}
