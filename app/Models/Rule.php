<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Rule extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'basic',
        'hra',
        'conveyance',
        'medical',
    ];
}

