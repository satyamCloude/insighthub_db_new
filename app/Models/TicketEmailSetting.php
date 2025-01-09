<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TicketEmailSetting extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [

        'department_id',
        'smtp_mailer',
        'smtp_host',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'smtp_encryption',
        'email',
        'password',

        'support_smtp_mailer',
        'support_smtp_host',
        'support_smtp_port',
        'support_smtp_user_name',
        'support_smtp_password',
        'support_smtp_encryption',
        'sales_smtp_mailer',
        'sales_smtp_host',
        'sales_smtp_port',
        'sales_smtp_user_name',
        'sales_smtp_password',
        'sales_smtp_encryption',
        'account_smtp_mailer',
        'account_smtp_host',
        'account_smtp_port',
        'account_smtp_user_name',
        'account_smtp_password',
        'account_smtp_encryption',
        'support_email',
        'support_Auth',
        'Sales_email',
        'Sales_Auth',
        'Account_email',
        'Account_Auth',

    ];

    // Define relationship with Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

