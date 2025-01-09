<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class MassMail extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
    'user_id',
    'to_id',
    'subject',
    'schedule_date',
    'status',
    'description',
    'headfoot_id',
    ];
}
