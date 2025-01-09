<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antivirus extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'customer_id',
        'product_id',
        'vender_id',
        'currency_id',
        'payment_method_id',
        'host_domain_name',
        'quantity',
        'service_type',
        'status',
        'antivirus_note',
        'first_payment',
        'billing_cycle',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'protal_url',
        'username',
        'password',
        'license_key',
        'valid_domain_upto',
        'license_management',
        'employee_id',
    ];
}
