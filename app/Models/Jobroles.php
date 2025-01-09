<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Jobroles extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'assign_emp_id',
    ];
}

