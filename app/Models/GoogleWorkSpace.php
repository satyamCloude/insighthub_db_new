<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class GoogleWorkSpace extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'employee_id',
        'customer_id',
        'customer_id2',
        'product_id',
        'domain_name_tenant_id',
        'vender_id',
        'quantity',
        'service_type',
        'subscription_id',
        'status',
        'google_notes',
        'first_payment',
        'billing_cycle',
        'currency_id',
        'payment_method_id',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'login_url',
        'username',
        'passwrod',
        'email',
    ];
}

