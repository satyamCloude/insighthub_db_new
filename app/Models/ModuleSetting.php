<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'module_settings';

    protected $fillable = [
        'id',
        'user_id',
        'clients',
        'projects',
        'tickets',
        'invoices',
        'timelogs',
        'estimates',
        'events',
        'messages',
        'tasks',
        'time_logs',
        'contracts',
        'notices',
        'payments',
        'orders',
        'knowledge_base',
        'employees',
        'attendance',
        'expenses',
        'leaves',
        'leads',
        'holidays',
        'products',
        'reports',
        'bank_account',
        'assets',
        'payroll',
        'purchase',
        'recruit',
        'webhooks',
        'zoom',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
