<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFailedLoginAttempt
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Failed $event): void
    {
        //
        activity('auth.failed')
            ->causedBy($event->user)
            ->withProperties([
                'email' => $event->credentials['email'],
                'ip' => request()->ip()
            ])
            ->log('failed login attempt');

    }
}
