<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsEmployer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(null === $request->user() || !$request->user()->company()->exists()){
            return redirect(route('companies.create'))
                ->with('banner','You must create your company first')
                ->with('bannerStyle','info');

        }
        return $next($request);

    }
}
