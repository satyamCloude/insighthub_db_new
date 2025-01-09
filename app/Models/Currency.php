<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'currency_position',
        'no_of_decimals',
        'decimal_separator',
        'thousand_separator',
        'currency_format',
        'is_cryptocurrency',
        'exchange_rate',
        'is_default',
        'prefix',
        'code',
    ];
}
