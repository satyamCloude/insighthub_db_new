<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'leads_id',
        'file_name',
        'file',
    ];
}
