<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelsExperience extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'level',
        'total_experiences',
    ];
}
