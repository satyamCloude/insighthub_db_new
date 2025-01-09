<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Template extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'status',
        'user_id',
        'name',
        'subject',
        'template_type',
        'header',
        'footer',
        'template',
        'template2',
    ];
}