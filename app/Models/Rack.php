<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Rack extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'customer_id',
        'user_id',
        'vendor_id',
        'rack_id',
        'rack_power_unit',
        'rack_bandwidth',
        'rack_capacity',
        'dc_floor',
        'dc_area_zone',
        'rack_note',
        'status',
    ];
}

