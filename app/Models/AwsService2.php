<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwsService2 extends Model
{
    use HasFactory;
    protected $fillable = [
        'aws_id',
        'server_ip',
        'hostname',
        'rdp_ssh_username',
        'rdp_ssh_port',
        'rdp_ssh_password',
        'pemkey',
        'Privatekey',
        'publickey',
        'region',
    ];
}