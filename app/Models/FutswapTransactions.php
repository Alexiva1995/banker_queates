<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FutswapTransactions extends Model
{
    use HasFactory;
    protected $table = 'futswap_transactions';
    protected $fillable = [
        'orden_purchase_id',
        'billId',
        'status',
        'token',
        'coinName',
        'address',
        'value',
        'coinSymbol',
        'usdValue',
        'expires',
        'time',
        'paymentUrl',
        'defaultUnitValue',
        'totalPaid',
        'trm',
        'recoveryFeeTransaction',
        'transactionToMasterWallet',
        'internalFee',
        'index',
        'hash',
        'contractAddress',
        'blockchainSymbol',
        'secret'
    ];

    public function orderPurchase()
    {
        return $this->belongsTo(OrdenPurchase::class, 'orden_purchase_id');
    }

    public function storeFutswapTransaction($data)
    {
        $futswap_transaction =  $this::create($data);
        return $futswap_transaction;
    }

}
