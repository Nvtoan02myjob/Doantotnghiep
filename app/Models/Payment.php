<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    public $table='payments';
    protected $fillable = [
        'order_id',
        'status',
        'payment_method',
        'node',
        'money',
        'code_vnpay',
        'code_bank'
    ];
    // Quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
