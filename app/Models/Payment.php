<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'method', 'gateway', 'ref_num', 'amount', 'status',
    ];

    protected $attributes = [
        'status' => 0,
    ];

    protected static function booted(): void
    {
        static::saving(function (Payment $payment) {
            if (! $payment->isOnline()) {
                $payment->gateway = null;
            }
        });
    }

    public function isOnline(): bool
    {
        return $this->method == 'online';
    }

    /* Relation Methods */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /* End Relation Methods */

    public function confirm(string $refNum, string $gateway = null): void
    {
        $this->ref_num = $refNum;
        $this->gateway = $gateway;
        $this->status = 1;
        $this->save();
    }
}
