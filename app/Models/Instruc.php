<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruc extends Model
{
    use HasFactory;

    protected $table = 'instrucs';

    protected $fillable = [
        "grade_id", "instructor_id"
    ];
}