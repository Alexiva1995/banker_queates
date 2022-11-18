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
        'quantity',
        'quantity_log',
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
