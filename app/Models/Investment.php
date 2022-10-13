<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'package_id',
        'payment_plataform',
        'invested',
        'gain',
        'type',
        'capital',
        'status',
        'pay_utility',
        'buyer_id',
        'expiration_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estado()
    {
        if($this->status == 1){
            return '<span class="badge bg-success">Activo</span>';
        }else{
            return '<span class="badge bg-danger">Culminado</span>';
        }
    }

    public function wallets()
    {
        return $this->hasMany('App\Models\WalletComission', 'investment_id');
    }

    public function ganancia()
    {
        return $this->wallets->where('tipo_transaction', 0)->where('status', 0)->sum('amount');
    }
    public function ganancia_rendimiento()
    {
        return $this->wallets->where('tipo_transaction', 0)->where('status', 0)->where('type', 5)->sum('amount');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function upgrade()
    {
        return $this->hasMany(Upgrade::class, 'investment_id');
    }
    public function licensePackage()
    {
        return $this->belongsTo(LicensePackage::class, 'package_id');
    }
    public function utilities() {
        return $this->hasMany(Utility::class);
    }

    public function getGainPercent()
    {
        $a = $this->invested;
        $b = $this->gain;
        $x = number_format(($b * 100) / $a, 2);
        return $x;
    }
}
