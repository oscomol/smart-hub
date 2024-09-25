<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'lrn', 'name', 'sex', 'birth_date', 'mother_tongue',
        'ip_ethnic_group', 'religion', 'barangay', 'municipality',
        'guardian_id', 'contact_number', 'learning_modality', 'remarks'
    ];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'guardian_id'); 
    }
    
}
