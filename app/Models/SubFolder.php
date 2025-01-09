<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class SubFolder extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'folder_id',
        'sub_folder_name',
        'share_ids',
    ];
}

