<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'method', 'gateway', 'ref_num', 'amount', 'status',
    ];

    protected $attributes = [
        'status' => 0,
    ];

    public function isOnline()
    {
        return $this->method == 'online';
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function confirm(string $refNum, string $gateway = null)
    {
        $this->ref_num = $refNum;
        $this->gateway = $gateway;
        $this->status = 1;
        $this->save();
    }
}
