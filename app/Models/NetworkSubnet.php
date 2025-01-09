<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class NetworkSubnet extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'network_subnet',
        'subnet_mask',
        'vlan',
        'gateway',
        'primary_name_server',
        'secondary_name_server',
        'dc_location_id',
        'ip_type',
        'description',
        'isManual',
        'private_ip',
    ];
}

