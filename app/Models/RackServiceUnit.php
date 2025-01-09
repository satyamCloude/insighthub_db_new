<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class RackServiceUnit extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'rack_id',
        'unit_no',
        'rack_unique_id',
        'service_unique_id',
        'invoice_id',
        'status',
    ];
}

