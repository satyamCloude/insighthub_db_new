<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'notification_type',
        'invoice_id',
        'user_id',
        'notification_sent_on',
        'reminder_sent_on',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Other properties and methods in your model...

    // Relationships

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
