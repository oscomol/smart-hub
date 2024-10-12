<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAtt extends Model
{
    use HasFactory;

    protected $table = 'event_atts';

    protected $fillable = [
        "event_id", "student_id", "time", "type"
    ];
}