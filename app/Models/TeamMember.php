<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address_1',
        'address_2',
        'pincode',
        'country_id',
        'team_id',
    ];

    protected $dates = ['deleted_at'];

    // Optionally, you can define relationships or other methods here
}
