<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden_purchase_id',
        'status',
    ];

    public function ordenes()
    {
        return $this->belongsTo(OrdenPurchase::class, 'orden_purchase_id');
    }
}
