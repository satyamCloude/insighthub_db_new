<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TotalService extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
       'unique_id',
        'user_id',
        'category_id',
        'invoice_id',
        'status',
    ];
}


