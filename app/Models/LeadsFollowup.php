<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this line if you want to use soft deletes

class LeadsFollowup extends Model
{
    use HasFactory;
    use SoftDeletes; // Add this line if you want to use soft deletes

    protected $fillable = [
        'name',
        'follow_up_next',
        'start_time',
        'leads_id',
        'follow_up_by',
        'user_id',
        'custom_check_primary',
        'remark',
        'remind_before',
        'remind_type',
        'status',
    ];

   
}
