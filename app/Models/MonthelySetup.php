<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class MonthelySetup extends Model
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
        'onetimesetup_notes',
        'todo_notes',
        'control_panel_login_url',
        'control_panel_user_name',
        'control_panel_password',
        'rdp_ssh_username',
        'rdp_ssh_port',
        'rdp_ssh_password',
        'server_ip',
        'control_panel_url',
        'pemkey',
        'Privatekey',
        'publickey',
        'addon',
        'license_management',
        'employee_id',
    ];
}

