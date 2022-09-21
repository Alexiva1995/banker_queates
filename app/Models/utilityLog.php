<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityLog extends Model
{
    use HasFactory;

     protected $fillable = [
        'percentage', 'status','name', 'image'
    ];
}
