<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'allergies', 
        'medical_conditions', 
        'current_medication',
        'physician_name',
        'physician_contact_number'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
