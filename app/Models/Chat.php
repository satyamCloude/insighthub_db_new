<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'clientId',
        'departmentId',
        'ticket_id',
        'companyId',
        'message',
        'note',
    ];

    // Define relationship with Ticket model
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'clientId');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'companyId');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId');
    }
}
