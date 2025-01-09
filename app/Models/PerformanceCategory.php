<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class PerformanceCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'category_name',
    	'description',
        'user_id',
    ];
}

