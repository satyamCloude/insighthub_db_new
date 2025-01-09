<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Leave extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'emp_Id',
        'apply_for',
        'duration',
        'leavetype_id',
        'start_date',
        'reply',
        'end_date',
        'description',
        'approved_by',
        'leave_sendTo',
        'reject_by',
        'date',
        'days',
        'user_id',
    ];
    
    public static function getTotalLeavesByDayOfWeek() {
    return Leave::select(DB::raw('DAYNAME(date) AS day_of_week'), DB::raw('COUNT(*) AS total_leaves'))
                ->groupBy('day_of_week')
                ->get();
}

    public function user()
    {
        return $this->belongsTo(User::class, 'emp_Id', 'id');
    }
}

