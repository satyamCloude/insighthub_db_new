<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Credit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'client_id',
    ];

    protected $dates = ['deleted_at'];

    // Optionally, you can define relationships or other methods here
}
