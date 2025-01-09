<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Orders;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'is_notification_sent',
        'Quotesid',
        'client_id',
        'paid_amount',
        'is_payment_recieved',
        'product_id',
        'final_total_amt',
        'remarks',
        'invoice_number1',
        'invoice_number2',
        'tds_percent',
        'transaction_id',
        'transaction_date',
        'payment_method',
        'issue_date',
        'due_date',
        'currency',
        'order_id',
        'sub_total',
        'discount_value',
        'discount_amount',
        'discount_type',
        'exchange_rate',
        'project_id',
        'calc_tax',
        'bank_account',
        'amount',
        'shipping_address',
        'generated_by',
        'recipient_notes',
        'invoice_attachment',
        'after_frequency_counter',
        'before_frequency_counter',
    ];

    // Relationships
    public function orders()
    {
        return $this->hasOne(Orders::class, 'invoice_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function clientDetails()
    {
        return $this->belongsTo(ClientDetail::class, 'user_id');
    }

    public function taxSettings()
    {
        return $this->belongsTo(TaxSetting::class, 'taxes');
    }
     public function product()
    {
        return $this->belongsTo(ProductNew::class, 'product_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }
    

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
