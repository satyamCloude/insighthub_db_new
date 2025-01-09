<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class PayRoll extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'emp_Id',
        'net_salary',
        'basic',
        'hra',
        'conveyance',
        'leaves',
        'workingdays',
        'deduction',
        'allowance',
        'tds',
        'net_paid',
        'medical_allowance',
        'date',
        
    ];
}

