<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class AppSetting extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'date_format',
        'time_format',
        'timezone',
        'currencyid',
        'Language',
        'datatable_row_limit',
        'welcometext',
        'Employeecanexportdata',
        'welcometextEmployee',
        'welcometextClient',
        'CompanyBanner',
        'CompanyBannerEmployee',
        'CompanyBannerClient',
    ];
}

