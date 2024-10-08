<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacNotif extends Model
{
    use HasFactory;
    protected $table = "fac_notifs";
    protected $fillable = [
        "message",
        "isNew",
        "type",
        "faculty_id"
    ];
}