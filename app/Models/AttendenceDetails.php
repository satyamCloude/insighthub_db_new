<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendenceDetails extends Model
{
    use HasFactory;
     protected $fillable = [
        'emp_Id',
        'production_hours',
        'break_time',
        'over_time',
    ];
}
