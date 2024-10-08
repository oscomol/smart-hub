<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacEvent extends Model
{
    use HasFactory;

    protected $table = "fac_events";
    protected $fillable = [
        "eventName",
        "startAt",
        "endAt",
        "eventDescription"
    ];
} 
