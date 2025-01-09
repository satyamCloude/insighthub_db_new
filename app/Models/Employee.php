<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Employee extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'gender',
        'first_name',
        'middle_name',
        'last_name',
        'personal_email',
        'phone_number',
        'net_salary',
        'dob',
        'marriage_anniversary',
        'date_of_joining',
        'working_type_id',
        'employee_picture',
        'company_id',
        'department_id',
        'job_role_id',
        'admin_type_id',
        'permission_role_id',
        'team_lead',
        'weekly_off_id',
        'additional_week_off_first',
        'additional_week_off_second',
        'additional_week_off_third',
        'additional_week_off_fourth',
        'status',
        'team_lead_id',
        'date_of_relieving',
        'signature',
        'shift_id',
        'kra',
        'login_email',
        'password',
    ];
}

