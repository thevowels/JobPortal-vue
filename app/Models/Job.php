<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
    use HasUuids;

    protected $table = 'jobs-table';

    public static array $experiences = ['junior','associate', 'senior'];

    public static array $categories = ['marketing', 'accounting', 'IT', 'finance', 'Admin'];

    #[Scope]
    protected function search(Builder $query, string $search): void
    {
        $query->where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%");
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
