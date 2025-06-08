<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{$user->name . 'Data Export'}}</title>

    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">

</head>
<body class="font-sans antialiased">
    <div class="text-center">
        <h1 class="font-bold text-green-700">
            {{$user->name}}
        </h1>
    </div>

    <table>
        <thead>
            <tr>
                <td>
                </td>
                <td>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Created Date:
                </td>
                <td>
                    {{$user->created_at->format('F j, Y, g:i a')}}
                </td>
            </tr>
            <tr>
                <td>
                    Last Updated Date:
                </td>
                <td>
                    {{$user->updated_at->format('F j, Y, g:i a')}}
                </td>
            </tr>
        </tbody>
    </table>
    <div class="mt-4">

        <div class="text-center">
            <h1 class="font-3xl font-bold text-slate-700">Applied Jobs</h1>
        </div>
        <div class="max-w-lg mx-auto">
            @foreach($user->jobApplications as $jobApplication)
                <div class="border-b-2 border-slate-900 mb-3">
                    <table>
                        <tr>
                        <td class="w-44 text-center">
                            {{$jobApplication->job->title}}
                        </td>
                        <td class="w-44 text-center">
                            {{$jobApplication->expected_salary}}
                        </td>
                        </tr>
                    </table>
                </div>
            @endforeach

        </div>
    </div>

</body>
</html>
