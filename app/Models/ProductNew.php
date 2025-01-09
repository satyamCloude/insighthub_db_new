<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class ProductNew extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'company_id', 
        'category_id', 
        'product_name', 
        'description', 
        'url', 
        'product_type_id',
        'product_tag_line', 
        'tax_id', 
        'payment_method', 
        'payment_type', 
        'show_payment_type', 
        'status',
    ];
    
    
    public function scopeWithTax($query)
    {
        return $query->join('tax_settings', 'product_news.tax_id', '=', 'tax_settings.id')
                     ->select('product_news.*', 'tax_settings.rate', 'tax_settings.tax_name');
    }
    public function pricing()
    {
        return $this->hasOne(ProductPricing::class, 'product_id');
    }

    public function taxSetting()
    {
        return $this->belongsTo(TaxSetting::class, 'tax_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

}


