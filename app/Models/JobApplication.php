<?php

namespace App\Models;

use App\Events\JobApplicationSubmitted;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory;
    use HasUuids;

    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->useLogName('jobApplications');
    }

    protected $dispatchesEvents = [
        'created' => JobApplicationSubmitted::class,
    ];

    protected $fillable = [
        'expected_salary',
        'cv_path',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
