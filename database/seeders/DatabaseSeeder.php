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

        $start = Carbon::now()->subMonths(1)->startOfMonth();
        $end = Carbon::now();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'created_at' => $start->copy(),
            'email_verified_at' => $start->copy(),
            'updated_at' => $start->copy(),
        ]);
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'created_at' => $start->copy(),
            'email_verified_at' => $start->copy(),
            'updated_at' => $start->copy(),

        ]);

        $companies = Company::factory(30)->create([
            'created_at' => $start->copy()
        ]);


        while($start->lte($end)){

            User::factory(random_int(5,15))->create([
                'created_at' => $start->copy()
            ]);
//            Company::factory(random_int(0,10))
//                ->create([
//                'created_at' => $start->copy()
//            ]);
            $jobs = Job::factory(random_int(7,20))
                ->recycle($companies)
                ->create([
                    'created_at' => $start->copy()
                ]);
            JobApplication::factory(random_int(15,40))
                ->recycle($jobs)
                ->recycle(User::all())
                ->create([
                    'created_at' => $start->copy()
                ]);

            $start->addDay();
        }


    }
}
