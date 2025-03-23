<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = "tables";

    protected $fillable = [
        'employee_id', 
        'qr_code', 
        'status', 
        'quantity_person', 
        'qr_img'
    ];
}
