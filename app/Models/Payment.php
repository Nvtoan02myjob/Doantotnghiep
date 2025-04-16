<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
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
}
