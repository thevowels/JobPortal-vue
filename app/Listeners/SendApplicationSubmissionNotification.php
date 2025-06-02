<?php

namespace App\Listeners;

use App\Events\JobApplicationSubmitted;
use App\Notifications\SomeoneAppliedForJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendApplicationSubmissionNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(

    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(JobApplicationSubmitted $event): void
    {
        //

        $jobApplication = $event->jobApplication;
        $user = $event->jobApplication->job->company->user;

        $user->notify(new SomeoneAppliedForJob($jobApplication));
    }
}
