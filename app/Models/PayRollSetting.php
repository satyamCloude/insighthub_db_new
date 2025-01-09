<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class PayRollSetting extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'cron_url',
        'cron_date',
        'auto_generate',
    ];
}