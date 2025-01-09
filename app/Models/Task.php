<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Task extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'task_name',
        'Taskcategory_id',
        'project_id',
        'startDate',
        'endDate',
        'without_duedate',
        'AssignedTo',
        'Description',
        'priority_id',
        'status_id',
        'Addfile',
        'user_id',
    ];
}