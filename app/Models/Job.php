<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
    use HasUuids;

    protected $table = 'jobs-table';

    public static array $experiences = ['junior','associate', 'senior'];

    public static array $categories = ['marketing', 'accounting', 'IT', 'finance', 'Admin'];


}
