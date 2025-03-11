<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = "employees";

    protected $fillable = [
        'role_id',
        'name',
        'phone_number',
        'address'
    ];
}
