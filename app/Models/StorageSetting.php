<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class StorageSetting extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'AWS_ACCESS_KEY_ID',
        'AWS_SECRET_ACCESS_KEY',
        'AWS_DEFAULT_REGION',
        'AWS_BUCKET',
        'S3_BASE_URL',
        'status',
    ];
}

