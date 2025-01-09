<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceSettings extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoice_settings'; // Specify the table name if it's different

    protected $fillable = [
        'id',
        'name',
        'invoice_logo',
        'autorised_sign',
        'show_authorised_signatory',
        'reminder_frequency',
        'reminder_type',
        'due_after',
        'send_reminder_before', 
        'send_reminder_after',
        'show_gst',
        'hsn_sac_code_show',
        'show_tax_calculation_msg',
        'show_status',
        'show_client_name',
        'show_client_email',
        'show_client_phone',
        'show_client_company_name',
        'show_client_company_address',
        'show_project',
        'invoice_terms',
        'other_info'
    ];

}
