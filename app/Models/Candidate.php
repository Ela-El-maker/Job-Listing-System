<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use Sluggable;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image',
        'cv',
        'full_name',
        'title',
        'website',
        'experience_id',
        'birth_date',
        'gender',
        'marital_status',
        'profession_id',
        'status',
        'bio',
        'country',
        'state',
        'city',
        'address',
        'phone_one',
        'phone_two',
        'email',

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
                'source' => 'full_name'
            ]
        ];
    }


    function skills() : HasMany
    {
        return $this->hasMany(CandidateSkill::class, 'candidate_id','id');
    }

    function languages() : HasMany
    {
        return $this->hasMany(CandidateLanguage::class, 'candidate_id','id');
    }



    function candidateCountry() : BelongsTo
    {
        return $this->belongsTo(Country::class, 'country','id');
    }


    function candidateState() : BelongsTo
    {
        return $this->belongsTo(State::class, 'state','id');
    }


    function candidateCity() : BelongsTo
    {
        return $this->belongsTo(City::class, 'city','id');
    }

    function experience() : BelongsTo
    {
        return $this->belongsTo(Experience::class, 'experience_id','id');
    }

    function experiences() : HasMany
    {
        return $this->hasMany(CandidateExperience::class, 'candidate_id','id')->orderBy('id','DESC');
    }

    function educations() : HasMany
    {
        return $this->hasMany(CandidateEducation::class, 'candidate_id','id')->orderBy('id','DESC');
    }

    function profession() : BelongsTo
    {
        return $this->belongsTo(Profession::class, 'profession_id','id');
    }

}
