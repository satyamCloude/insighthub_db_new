<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Countrys extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'country_id',
        'country_name',
        'country_iso_code_2',
        'country_iso_code_3',
        'address_format_id',
    ];
}

