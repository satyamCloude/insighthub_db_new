<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'product_type_id',
        'product_image',
        'category_id',
        'product_name',
        'url',
        'product_tag_line',
        'tax',
        'payment_method',
        'display_on_frontend',
        'product_description',
        'payment_type',
        'onetime_inr',
        'onetime_usd',
        'recurr_inr_hourly',
        'recurr_inr_monthly',
        'recurr_inr_quartely',
        'recurr_inr_semiannually',
        'recurr_inr_annually',
        'recurr_inr_biennially',
        'recurr_inr_triennially',
        'recurr_usd_hourly',
        'recurr_usd_monthly',
        'recurr_usd_quartely',
        'recurr_usd_semiannually',
        'recurr_usd_annually',
        'recurr_usd_biennially',
        'recurr_usd_triennially',
        'order_count',
    ];
}

