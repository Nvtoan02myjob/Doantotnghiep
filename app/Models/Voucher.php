<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'condition',
        'time_end',
    ];

}
