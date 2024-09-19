<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    // use Sluggable;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image',
        'cv',
        'full_name',
        'title',
        'website',
        'experience_id',
        'birth_date'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name'
    //         ]
    //     ];
    // }
}
