<?php

namespace App\Models;
use App\Models\User;
use App\Models\OrdenPurchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Faker\Provider\DateTime;

class Member extends Model
{
    use HasFactory;

     protected $fillable = [
        'referred_id',
        'orden_purchase_id',
        'pool_global_id',
        'status',
        'start_date',
        'end_date'
    ];

    public function referidos()
    {
        return $this->hasMany(User::class, 'referred_id');
    }

    public function ordenes()
    {
        return $this->belongsTo(OrdenPurchase::class, 'orden_purchase_id');
    }
    public function formulary()
    {
        return $this->hasMany(Formulary::class, 'member_id', 'id');
    }
    public function getMembershipByType($type){
        $memberShips = Member::where([['referred_id', Auth::id()], ["status", "activo"]])->with("ordenes")->get();
        $Bronce = null;
        $Plata = null;
        $Oro = null;
        $Platino = null;
        foreach ($memberShips as $memberShip) {
            if ($memberShip->ordenes->type == "Bronce") {
                $Bronce = $memberShip;
            } else if ($memberShip->ordenes->type == "Plata") {
                $Plata = $memberShip;
            } else if ($memberShip->ordenes->type == "Oro") {
                $Oro = $memberShip;
            } else if ($memberShip->ordenes->type == "Platino") {
                $Platino = $memberShip;
            }
        }
        switch ($type) {
            case 'Bronce':
                return $Bronce;
            case "Plata":
                return $Plata;
            case "Oro":
                return $Oro;
            case "Platino":
                return $Platino;
        }
    }

    
    public function getMembershipByTypeManual($type, $userId){
        $memberShips = Member::where([['referred_id', $userId], ["status", "activo"]])->with("ordenes")->get();
        $Bronce = null;
        $Plata = null;
        $Oro = null;
        $Platino = null;
        foreach ($memberShips as $memberShip) {
            if ($memberShip->ordenes->type == "Bronce") {
                $Bronce = $memberShip;
            } else if ($memberShip->ordenes->type == "Plata") {
                $Plata = $memberShip;
            } else if ($memberShip->ordenes->type == "Oro") {
                $Oro = $memberShip;
            } else if ($memberShip->ordenes->type == "Platino") {
                $Platino = $memberShip;
            }
        }
        switch ($type) {
            case 'Bronce':
                return $Bronce;
            case "Plata":
                return $Plata;
            case "Oro":
                return $Oro;
            case "Platino":
                return $Platino;
        }
    }
    public function getDataChart($membership) {
        if ($membership->start_date != null) { 
        $diaInicio = Carbon::createFromFormat("Y-m-d", $membership->start_date);
        $diaFinal = Carbon::createFromFormat("Y-m-d", $membership->end_date);
        $diferenciasDias = $diaInicio->diffInDays($diaFinal);
        $diaActual = now();
        $diasRestantes = $diaFinal->diffInDays($diaActual);
        $data = [
            $diferenciasDias,
            $diasRestantes + 1
        ];   
        return $data;
        } else {
            return false;
        }
    }
    function discountMember($type) {
        $memberActive = $this->getMembershipByType($type);
        if ($memberActive != null) {
            if ($memberActive->start_date != null && $memberActive->end_date != null) {
                $diaInicio = Carbon::createFromFormat("Y-m-d", $memberActive->start_date);
                $diaFinal = Carbon::createFromFormat("Y-m-d", $memberActive->end_date);
                $diferenciasDias = $diaInicio->diffInDays($diaFinal);
                $remainingDays = now()->diffInDays($memberActive->end_date) + 1;
                $amount = $memberActive->ordenes->membershipPackage->amount_per_month;
                return ($amount/$diferenciasDias)*$remainingDays;
            }else{
                return 0;
            }
        } else {
            return 0;
        }   
    }
    function amountMemberManual($userId) {
       

        $memberShips = Member::where([['referred_id', $userId], ["status", "activo"]])->with("ordenes")->get();
       dd($memberShips);
       
        if ($memberShips != null) {
                $amount = $memberShips->ordenes->membershipPackage->amount_per_month;
                return $amount;
            }else{
                return 0;
            }
    }

    function discountMemberManual($type,$userId) {
        $memberActive = $this->getMembershipByTypeManual($type, $userId);
        if ($memberActive != null) {
            if ($memberActive->start_date != null && $memberActive->end_date != null) {
                $diaInicio = Carbon::createFromFormat("Y-m-d", $memberActive->start_date);
                $diaFinal = Carbon::createFromFormat("Y-m-d", $memberActive->end_date);
                $diferenciasDias = $diaInicio->diffInDays($diaFinal);
                $remainingDays = now()->diffInDays($memberActive->end_date) + 1;
                $amount = $memberActive->ordenes->membershipPackage->amount_per_month;
                return ($amount/$diferenciasDias)*$remainingDays;
            }else{
                return 0;
            }
              
        } else {
            return 0;
        }   
    }
}
