<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Other extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'vender_id',
        'product_id',
        'currency_id',
        'customer_id',
        'employee_id',
        'payment_method_id',
        'host_domain_name',
        'service_type',
        'billing_cycle',
        'server_ip',
        'status',
        'first_payment',
        'Other_note',
        'signup_date',
        'next_due_date',
        'terminate_date',
    ];
}

