<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientInvoice extends Model
{
    protected $fillable = [
        'client_id',
        'project_id',
        'invoice_number',
        'client_email',
        'invoice_date',
        'amount',
        'status',
        'due_date',
        'sent_at',
        'paid_at',
        'tax',
        'discount',
        'payment_status',
        'payment_method',
        'attachment',
        'profit',
        'loss',
    ];
}
