<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Contracts\Encryption\DecryptException;

class Liquidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'amount_gross', 
        'amount_net', 
        'monto_bruto', 
        'amount_fee', 
        'hash',
        'wallet_used', 
        'code_correo', 
        'fecha_code', 
        'type', 
        'status',
    ];

    /**
     * Permite la informacion del usuario que se esta liquidando
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logLiquidation()
    {
        return $this->hasOne(LogLiquidation::class);
    }

    public function status()
    {
        if ($this->status == '0'){
            return "Pendiente";
        }elseif($this->status == '1'){
            return "Realizada";
        }
    }

    public function decryptWallet()
    {
        try {
            $decryp =  Crypt::decryptString($this->wallet_used);

            $this->wallet_used =  $decryp;

        } catch (DecryptException $e) {
            $this->wallet_used = $this->wallet_used;
        }
        return $this->wallet_used;
    }
}
