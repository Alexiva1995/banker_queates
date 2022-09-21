<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WalletComission extends Model
{
    use HasFactory;
    protected $table = 'wallets_commissions';
    protected $fillable = [
        'user_id',
        'buyer_id',
        'level',
        'description',
        'investment_id',
        'amount',
        'amount_retired',
        'amount_available',
        'amount_last_liquidation',
        'type',
        'liquidation_id',
        'status',
        'avaliable_withdraw',
        'order_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Permite obtener la orden de esta comision
     *
     * @return void
     */
    public function getWalletComisiones()
    {
        return $this->belongsTo(OrdenPurchases::class, 'inversion_id', 'id');
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class, 'investment_id', 'id');
    }

    /**
     * Permite obtener al usuario de una comision
     *
     * @return void
     */
    public function getWalletUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Permite obtener al referido de una comision
     *
     * @return void
     */
    public function getWalletReferred()
    {
        return $this->belongsTo(User::class, 'referred_id', 'id');
    }


    /**
     * Permite obtener el estado de una transacción
     *
     * @return void
     */
    public function estado()
    {
        if($this->status == 1){
            return '<span class="badge bg-success">Pagado</span>';
        }else if($this->status == 0){
            return '<span class="badge bg-warning">En espera</span>';
        }else{
            return '<span class="badge bg-danger">Cancelado</span>';
        }
    }

}
