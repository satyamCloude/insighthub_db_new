<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Security extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'User_ip_address',
        'status',
        'user_id',
    ];
}