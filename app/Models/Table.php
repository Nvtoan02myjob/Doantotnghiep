<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes;
    protected $table = "tables";

    protected $fillable = [
        'user_id', 
        'qr_code', 
        'status', 
        'quantity_person', 
        'qr_img'
    ];
}
