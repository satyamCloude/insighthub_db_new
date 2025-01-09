<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordDays extends Model
{
    use HasFactory;

    protected $fillable = [
        'password_security_days',
        'days',
    ];
}
