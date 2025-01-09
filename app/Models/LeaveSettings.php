<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveSettings extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'leave_settings'; // Corrected table name

    protected $fillable = [
        'count_leave_from',
        'start_year_from',
        'leave_approval_permission',
        'status',
    ];

}
