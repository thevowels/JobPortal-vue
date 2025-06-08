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


    public function dashboard(Request $request)
    {
        $user_series = DB::table('users')
            ->selectRaw('DATE(created_at) as date , count(*) as user_count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date','DESC')
            ->get()
            ->keyBy('date');
        $job_series = DB::table((new Job)->getTable())
            ->selectRaw('DATE(created_at) as date , count(*) as job_count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date','DESC')
            ->get()
            ->keyBy('date');
        $company_series = DB::table('companies')
            ->selectRaw('DATE(created_at) as date , count(*) as company_count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date','DESC')
            ->get()
            ->keyBy('date');
        $jobApplication_series = DB::table((new JobApplication)->getTable())
            ->selectRaw('DATE(created_at) as date , count(*) as application_count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date','DESC')
            ->get()
            ->keyBy('date');

        $dates = collect();
        for ($i = 0; $i < 30; $i++) {
            $dates->push(Carbon::now()->subDays($i)->toDateString());
        }
        $dates = $dates->reverse();

        $timeSeries = $dates->map(function ($date) use ($user_series, $job_series, $company_series, $jobApplication_series) {
            return [
                'date' => $date,
                'new_user' => $user_series->get($date)?->user_count ?? 0,
                'Job Posted' => $job_series->get($date)?->job_count ?? 0,
                'New Companies' => $company_series->get($date)?->company_count ?? 0,
                'Submitted Job Applications' => $jobApplication_series->get($date)?->application_count ?? 0,
            ];
        })->values()->all();

        return Inertia::render('Admin/Dashboard',[
            'users_count' => User::where('role','!=', 'admin')
                ->orWhereNull('role')
                ->count(),
            'companies_count' => Company::count(),
            'jobApplications_count' => JobApplication::count(),
            'jobsCount' => Job::count(),
//            'monthly_user_series' => $user_series,
//            'monthly_company_series' => $company_series,
//            'job_application_series' => $jobApplication_series,
//            'monthly_job_series' => $job_series,
            'timeSeries' => $timeSeries,
            'timeSeriesCategories' => ['new_user','Job Posted', 'New Companies', 'Submitted Job Applications'],
            'last_10_jobs' => Job::latest()->with('company')->withCount('jobApplications')->take(10)->get(),
            'dummy_data' =>'asdf'
        ]);
    }

    public function users(Request $request)
    {
        $query = User::query();
        if($request->filled('search')){
            $query->search($request->get('search'));
        }

        if($request->filled('sortKey') && $request->filled('sortOrder')){
            $query->orderBy($request->get('sortKey'), $request->get('sortOrder'));
        }
        return Inertia::render('Admin/Users',[
            'users' => $query->latest()->paginate(15)->withQueryString(),
        ]);
    }
}
