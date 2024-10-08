<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacAnnouncement extends Model
{
    use HasFactory;

    protected $table = "fac_announcements";
    protected $fillable = [
        "title",
        "announcement"
    ];
}
