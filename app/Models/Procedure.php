<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;

    protected $table = 'procedures';

    protected $fillable = [
        'school_time',
        'office_hours',
        'fee_structure',
        'fb',
        'email',
        'meetings',
    ];
}
