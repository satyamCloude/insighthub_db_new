<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class ClientDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'company_id',
        'address_1',
        'address_2',
        'country',
        'state',
        'city',
        'pincode',
        'gstin',
        'hsn_sac',
        'tds',
        'payment_method',
        'currency',
        'all_emails',
        'invoices',
        'support',
        'services',
        'merge_same_due_date',
        'over_due_invoice',
        'tax_exampt',
        'projects',
        'doc_verify',
        'role_id',
    ];
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

