<x-mail::message>
# New Application Received

A new Application has been submitted for the job: **{{$application->job->title}}

**Applicant:** {{ $application->user->name }}
**Email:** {{ $application->user->email }}

<x-mail::button :url="route('my-jobs')">
See Applicants
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
