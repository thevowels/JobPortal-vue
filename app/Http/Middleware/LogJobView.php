<?php

namespace App\Http\Middleware;

use App\Models\Job;
use App\Models\JobViewLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogJobView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->routeIs('jobs.show') && Auth::check()) {

            JobViewLog::create([
                'user_id' => Auth::id(),
                'job_id' => $request->route('job')->id,
                'ip_address' => $request->ip(),
            ]);

            activity()
                ->causedBy(Auth::user())
                ->performedOn($request->route('job'))
                ->log('viewed job');


        }
        return $next($request);
    }
}
