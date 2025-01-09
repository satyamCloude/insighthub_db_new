<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'user_id',
        'attachment',
        'ccid',
        'department_id',
        'priority_id',
        'product_service_id',
        'subject',
        'message',
        'note',
        
        'task',
        'to',
        'status',
        'date',
    ];

public function responses()
    {
        return $this->hasMany(Response::class, 'ticket_id');
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Define the relationship to get the first response
    public function firstResponse()
    {
        return $this->hasOne(Chat::class)->orderBy('created_at', 'asc');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function chat()
    {
        return $this->hasMany(Chat::class, 'ticket_id');
    }
    
}
