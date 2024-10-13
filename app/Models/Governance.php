<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governance extends Model
{
    use HasFactory;
       
       protected $table = 'governance';

      
       protected $fillable = [
           'chairman',
           'd_chairman', // Elected Deputy Chairman
           'a_chairman', // Appointed Deputy Chairman
           'hod_science',
           'hod_mathematics',
           'hod_english',
           'hod_filipino',
           'hod_araling_panlipunan',
           'hod_values_education',
           'hod_mapeh',
           'hod_tle',
       ];
}
