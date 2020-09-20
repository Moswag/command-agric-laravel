<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GMBPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'cropId',
    ];
}
