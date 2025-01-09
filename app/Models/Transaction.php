<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Transaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'quotes_id',
        'invoice_id',
        'transactions_id',
        'razorpay_payment_id',
        'amount',
        'status',
        'razerpay_created_at',
        'razerpay_contact',
        'razerpay_vpa',
        'paymentMethod',
    ];
}

