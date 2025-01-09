<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Quotes extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'subject',
        'user_id',
        'leads_id',
        'date_created',
        'status',
        'valid_until',
        'customer_name',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'company_id',
        'signature',
    ];
}

