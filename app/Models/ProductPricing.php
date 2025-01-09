<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPricing extends Model
{
    use HasFactory,SoftDeletes;
   protected $table = 'product_pricing';

    protected $fillable = [
        'product_id',
        'product_plan',
        'price',
        'plan_type',
        'currency_id',
        'status'
    ];
}
