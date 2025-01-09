<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class VendorDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'company_id',
        'address_1',
        'address_2',
        'country',
        'state',
        'city',
        'pincode',
        'gstin',
        'pen_ten_no',
        'cin',
        'tds',
        'portal_login_url',
        'access_security',
        'services_offered'
    ];
}

