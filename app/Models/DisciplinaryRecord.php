<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplinaryRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
         'incident_date', 
         'incident_description',
          'action_taken'
        ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
