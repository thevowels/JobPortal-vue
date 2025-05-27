<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;
    use HasUuids;

    public static array $industries = ['Real Estate', 'Science', 'Martine', 'Import Export', 'Mechanical', 'Oil & Coal'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
