<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class BareMetal extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'os_id',
        'rack_id',
        'user_id',
        'vender_id',
        'switch_id',
        'employee_id',
        'invoice_id',
        'customer_id',
        'product_id',
        'currency_id',
        'payment_method_id',
        'firewall_serial_id',
        'host_domain_name',
        'service_type',
        'first_payment',
        'billing_cycle',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'dc_location',
        'floor_name',
        'unit_no',
        'server_serial_no',
        'server_tag_id',
        'product_manufacturer',
        'status',
        'bare_notes',
        'primary_public_ip',
        'additional_public_ip',
        'primary_private_ip',
        'additional_private_ip',
        'ilo_rmm_darc_console_url',
        'username',
        'password',
        'swith_port',
        'firewall_port',
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

