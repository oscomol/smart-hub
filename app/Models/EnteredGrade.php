<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnteredGrade extends Model
{
    use HasFactory;

    protected $table = "entered_grades";

        protected $fillable = [
        "grade", "grade_id", "lrn", "section"
    ];
}