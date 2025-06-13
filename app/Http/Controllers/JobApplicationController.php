<?php

namespace App\Http\Controllers;

use App\Enums\JobApplicationStatus;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function downloadApplicantcv(Request $request, JobApplication $jobApplication)
    {
        return Storage::disk('private')->download($jobApplication->cv_path);
    }
    public function index(Request $request)
    {

       return Inertia::render('AppliedJobs/Index', [
           'applications' => request()->user()->
           jobApplications()
               ->with(['job' => fn ($query) => $query->withCount(['jobApplications'])
                   ->withAvg('jobApplications', 'expected_salary'),
                   'job.company'
               ])
               ->get(),
           'jobApplications' => request()->user()->
           jobApplications()
               ->with(['job' => fn ($query) => $query->withCount(['jobApplications'])
                   ->withAvg('jobApplications', 'expected_salary'),
                   'job.company'
               ])
               ->get()->groupBy('status'),
            'StatusEnum' =>  collect(JobApplicationStatus::cases())->mapWithKeys(fn ($case) => [
                $case->name => $case->value
            ]),
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
            'cv' => ['required', 'file','mimes:pdf,docx|max:2048'],
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'private');
        $data['cv_path'] = $cvPath;

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

    public function withdraw(Request $request, JobApplication $jobApplication)
    {
        $jobApplication->status= JobApplicationStatus::Withdrawn;
        $jobApplication->save();
        return redirect(route('appliedJobs.index'))
            ->with('banner', 'Your have withdrawn your application successfully')
            ->with('bannerStyle', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request, JobApplication $appliedJob)
    {
        $appliedJob->delete();
        return redirect(route('appliedJobs.index'))
            ->with('banner', 'Your application has been deleted Successfully')
            ->with('bannerStyle', 'success');
    }
}
