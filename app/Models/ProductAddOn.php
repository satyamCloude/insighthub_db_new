<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAddOn extends Model
{
    use HasFactory,SoftDeletes;
     protected $fillable = [
        'user_id',
        'product_name',
        'product_id',
        'addon_id',
        'descriptions',
        'payment_type',
    ];


   
    
}
