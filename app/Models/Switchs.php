<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Switchs extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'customer_id',
        'user_id',
        'product_id',
        'host_name',
        'switch_id',
        'vender_id',
        'service_type',
        'first_payment',
        'recurring_amount',
        'billing_cycle',
        'payment_method_id',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'modal_no',
        'hardware_tag',
        'no_of_ports',
        'rack_id',
        'unit_no',
        'floor_name',
        'primary_public_ip',
        'additional_public_ip',
        'primary_private_ip',
        'additional_private_ip',
        'login_url',
        'user_name',
        'password',
        'console',
        'employee_id',
        'status',
        'firewall_note',
    ];
}

