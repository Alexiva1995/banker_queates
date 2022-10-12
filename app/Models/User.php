<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MyResetPassword;
use Illuminate\Support\Facades\Crypt;
use App\Models\WalletComission;
use App\Models\Member;
use App\Models\OrdenPurchase;
use App\Models\kyc;
use App\Models\WithdrawalErrors;
use App\Models\Prefix;
use App\Models\WalletLog;
use App\Http\Traits\Tree;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Tree;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'last_name',
        'email',
        'admin',
        'status',
        'email_verified_at',
        'photo',
        'password',
        'date_active',
        'birthdate',
        'countrie_id',
        'gender',
        'type_dni',
        'phone',
        'Prefix_id',
        'code_security',
        'buyer_id',
        'token_auth',
        'activar_2fact',
        'app_mode',
        'range_id'
    ];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'date_activo'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function countrie()
    {
        return $this->belongsTo('App\Models\Countrie', 'countrie_id');
    }

    public function memberships()
    {
        return $this->hasMany(Member::class, 'buyer_id');
    }

    public function prefix()
    {
        return $this->belongsTo(Prefix::class, 'prefix_id');
    }
    public function kyc()
    {
        return $this->belongsTo(kyc::class, 'id', 'user_id');
    }

    public function referidos()
    {
        return $this->hasMany(User::class, 'buyer_id');
    }

    public function fullName()
    {
        return $this->name . ' ' . $this->last_name;
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class,'id', 'user_id');
    }

    public function ordenes()
    {
        return $this->hasMany(OrdenPurchase::class, 'user_id');
    }

    public function investments()
    {
        return $this->hasMany(Investment::class, 'user_id');
    }

    public function wallets()
    {
        return $this->hasMany(WalletComission::class, 'user_id');
    }

    public function buyerWallets()
    {
        return $this->hasMany(WalletComission::class, 'buyer_id');
    }

    public function Points()
    {
        return $this->hasMany(Point::class, 'user_id');
    }

    public function ganancias()
    {
        $gain = 0;
        if (count($this->investments) > 0) {
            $gain = $this->investments->where('status', 1)->sum('gain');
        }

        return $gain;
    }

    public function progreso()
    {
        $gain = $this->investments->where('status', 1)->sum('gain');
        $capital = $this->investments->where('status', 1)->sum('capital');
        if ($capital > 0) {
            return ($gain / $capital) * 100;
        } else {
            return 0;
        }
    }

    /**
     * Permite obtener todas las ordenes de compra de saldo realizadas
     *
     * @return void
     */
    public function getWallet()
    {
        return $this->hasMany(WalletComission::class, 'user_id')->orderBy('id', 'desc')->where('type', '!=', '5');
    }

    /**
     * Permite obtener las ordenes de servicio asociada a una categoria
     *
     * @return void
     */
    public function getUserOrden()
    {

        return $this->belongsTo(OrdenPurchases::class, 'id', 'user_id');
    }

    public function hasActiveLicense()
    {
        $investment = Investment::where('user_id', $this->id)->where('status', 1)->first();
        if($investment)
        {
            return true;
        }
        return false;
    }

    /**
     * Permite obtener las ordenes de servicio asociada a una categoria
     *
     * @return void
     */
    public function investmentHigh()
    {
        return $this->getUserInvestments()->where('status', 1)->orderBy('invested', 'desc')->first();
        //->sortByDesc('invertido')
    }

    public function montoInvertido()
    {
        $amount = 0;
        $inversion = $this->investments->where('status', 1)->sortByDesc('invested')->first();
        if (isset($inversion)) {
            $amount += $inversion->invested;
        }

        return number_format($amount, 2);
    }

    public function inversionMasAlta()
    {
        return $this->investment->where('status', 1)->sortByDesc('invested')->first();
    }

    public function paquete()
    {
        $paquete = "";

        $inversiones = $this->investment->where('status', 1)->sortByDesc('invested')->first();

        if (isset($inversiones)) {
            switch ($inversiones->invested) {
                case $inversiones->invested >= 500 && $inversiones->invested <= 4900:

                    $paquete = 'FRESHMAN INVESTOR';
                    break;
                case $inversiones->invested >= 5000 && $inversiones->invested <= 14900:
                    $paquete = 'JUNIOR INVESTOR';
                    break;
                case $inversiones->invested >= 15000 && $inversiones->invested <= 29900:
                    $paquete = 'SENIOR INVESTOR';
                    break;
                case $inversiones->invested >= 30000 && $inversiones->invested <= 49900:
                    $paquete = 'MASTER INVESTOR';
                    break;
                case $inversiones->invested >= 50000 && $inversiones->invested <= 149000:
                    $paquete = 'MASTER PRO INVESTOR';
                    break;
                case $inversiones->invested >= 150000 && $inversiones->invested <= 299000:
                    $paquete = 'EXCELSIOR INVESTOR';
                    break;

                default:

                    break;
            }
        }
        return $paquete;
    }
    public function getClassPackage()
    {
        $class = "";
        $inversions = $this->investment->where('status', 1)->sortByDesc('invested')->first();
        if (isset($inversions)) {
            switch ($inversions->invested) {
                case $inversions->invested >= 500 && $inversions->invested <= 4900:
                    $class = 'freshman';
                    break;
                case $inversions->invested >= 5000 && $inversions->invested <= 14900:
                    $class = 'freshman';
                    break;
                case $inversions->invested >= 15000 && $inversions->invested <= 29900:
                    $class = 'senior';
                    break;
                case $inversions->invested >= 30000 && $inversions->invested <= 49900:
                    $class = 'master';
                    break;
                case $inversions->invested >= 50000 && $inversions->invested <= 149000:
                    $class = 'master-pro';
                    break;
                case $inversions->invested >= 150000 && $inversions->invested <= 299000:
                    $class = 'excelsior';
                    break;

                default:

                    break;
            }
        }

        return $class;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function montoTotalInvertido()
    {
        $amount = 0;
        $inversiones = $this->investment->where('status', 1)->sortByDesc('invested');

        foreach ($inversiones as $inversion) {
            $amount += $inversion->invested;
        }


        return number_format($amount, 2);
    }

    public function availableBalance()
    {
        return number_format($this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('amount'), 2);
    }

    /**
     * muestra el saldo disponible en numeros
     *
     * @return float
     */
    public function saldoDisponible(): float
    {
        return $this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('amount_fondo');
    }

    public function saldoDisponibleNumber(): float
    {
        return $this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('amount_fondo');
    }

    public function getFeeWithdraw(): float
    {
        $result = 0;
        $disponible = $this->saldoDisponibleNumber();
        if ($disponible > 0) {
            $result = ($disponible * 0.05);
        }
        return floatval($result);
    }

    public function totalARetirar(): float
    {
        $result = 0;
        $disponible = $this->saldoDisponibleNumber();
        if ($disponible > 0) {
            $result = ($disponible - $this->getFeeWithdraw());
        }
        return floatval($result);
    }

    public function hasReactivacion()
    {
        $hoy = \Carbon\Carbon::now();
        $date = $this->date_activo->addMonth(1);

        if ($hoy->gt($date)) {
            return true;
        }

        return false;
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token, $this->email));
    }

    public function getUser()
    {
        return $this->hasMany('App\Models\User', 'type');
    }

    public function countReferidosDirectos()
    {
        $referidos = $this->getChildrens($this, new Collection, 1);

        return count($referidos->where('nivel', 1));
    }

    public function padre()
    {
        return $this->belongsTo('App\Models\User', 'buyer_id');
    }

    function bonoIndirecto()
    {

        $bonoIndirecto = WalletComission::where([['user_id', '=', Auth::id()],['type', '=', 6]])->sum('amount');

        return $bonoIndirecto;
    }

    function bonoRecompra()
    {

        $bonoRecompra= WalletComission::where([['user_id', '=', Auth::id()],['type', '=', 1]])->sum('amount');

        return $bonoRecompra;
    }


    public function bonoInicio()
    {
        $bonoInicio = WalletComission::where([['user_id', '=', Auth::id()],['type', '=', 0]])->sum('amount');

        return $bonoInicio;
    }

    public function Activacion()
    {
        $bonoRecompra = WalletComission::where([['user_id', '=', Auth::id()],['type', '=', 1]])->sum('amount');

        return $bonoRecompra;
    }

    public function cartera()
    {
        $bonoCartera = WalletComission::where([['user_id', '=', Auth::id()],['type', '=', 2]])->sum('amount');

        return $bonoCartera;
    }
    public function rendimiento()
    {
        $Rendimiento = WalletComission::where([['user_id', '=', Auth::id()],['type', '=', 5]])->sum('amount');

        return $Rendimiento;
    }
    public function rendimientolist()
    {
        $list = WalletComission::where([['user_id', '=', Auth::id()],['type', '=', 5]])->get();

        return $list;
    }

    public function disponible()
    {
        $disponible = WalletComission::where([['user_id', '=', Auth::id()],['tipo_transaction', '=', 0], ['type', '!=', 5]])->sum('amount');

        return $disponible;
    }

    public function disponiblelist()
    {
        $disponible = WalletComission::where([['user_id', '=', Auth::id()],['tipo_transaction', '=', 0], ['type', '!=', 5]])->get();

        return $disponible;
    }

    public function WalletTotal()
    {
        $WalletTotal = WalletComission::where([['user_id', '=', Auth::id()],['tipo_transaction', '=', 0], ['type', '!=', 5],['status', '=', 0]])->get();

        return $WalletTotal;
    }


    public function totalIngresos()
    {
        $totalIngresos = WalletComission::where([['user_id', '=', Auth::id()],['status', '=', 0], ['type', '!=', 5]])->sum('amount');

        return $totalIngresos;
    }
    

    public function range()
    {
        return $this->belongsTo(Range::class);
    }

    public function decryptWallet()
    {
        return Crypt::decryptString($this->wallet->address);
    }

    public function decryptSeccurityCode()
    {
        return Crypt::decryptString($this->code_security);
    }

    public function walletLogs()
    {
        return $this->hasMany(WalletLog::class, 'user_id');
    }
    public function withdrawalErrors(){
        return $this->hasMany(WithdrawalErrors::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    /**
     * Obtiene las wallets del tipo rango
     * @return double el monto acumulado de sus wallets tipo rango
     */
    public function getWalletRangeAmount()
    {
        return $this->wallets->where('type', 1)->where('status', 0)->sum('amount');
    }
    /**
     * Obtiene las wallets dek tipo comission
     * @return double el monto acumulado de sus wallets tipo rango
     */
    public function getWalletComissionAmount()
    {
        return $this->wallets->where('type', 0)->where('status', 0)->sum('amount');
    }
    /**
     * Relación de User -> Utility
     * @return Relation
     */
    public function utilities()
    {
        return $this->hasMany(Utility::class);
    }
    /**
     * Obtiene el monto acumulado de las utilidades del usuario
     * @return double
     */
    public function getUtilitiesWaitingAmount()
    {
        return $this->utilities()->where('status', '0')->sum('amount');
    }
    /**
     * Obtiene la lista de los paquetes activos del usuario
     * @return Collection
     */
    public function getActivePackages()
    {
        $user_packages = new Collection();
        foreach($this->investments as $investment)
        {
            $package = new stdClass;
            $package->name = $investment->licensePackage->name;
            $package->amount = $investment->licensePackage->amount;
            $package->id = $investment->licensePackage->id;
            $package->investment_id = $investment->id;
            $user_packages->push($package);
        }
      return $user_packages = $user_packages->sortBy('id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
