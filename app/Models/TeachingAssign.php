<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingAssign extends Model
{
    use HasFactory;

    protected $table = "teaching_assigns";

    protected $fillable = [
        "faculty_id",
        "assignment"
    ];
}
