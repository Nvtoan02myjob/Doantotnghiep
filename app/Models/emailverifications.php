<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class emailverifications extends Model
{

    public $table='emailverifications';
    protected $fillable = [
        'name',
        'email',
        'password',
        'code_auth',
        'number_phone'
    ];
}
