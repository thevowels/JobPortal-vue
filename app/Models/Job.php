<?php

namespace App\Models;

use App\Events\JobPosted;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BroadcastableModelEventOccurred;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
    use HasUuids;
    use LogsActivity;
    use BroadcastsEvents;

    protected $table = 'jobs-table';

    protected $fillable = [
        'title',
        'description',
        'location',
        'salary',
        'experience',
        'category',
    ];
    public static array $experiences = ['junior','associate', 'senior'];

    public static array $categories = ['marketing', 'accounting', 'IT', 'finance', 'Admin'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->useLogName('jobs');
    }
    protected function newBroadcastableEvent(string $event): BroadcastableModelEventOccurred
    {
        return (new BroadcastableModelEventOccurred(
            $this, $event
        ))->dontBroadcastToCurrentUser();
    }



    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function hasUserApplied( User $user): bool
    {
        return $this->jobApplications()->where('user_id', $user->id)->exists();
    }

    protected $dispatchesEvents = [
        'created' => JobPosted::class,
    ];


    public function JobViewLogs(): HasMany
    {
        return $this->hasMany(JobViewLog::class);
    }
    #[Scope]
    protected function search(Builder $query, string $search): void
    {
        $query->where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->orWhereHas('company', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
    }
    #[Scope]
    protected function ofExperience(Builder $query, string $experience):void
    {
        $query->where('experience', $experience);
    }

    #[Scope]
    protected function ofCategory(Builder $query, string $category):void
    {
        $query->where('category', $category);
    }

    #[Scope]
    protected function minSalary(Builder $query, int $salary):void
    {
        $query->where('salary', '>=', $salary);
    }
    #[Scope]
    protected function maxSalary(Builder $query, int $salary):void
    {
        $query->where('salary', '<=', $salary);
    }
}
