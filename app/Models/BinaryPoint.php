<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinaryPoint extends Model
{
    use HasFactory;
    
    protected $table = 'binary_points';
    protected $fillable = [
        'user_id',
        'buyer_id',
        'investment_id',
        'right_points_log',
        'left_points_log',
        'right_points',
        'left_points',
        'status',
        'limit_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
