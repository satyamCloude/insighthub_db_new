<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Licenses extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'customer_id',
        'product_id',
        'host_domain_name',
        'quantity',
        'vender_id',
        'service_type',
        'tenant_id',
        'customer_id2',
        'subscription_id',
        'status',
        'Licenses_note',
        'first_payment',
        'billing_cycle',
        'currency_id',
        'payment_method_id',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'protal_url',
        'username',
        'password',
        'license_management',
        'employee_id',
    ];
}

