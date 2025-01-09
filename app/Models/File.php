<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class File extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'folder_id',
        'sub_folder_id',
        'employee_id',
        'document_name',
        'type',
        'share_ids',
        'documents',
        'user_id',
    ];
}

