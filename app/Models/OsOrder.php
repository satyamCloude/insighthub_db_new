<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OsOrder extends Model
{
     use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'order_Id',
        'os_id',
        'price',
        'tax',
        'product_id',
    ];
}
