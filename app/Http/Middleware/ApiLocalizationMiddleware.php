<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ApiLocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $local = $request->hasHeader('Accept-Language') ? $request->header('Accept-Language') : User::DEFAULT_LANGUAGE;

        if(! in_array($local, User::LANGUAGES)) {
            $local = User::DEFAULT_LANGUAGE;
        }
        app()->setLocale($local);
        return $next($request);
    }
}
