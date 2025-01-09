<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class PayRollIncrement extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'increment_sallery',
        'increment_date',
        'Total_salary',
    ];
}