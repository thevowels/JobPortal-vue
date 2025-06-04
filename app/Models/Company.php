<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;
    use HasUuids;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('company');
    }


    protected $fillable = [
        'name',
        'location',
        'industry',
        'website',
        'user_id',
    ];

    public static array $industries = ['Real Estate', 'Science', 'Martine', 'Import Export', 'Mechanical', 'Oil & Coal'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
