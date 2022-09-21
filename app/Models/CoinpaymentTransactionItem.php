<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinpaymentTransactionItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'coinpayment_transaction_id',
        'description',
        'price',
        'qty',
        'subtotal',
        'currency_code',
        'type',
        'state',
    ];

    
}
