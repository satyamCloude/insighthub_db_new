<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OSCategory extends Model
{
    use HasFactory;
     protected $fillable = [
        'price',
        'currency_id',
        'category_id',
        'os_id',
        'status',
    ];
}
