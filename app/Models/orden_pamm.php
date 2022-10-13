<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden_pamm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'monto',
        'status',
        'fecha'
    ];
}
