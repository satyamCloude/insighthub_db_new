<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class CloudHosting extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'vender_id',
        'product_id',
        'customer_id',
        'firewall_id',
        'currency_id',
        'employee_id',
        'server_name_id',
        'payment_method_id',
        'dc_location',
        'os_id',
        'host_domain_name',
        'service_type',
        'first_payment',
        'billing_cycle',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'status',
        'dc_login_url',
        'dc_username',
        'dc_password',
        'cloudHosting_notes',
        'username',
        'password',
        'login_notes',
    ];
}

