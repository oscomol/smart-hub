<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $table = "class_schedules";

    protected $fillable = [
        "startAt",
        "endAt",
        "day",
        "grade_id"
    ];
}
