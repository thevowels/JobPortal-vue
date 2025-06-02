<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */


    public function __invoke(Request $request)
    {
        $user_series = DB::table('users')
            ->selectRaw('DATE(created_at) as date , count(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date','DESC')
            ->get();
        $job_series = DB::table((new Job)->getTable())
            ->selectRaw('DATE(created_at) as date , count(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date','DESC')
            ->get();
        $company_series = DB::table('companies')
            ->selectRaw('DATE(created_at) as date , count(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date','DESC')
            ->get();
        $jobApplication_series = DB::table((new JobApplication)->getTable())
            ->selectRaw('DATE(created_at) as date , count(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date','DESC')
            ->get();
        
        return Inertia::render('Admin/Dashboard',[
            'users_count' => User::where('role','!=', 'admin')
                ->orWhereNull('role')
                ->count(),
            'companies_count' => Company::count(),
            'jobApplications_count' => JobApplication::count(),
            'jobsCount' => Job::count(),
            'monthly_user_series' => $user_series,
            'monthly_company_series' => $company_series,
            'job_application_series' => $jobApplication_series,
            'monthly_job_series' => $job_series,
        ]);
    }
}
