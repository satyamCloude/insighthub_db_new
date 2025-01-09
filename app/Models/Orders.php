<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'invoice_id',
        'product_id',
        'services_type',
        'unit_id',
        'client_id',
        'hostname',
        'name',
        'item_name',
        'tds_percent',
        'remarks',
        'is_payment_recieved',
        'invoice_number',
        'issue_date',
        'due_date',
        'currency',
        'cost_per_item',
        'quantity',
        'exchange_rate',
        'AssignedTo',
        'discount_value',
        'project_id',
        'calc_tax',
        'taxes',
        'assigned_to_id',
        'bank_account',
        'amount',
        'billing_address',
        'invoice_item_image_url',
        'shipping_address',
        'generated_by',
        'recipient_notes',
        'invoice_item_image',
        'invoice_attachment',
        'item_summary',
        'Vendor_id',
        'bill_attachment',
        'quotes_id',
        'product_description',
        'productCategoryId',
        'productTypeId',
        'amtWithoutGST',
        'currency',
    ];

// Inside the Orders model
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

// Inside the Orders model
public function clientDetails()
{
    return $this->belongsTo(ClientDetail::class, 'user_id');
}

// Inside the Orders model
public function product()
{
    return $this->belongsTo(ProductNew::class, 'product_id');
}

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }


}
