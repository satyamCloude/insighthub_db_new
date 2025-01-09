<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class LeadCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'lead_status',
        'label_color',
    ];
}

