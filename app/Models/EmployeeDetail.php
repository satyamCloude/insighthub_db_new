<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class EmployeeDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'dob',
        'marriage_anniversary',
        'date_of_joining',
        'net_salary',
        'company_id',
        'department_id',
        'jobrole_id',
        'job_role_id',
        'admin_type_id',
        'permission_role_id',
        'team_lead',
        'weekly_off_id',
        'additional_week_off_first',
        'additional_week_off_second',
        'additional_week_off_third',
        'additional_week_off_fourth',
        'team_lead_id',
        'date_of_relieving',
        'working_type_id',
        'signature',
        'shift_id',
        'kra',
    ];

    
        
}

