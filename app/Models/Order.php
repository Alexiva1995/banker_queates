<?php

namespace App\Models;

use Hexters\CoinPayment\Entities\CoinpaymentTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'package_id',
        'amount',
        'fee',
        'status',
        'type',
        'voucher',
        'hash'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investment()
    {
        return $this->hasOne(Investment::class);
    }
    public function coinpaymentTransaccion()
    {
        return $this->hasOne(CoinpaymentTransaction::class);
    }
    public function licensePackage()
    {
        return $this->belongsTo(LicensePackage::class, 'package_id');
    }
    public function status()
    {
        if ($this->status == '0'){
            return "Esperando";
        }elseif($this->status == '1'){
            return "Aprobado";
        }elseif($this->status >= '2'){
            return "Rechazada";
        }
    }
}
