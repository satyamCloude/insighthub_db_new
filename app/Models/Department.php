<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use App\Models\EmployeeDetail;

class Department extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'company_id',
        'name',
        'email',
        'allow_for_ticket',
    ];

    public function ticketEmailSettings()
    {
        return $this->hasOne(TicketEmailSetting::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function teamLead()
    {
        return $this->hasMany(EmployeeDetail::class, 'department_id', 'id')
        
                    ->where('team_lead', 1)
                    ->join('users', 'employee_details.user_id', '=', 'users.id')
                    ->join('jobroles', 'employee_details.jobrole_id', '=', 'jobroles.id')
                    ->select('employee_details.*', 'users.first_name', 'users.last_name', 'users.profile_img','jobroles.name as role');
    }
    
    
    public function employees()
    {
        return $this->hasMany(EmployeeDetail::class, 'department_id', 'id')
                    ->where('team_lead', 1)
                    ->join('users', 'employee_details.user_id', '=', 'users.id')
                    ->join('jobroles', 'employee_details.jobrole_id', '=', 'jobroles.id')
                    ->select('employee_details.*', 'users.first_name', 'users.last_name', 'users.profile_img','jobroles.name as role');
    }
    
    

}

