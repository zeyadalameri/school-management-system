<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_invoice_id',
        'paid_amount',
        'paid_on',
        'payment_method',
        'reference_number',
        'notes',
        'received_by',
    ];

    protected $casts = [
        'paid_amount' => 'decimal:2',
        'paid_on' => 'date',
    ];

    public function feeInvoice(): BelongsTo
    {
        return $this->belongsTo(FeeInvoice::class);
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
