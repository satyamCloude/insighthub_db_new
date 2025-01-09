<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PaymentMethodController;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'payment_details';
    protected $fillable = [
        'payment_mode',
        'is_show_on_order_form',
        'name',
        'key_id',
        'key_secret',
        'logo_url',
        'theme_color',
        'convert_to_for_processing',
        'bank_transfer_instructions',
        'paypal_email',
        'force_one_time_payments',
        'force_subscriptions',
        'require_shipping_address',
        'client_address_matching',
        'api_username',
        'api_password',
        'api_signature',
        'sandbox_mode',
        'status',
    ];

    public function getPaymentDetails()
    {
        // Modified SQL SELECT statement to include all columns
        return $this->select(
            'id',
            'payment_mode',
            'is_show_on_order_form',
            'name',
            'key_id',
            'key_secret',
            'logo_url',
            'theme_color',
            'convert_to_for_processing',
            'bank_transfer_instructions',
            'paypal_email',
            'force_one_time_payments',
            'force_subscriptions',
            'require_shipping_address',
            'client_address_matching',
            'api_username',
            'api_password',
            'api_signature',
            'sandbox_mode',
            'status',
            'created_at',
            'updated_at',
            'deleted_at'
        )->where(1)->get();
    }
}
