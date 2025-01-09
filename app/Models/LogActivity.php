<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class LogActivity extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'ip',
        'subject',
        'url',
        'method',
        'to',
        'browser',
        'status',
        'type',
        'logout_time',
    ];
    
    protected $casts = [
        'logout_time' => 'datetime',
    ];
}