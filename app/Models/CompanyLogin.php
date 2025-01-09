<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class CompanyLogin extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'company_name',
        'portal_login_url',
        'country_id',
        'state_id',
        'city_id',
        'billing_address',
        'location',
        'tax_number',
        'address',
        'longitude',
        'latitude',
        'tax_name',
        'username',
        'company_website',
        'password',
        'password2',
        'authorised_person_name',
        'contact_no',
        'email_address',
        'aditional_informaiton',
        'status',
        'employee_id',
        'companylogo',
        'gst_number',
        'tan_number',
        'pan_number',
        'pin_code',
    ];
}

