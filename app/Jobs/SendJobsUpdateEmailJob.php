<?php

namespace App\Jobs;

use App\Mail\LatestJobs;
use App\Models\Job;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class SendJobsUpdateEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user,
        public Collection $jobs
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)
            ->send(new LatestJobs($this->user, $this->jobs));
    }
}
