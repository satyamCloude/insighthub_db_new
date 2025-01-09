<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Calendar extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'url',
        'id',
        'title',
        'start',
        'end',
        'startStr',
        'endStr',
        'display',
        'location',
        'guests',
        'calendar',
        'description',
        'allDay',
    ];
}

