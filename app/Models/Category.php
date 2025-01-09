<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use App\Models\ProductNew;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'category_name',
    	'url',
        'company_id',
        'tag_line',
        'status',
	    'user_id',
    ];
    
    public function product()
    {
        return $this->hasMany(ProductNew::class, 'category_id');
    }

    public function productsWithTax()
    {
        return $this->product()->withTax();
    }
}

