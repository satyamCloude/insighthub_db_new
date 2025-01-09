<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class LeavePolicies extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title',
        'effective_date',
        'policies',
        'user_id',
    ];
}

