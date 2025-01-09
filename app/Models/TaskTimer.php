<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TaskTimer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',      
        'project_id',   
        'task_id',      
        'memo',      
        'run_status',      
        'start_time',   
        'stop_time',    
        'timer_date',   
    ];
}
