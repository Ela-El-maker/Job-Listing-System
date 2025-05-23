<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use Sluggable;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'logo',
        'banner',
        'name',
        'slug',
        'bio',
        'vision',
        'industry_type_id',
        'organization_type_id',
        'team_size_id',
        'establishment_date',
        'website',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'address',
        'map_link'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    function companyCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }


    function companyState(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }


    function companyCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    function industryType(): BelongsTo
    {
        return $this->belongsTo(IndustryType::class, 'industry_type_id', 'id');
    }

    function organizationType(): BelongsTo
    {
        return $this->belongsTo(OrganizationType::class, 'organization_type_id', 'id');
    }

    function teamSize(): BelongsTo
    {
        return $this->belongsTo(TeamSize::class, 'team_size_id', 'id');
    }

    function userPlan(): HasOne
    {
        return $this->hasOne(UserPlan::class, 'company_id', 'id');
    }

    function jobs(): HasMany
    {
        return $this->hasMany(Job::class, 'company_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function applications()
    {
        return $this->hasManyThrough(
            AppliedJob::class,
            Job::class,
            'company_id', // Foreign key on Job table...
            'job_id',     // Foreign key on AppliedJob table...
            'id',         // Local key on Company...
            'id'          // Local key on Job...
        );
    }
}
