<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AddonOrder extends Model
{
    use HasFactory,SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_Id',
        'product_id',
        'addon_id',
        'quantity',
        'tax',
        'price',
    ];
}
