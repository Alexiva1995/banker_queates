<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orden_pamm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'monto',
        'status',
        'fechas'
    ];
}
