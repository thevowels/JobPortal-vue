<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendLatestJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-latest-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jobs = Job::whereDate('created_at', Carbon::yesterday())->get('id');
        if($jobs->isEmpty()){
            $this->info('No jobs posted Yestarday');
            return 1;
        }

        User::chunk(50, function($users) use ($jobs){
                $users->each(function($user) use ($jobs){
                   $this->info($user->id);
                   $this->info($jobs->random()->id);
                });
            });

    }
}
