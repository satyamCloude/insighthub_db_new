<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotesCal extends Model
{
    use HasFactory;
        use SoftDeletes;
    protected $fillable = [
        
        'quotes_id',
        'qty',
        'description',
        'unit_price',
        'tax_rate',
        'tax',
        'Products_id',
        'BillingCycle',
        'discount',
        'total',
        'Caltax',
    ];
}

