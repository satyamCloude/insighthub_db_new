<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAccess extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_id',
        'permission_id',
        'user_id',
        'view',
        'add',
        'update',
        'delete',
    ];
}

