<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tax_name',
        'rate',
        'status',
        'new_field1', // Add your new fields here
        'new_field2',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Other properties and methods in your model...

}
