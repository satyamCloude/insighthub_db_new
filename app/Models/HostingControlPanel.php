<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class HostingControlPanel extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'hosting_name',
        'price',
        'status',
        'currency_id',
        'plan_type',
    ];
}
