<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'preschool_name', 
        'preschool_year_graduated', 
        'preschool_awards',
        'elementary_school_name',
        'elementary_year_graduated',
        'elementary_awards'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
