<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $fillable = [
        'shipping_cost',
        'email',
        'phone',
        'address',
                 
    ];
}
