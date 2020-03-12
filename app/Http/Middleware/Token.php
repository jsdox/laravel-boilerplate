<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\RestExceptionHandlerTrait;
use App\Models\User;

class Token
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
        $access_token = trim($request->bearerToken());
        $user = User::where('api_token', $access_token)->first();
        if (!$user) {
            return $this->invalidToken();
        }
        return $next($request);
    }
}
