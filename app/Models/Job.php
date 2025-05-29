<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
    use HasUuids;

    protected $table = 'jobs-table';

    public static array $experiences = ['junior','associate', 'senior'];

    public static array $categories = ['marketing', 'accounting', 'IT', 'finance', 'Admin'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
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
