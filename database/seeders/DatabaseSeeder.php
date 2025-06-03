<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin'
        ]);
        $companies = Company::factory(30)->create();

        $start = Carbon::now()->subMonths(1)->startOfMonth();
        $end = Carbon::now();

        while($start->lte($end)){

            User::factory(random_int(2,10))->create([
                'created_at' => $start->copy()
            ]);
            $jobs = Job::factory(random_int(2,20))
                ->recycle($companies)
                ->create([
                    'created_at' => $start->copy()
                ]);
            JobApplication::factory(random_int(5,30))
                ->recycle($jobs)
                ->recycle(User::all())
                ->create([
                    'created_at' => $start->copy()
                ]);

            $start->addDay();
        }


    }
}
