<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $companies = Company::factory(30)->create();

        $jobs = Job::factory(300)
            ->recycle($companies)
            ->create();
        $users = User::all();
        JobApplication::factory(1000)
            ->sequence(...$jobs->map(fn ($job) => ['job_id' => $job->id]))
            ->recycle($users)
            ->create();

    }
}
