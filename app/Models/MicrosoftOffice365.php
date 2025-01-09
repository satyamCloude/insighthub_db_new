<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class MicrosoftOffice365 extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'customer_id',
        'product_id',
        'domain_name_tenant_id',
        'quantity',
        'vender_id',
        'service_type',
        'customer_id2',
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
        'employee_id',
        'user_id',
    ];
}

