<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class SharedFolder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'folder_id',
        'emp_id',
        
    ];
}

