<x-mail::message>
# Hello {{$user->name}}

Hey I've found newly posted jobs you might be interested in check those out.

@foreach($jobs as $job)
---

### [{{ $job->title }}]({{ route('jobs.show', $job->id) }})

**Company:** {{ $job->company->name ?? 'Unknown Company' }} <br/>
**Salary:** ${{ number_format($job->salary) }}  <br/>
**Posted on:** {{ \Carbon\Carbon::parse($job->created_at)->toFormattedDateString() }}<br/>
@endforeach

<x-mail::button :url="route('jobs.index')">
 See Jobs
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
