<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Goal extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'employee_id',
        'job_role_id',
        'goal_value',
        'currency_id',
        'months_id',
        'status',
        'archieved_value',
        'note',
        'date',
        'user_id',
    ];
}

