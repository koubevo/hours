<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'amount',
        'payment_date'
    ];
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getFormattedPaymentDateAttribute(): ?string
    {
        return $this->payment_date ? Carbon::parse($this->payment_date)->format('d.m.') : null;
    }
}
