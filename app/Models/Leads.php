<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Leads extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'gender',
        'first_name',
        'last_name',
        'requirement_amt',
        'email',
        'phone_number',
        'company_name',
        'category_id',
        'lead_source',
        'action_schedule',
        'date',
        'time',
        'assignedto',
        'requirement',
        'leadStatus',
        'leadStatusColor',
        'note',
        'status',
        'generated_by',
    ];
}

