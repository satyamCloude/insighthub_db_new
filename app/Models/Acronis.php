<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Acronis extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'customer_id',
        'product_id',
        'host_domain_name',
        'vender_id',
        'service_type',
        'status',
        'Acronis_note',
        'first_payment',
        'billing_cycle',
        'currency_id',
        'payment_method_id',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'no_of_license',
        'protal_url',
        'username',
        'sige_gb_usages',
        'license_management',
        'employee_id',
        'password',
    ];
}

