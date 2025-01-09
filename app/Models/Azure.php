<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Azure extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'vender_id',
        'product_id',
        'currency_id',
        'customer_id',
        'employee_id',
        'tenant_id',
        'azure_account_Id',
        'payment_method_id',
        'host_domain_name',
        'services_name',
        'service_type',
        'first_payment',
        'billing_cycle',
        'signup_date',
        'next_due_date',
        'terminate_date',
        'status',
        'azure_notes',
        'azure_login_url',
        'azure_username',
        'azure_password',
        'hosting_control_panel',
        'control_panel_user_name',
        'control_panel_password',
        'addon',
        'specification',
        'backup_security',
        'architecture',
        'license_management',
       
    ];
}