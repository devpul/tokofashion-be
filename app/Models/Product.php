<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        // timestamps
    ];

    // relasi di bawah ...

}
