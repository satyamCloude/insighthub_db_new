<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Inventory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'product_name',
        'product_code',
        'brand_name',
        'phone_number',
        'purchase_date',
        'warranty_expiry',
        'base_amount',
        'gst_vat',
        'tax_amount',
        'total_amount',
        'assigned_to_id',
        'Vendor_id',
        'bill_attachment',
        'product_description',
        'user_id',
    ];
}