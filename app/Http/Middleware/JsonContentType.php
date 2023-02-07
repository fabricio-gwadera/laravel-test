<?php

namespace App\Http\Middleware;

use Closure;

class JsonContentType
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->getContentTypeFormat() !== 'json')
            return response('', 406);

        return $next($request);
    }
}
