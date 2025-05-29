<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       return Inertia::render('AppliedJobs/Index', [
            'applications' => request()->user()->jobApplications()->with('job.company')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request , Job $job)
    {
        //
        Gate::authorize('apply', $job);
        return Inertia::render('JobApplication/Create', compact('job'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Job $job)
    {
        Gate::authorize('apply', $job);
        $data = $request->validate([
            'expected_salary' => ['required', 'numeric', 'min:5000', 'max:1000000'],
        ]);

        $jobApplication = $request->user()->jobApplications()->make($data);
        $jobApplication->job()->associate($job);
        $jobApplication->save();

        return Redirect::route('jobs.index')->with('banner', 'Your application has been submitted')->with('bannerStyle', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        //
    }
}
