<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class MailSettings extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'smtp_mailer',
        'mail_via',
        'smtp_host',
        'smtp_port',
        'smtp_user_name',
        'smtp_password',
        'smtp_encryption',
        'MAILCHIMP_API_KEY',
        'mail_via',
        'SERVER_PREFIX',
        'MailProvider',
        'mail_via',
        'RedirectUrl',
        'clientID',
        'ClientSecret',
        'connectionToken',
        'GSuite_mailer',
        'GSuite_host',
        'GSuite_port',
        'GSuite_user_name',
        'GSuite_password',
        'GSuite_encryption',
        'SES_mailer',
        'SES_host',
        'SES_port',
        'SES_user_name',
        'SES_password',
        'SES_encryption',
        'microSmtp_mailer',
        'microSmtp_host',
        'microSmtp_port',
        'microSmtp_user_name',
        'microSmtp_password',
        'microSmtp_encryption',
    ];
}