<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $table = "orders";

    protected $fillable = [
        'user_id',
        'table_id',
        'status',
        'pin_code',
        'price_total'
    ];
    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   

    // Quan hệ với Table (nếu có)
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    // Quan hệ với OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(Order_detail::class);
    }
}
