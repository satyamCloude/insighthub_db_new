<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class LeaveAccess extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'leave_id',
        'role_id',
        'approved_by',
        'status',
        'days',
        'toGo',
    ];
}

