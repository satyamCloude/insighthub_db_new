<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TimeSheet extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'project_id',
        'task_id',
        'user_id',
        'emp_id',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'memo',
        'total_hours',
        
    ];
}

