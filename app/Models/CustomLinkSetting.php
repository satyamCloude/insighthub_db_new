<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomLinkSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'link_title',
        'who_can_view',
        'url',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Other properties and methods in your model...
}
