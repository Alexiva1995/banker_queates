<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogRank extends Model
{
    use HasFactory;
    protected $fillable = [
        'range','user_id'
    ];
}
