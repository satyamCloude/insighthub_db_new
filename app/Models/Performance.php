<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Performance extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'totalrating',
        'employee_id',
        'evaluation_period',
        'year',
        'comments',
        'user_id',
        'date',
    ];
}

