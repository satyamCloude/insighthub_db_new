<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Host extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'client_id',
        'user_id',
        'service_id',
        'product_id',
        'host_name',
        'url',
        'billing_cycle',
        'singup',
        'servicestype',
        'status',
        'type',
        'method',
    ];
}

