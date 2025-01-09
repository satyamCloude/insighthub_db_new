<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Attendence extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'emp_Id',
        'punch_date',
        'punch_in',
        'punch_out',
        'shift_id',
        'overtime',
        'break_time',
    ];
}

