<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class SSLCertificate extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'customer_id',
        'product_id',
        'host_domain_name',
        'os_id',
        'vender_id',
        'service_type',
        'first_payment',
        'billing_cycle',
        'currency_id',
        'payment_method_id',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'status',
        'license_key',
        'employee_id',
    ];
}

