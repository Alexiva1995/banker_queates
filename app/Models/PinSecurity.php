<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinSecurity extends Model
{
    use HasFactory;

    protected $table = 'pin_securities';

    protected $fillable = [
        'user_id',
        'pin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
