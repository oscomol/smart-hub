<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'birth',
        'gender',
        'address',
        'phone',
        'email',
        'faculty_id',
        'degree',
        'specialization',
        'university',
        'graduation_year',
        'certification',
        'language',
        'employment_date',
        'current_position',
        'department',
        'employment_type',
        'experience',
        'development_activities',
        'workshops',
        'conferences',
        'research',
        'awards'
    ];

}
