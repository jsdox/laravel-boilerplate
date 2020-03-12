<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\RestExceptionHandlerTrait;


class CheckHeaders
{
    use RestExceptionHandlerTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $accept_header = $request->header('Accept');
        if ($accept_header != 'application/json' && $accept_header != 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8') {
            return $this->invalidHeaders();
        }
        if ($accept_header == 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8') {
            $request->headers->set('Accept', 'application/json');
        }
        return $next($request);
    }
}
