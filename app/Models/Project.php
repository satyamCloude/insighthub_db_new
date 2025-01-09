<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_name',
        'date',
        'any_one',
        'client_id',
        'start_date',
        'deadline',
        'category_id',
        'department_id',
        'notes',
        'is_public',
        'without_deadline',
        'project_summary',
        'project_manager_id',
        'team_id',
        'priority_id',
        'Type_id',
        'status_id',
        'project_value',
        'Document',
        'Task',
        'status_pro',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Define relationships or additional methods as needed
}
