<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $validated = request()->validate([
            'search' => ['nullable', 'string'],
            'experience' => ['nullable', 'string'],
            'category' => ['nullable', 'string'],
            'min_salary' => ['nullable', 'numeric', 'min:0'],
            'max_salary' => ['nullable', 'numeric', 'min:0'],
        ]);

        $filters =array_filter( $validated, fn ($value) => !empty($value));

        $query = Job::query();

        foreach ($filters as $key => $value) {
            $method = match ($key) {
                'experience' => 'ofExperience',
                'category' => 'ofCategory',
                'min_salary' => 'minSalary',
                'max_salary' => 'maxSalary',
                default => $key,
            };

            if (method_exists(Job::class, $method)) {
                $query->{$method}($value);
            }
        }
        return Inertia::render('Jobs/Index',[
            'jobs' => $query->with('company')->latest()->limit(20)->get(),
            'categories' => Job::$categories,
            'experiences' => Job::$experiences,
            'query' => $request->query()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Company $company)
    {
        dd('create route', $company);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
      return Inertia::render('Jobs/Show',[
          'job' => $job->load('company'),
          'company_jobs' => Job::where('company_id', $job->company->id)->with('company')->get(),
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
