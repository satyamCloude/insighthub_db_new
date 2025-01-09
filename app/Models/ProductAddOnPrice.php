<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductAddOnPrice extends Model
{
    use HasFactory,SoftDeletes;
     protected $fillable = [
        'user_id',
        'product_add_on_id',
        'product_plan',
        'price',
        'currency_id',
    ];
}
