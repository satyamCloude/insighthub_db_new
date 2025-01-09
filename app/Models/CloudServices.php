<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class CloudServices extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'os_id',
        'user_id',
        'switch_id',
        'vender_id',
        'product_id',
        'currency_id',
        'customer_id',
        'employee_id',
        'bare_metal_id',
        'payment_method_id',
        'firewall_serial_id',
        'dc_location',
        'first_payment',
        'host_domain_name',
        'service_type',
        'billing_cycle',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'swith_port',
        'firewall_port',
        'status',
        'vps_notes',
        'primary_public_ip',
        'additional_public_ip',
        'primary_private_ip',
        'additional_private_ip',
        'ip_kvm_console',
        'ip_kvm_username',
        'ip_kvm_password',
        'hosting_control_panel',
        'control_panel_user_name',
        'control_panel_password',
        'rdp_ssh_username',
        'rdp_ssh_port',
        'rdp_ssh_password',
        'pemkey',
        'Privatekey',
        'publickey',
        'addon',
        'license_management',
    ];
}

