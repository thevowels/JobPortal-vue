<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SeedDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-db {--D|date=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed fake data for today';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = $this->option('date') ? Carbon::parse($this->option('date'))->setTime(10,0) : Carbon::now();

        $this->info('Seeding fake data for '. $date->format('Y-m-d'));

        $bar = $this->output->createProgressBar(8);
        $companies = Company::factory(random_int(2,5))->create([
            'created_at' => $date->copy()
        ]);
        $bar->advance(2);
        User::factory(random_int(3,7))->create([
            'created_at' => $date->copy()

        ]);
        $bar->advance(2);
        $jobs = Job::factory(random_int(7,20))
            ->recycle(Company::all())
            ->create([
                'created_at' => $date->copy()

            ]);
        $bar->advance(2);
        JobApplication::factory(random_int(15,40))
            ->recycle($jobs)
            ->recycle(User::all())
            ->create([
                'created_at' => $date->copy()
            ]);
        $bar->finish();

        $this->info('Success!');
    }
}
