<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TimeShift extends Model
{
    use HasFactory,SoftDeletes;

     protected $fillable = [
        'shift_name',
        'Colorname',
        'StartTime',
        'EndTime',
        'HalfdayMarkTime',
        'working_hours',
        'EarlyClockIn',
        'Latemarkafter',
        'Maximumcheckinallowedinaday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'break_time',
    ];
}






















