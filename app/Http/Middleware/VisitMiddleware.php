<?php

namespace App\Http\Middleware;

use App\Models\Events;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Events::fire(Events::VISIT_PAGE, ['ip' => $request->ip(), 'device' => $request->userAgent(), 'url' => $request->getRequestUri()]);

        return $next($request);
    }
}
