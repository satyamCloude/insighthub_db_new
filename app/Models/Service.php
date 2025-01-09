<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'service_name',
        'service_price',
        'client',
        'project_id',
        'service_type_id',
        'task_id',
        'vendor_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
