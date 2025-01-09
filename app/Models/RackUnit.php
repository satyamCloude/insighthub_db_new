<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'rack_id',
        'user_id',
        'unit_no',
        'serial_no',
        'serial_tag',
    ];
}

