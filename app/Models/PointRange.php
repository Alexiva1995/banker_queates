<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointRange extends Model
{
    use HasFactory;

    protected $table = 'point_range';

    protected $fillable = [
        'user_id',
        'buyer_id',
        'orden_id',
        'right_range_points',
        'left_range_points',
        'points_range_L',
        'points_range_R',
        'status',
        'limit'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function referred()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }
}
