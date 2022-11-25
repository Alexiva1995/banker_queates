<?php

namespace App\Http\Controllers;

use App\Exports\LiquidationsExport;
use Carbon\Carbon;
use App\Mail\CodeRetiro;
use App\Mail\WithdrawAdmin;
use App\Mail\withdrawRequest;
use App\Models\CodeSeccurity;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Liquidation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Utility;
use App\Models\Transactions;
use App\Models\WalletComission;
use App\Services\FutswapService;
use App\Models\WithdrawalSetting;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\RetiroAprobado;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class LiquidactionController extends Controller
{
    public function __construct(FutswapService $futswapService = null)
    {
        $this->futswap = $futswapService;
    }

    public function retiros()
    {
        $user = Auth::user()->id;
        $withdrawals = Liquidation::where('iduser', $user)->orderBy('id', 'desc')->get();

        return view('business.retiros', compact('withdrawals'));
    }

    public function retiro()
    {

        $retiros = Liquidation::where('status', 0,)->where('user_id', Auth::id())->get();

        return view('business.solicitudesRetiros', compact('retiros'));
    }

    public function solicitudesRetiros()
    {
        $user = auth()->user();
        // Valida si el usuario tiene una wallet enlazada para poder retirar
        if (!$user->wallet) {
            return redirect()->back()->with('warning', 'Debe primero enlazar una wallet');
        }
        // Si el usuario hizo un cambio en su wallet no puede retirar durante 15 dias
        $remaining_days = $user->wallet->updated_at->diffInDays(now());
        if ($remaining_days <= 15) {
            $remaining_days = 15 - $remaining_days;
            return redirect()->back()->with('warning', "Debido a que modifico su wallet debe esperar {$remaining_days} dias para poder solicitar retiros");
        }

        $config = WithdrawalSetting::first();
        $date = now('America/Caracas');
        $date->subHour(1);
        $time_start = Carbon::createFromFormat('H:i:s', $config->time_start)->toTimeString();
        $time_end = Carbon::createFromFormat('H:i:s', $config->time_end)->toTimeString();

        // Valida si el dia actual esta dentro de los dias condigurados para poder realizar retiros
        if (!($date->dayOfWeek  == $config->day_start || $date->dayOfWeek  == $config->day_end)) {
            return redirect()->back()->with('warning', 'La solicitud de retiro solo puede realizarse los días ' . $config->getFirtsDayOfWeek() . ' y ' . $config->getLastDayOfWeek() . '.');
        }

        // Valida si la hora actual se encuentra entre el rango permitido para realizar retiros
        if (!($date->toTimeString() >= $time_start && $date->toTimeString() <= $time_end)) {

            $time_start = Carbon::createFromFormat('H:i:s', $config->time_start)->format('h:i A');
            $time_end = Carbon::createFromFormat('H:i:s', $config->time_end)->format('h:i A');

            return redirect()->back()->with('warning', 'La solicitud de retiro solo puede realizarse de ' . $time_start . ' a ' . $time_end . ' Hora Texas');
        }

        $balance = WalletComission::where([
            ['user_id', $user->id],
            ['status', 0]
        ])->sum('amount_available');

        $fee = $config->percentage;

        $withdrawalSettings = WithdrawalSetting::first();
        return view('business.retiro', compact('balance', 'fee', 'withdrawalSettings'));
    }

    public function liquidationValidate()
    {
        return view("liquidaciones.validacion");
    }
    public function realizadas()
    {
        $liquidaciones = Liquidation::where('status', 1)->with('user')->orderBy('id', 'desc')->get();

        return view('liquidaciones.realizadas', compact('liquidaciones'));
    }

    public function pendientes()
    {
        $liquidaciones = Liquidation::where('status', 0)->with('user')->orderBy('id', 'desc')->get();

        return view('liquidaciones.pendientes', compact('liquidaciones'));
    }
    public function codeEmail()
    {
        $code = Crypt::encrypt(Str::random(10));
        $user = User::where("id", Auth::id())->first();
        $user->update(['token_sistem' => $code]);
        $desincryptarDB =  Crypt::decrypt($user->token_sistem);
        $dataMail = [
            "code" => $desincryptarDB,
            'logo' => public_path('/images') . '/login/connect.png'
        ];
        // Mail::to($email)->send($mail);
        Mail::send('mails.MailLiquidation', $dataMail,  function ($msj) {
            $msj->subject('Codigo liquidacion');
            $msj->to(auth()->user()->email);
        });
        return json_encode("success");
    }
    public function liquidationCheck(Request $request)
    {

        $user = User::where("id", Auth::id())->first();
        $desincryptarDB =  Crypt::decrypt($user->token_sistem);
        $data = request()->validate([
            "code" => "required",
            "codeAuth" => "required",
        ], [
            "code.required" => "No se ha ingresado ningun codigo",
            "codeAuth.required" => "No se ha ingresado el codigo de autentificacion"
        ]);
        if ($data["code"] == $desincryptarDB && (new Google2FA())->verifyKey($user->token_auth, $request->codeAuth)) {
            return redirect()->route("liquidaciones.pendientes");
        } else {
            return back()->with("warning", "El codigo no coincide");
        }
    }
    public function withdraw()
    {
        return view('business.withdraw');
    }
    public function withdrawCapital(Request $request)
    {
        $wallet = $request->wallet;
        $amount = $request->amount;
        $inversionId = $request->inversionId;
        $fee = 0.05;
        $data = [
            'wallet' => $wallet,
            'amount' => $amount,
            'inversionId' => $inversionId,
            'fee' => $fee
        ];
        return view('business.withdraw', compact('data'));
    }
    public function procesarLiquidacion(Request $request)
    {

        // try {
        $accion = $request->accion;
        $liquidacion_id = $request->liquidacion_id;

        if ($accion == 'aprobar') {
            $HASH = $request->HASH_transaccion;

            if ($HASH != null && !empty($HASH)) {
                $transaccion = Transactions::where([['liquidation_id', $liquidacion_id], ['status', 0]])->get();
                for ($j = 0; $j < count($transaccion); $j++) {
                    if (isset($transaccion[$j])) {
                        $wallets_id = $transaccion[$j]['wallets_commissions_id'];
                        $transaccion[$j]['status'] = 1;
                        $transaccion[$j]->update();
                        $wallets = WalletComission::where('id', $wallets_id)->get();
                        for ($l = 0; $l < count($wallets); $l++) {
                            if (!empty($wallets[$l])) {
                                if ($wallets[$l]['amount_available'] == 0) {
                                    $wallets[$l]['status'] = 1;
                                }
                                $wallets[$l]->update();
                            }
                        }
                    }
                }
                $data = 'Liquidacion_aprobada';

                $Liquidation = Liquidation::where('id', $liquidacion_id)->first();
                $Liquidation['status'] = 1;
                $Liquidation['hash'] = $HASH;
                $Liquidation->update();

                return response()->json(['value' =>  $data]);
            } else {
                $data = 'sin_hash';
                return response()->json(['value' =>  $data]);
            }
        } else {

            $transaccion = Transactions::where([['liquidation_id', $liquidacion_id], ['status', 0]])->get();
            for ($i = 0; $i < count($transaccion); $i++) {
                if (isset($transaccion[$i])) {
                    if ($transaccion[$i]['utilies_id'] == null) {
                        $wallets_id = $transaccion[$i]['wallets_commissions_id'];
                        $transaccion[$i]['status'] = 2;
                        $transaccion[$i]->update();
                        $wallets = WalletComission::where('id', $wallets_id)->get();
                        for ($u = 0; $u < count($wallets); $u++) {
                            if (!empty($wallets[$u])) {
                                $wallets[$u]['amount_available'] =  $wallets[$u]['amount_available'] + $wallets[$u]['amount_retired'];
                                $wallets[$u]['amount_retired'] = 0;
                                $wallets[$u]['status'] = 0;
                                $wallets[$u]->update();
                            }
                        }
                    } else {
                        $utility_id = $transaccion[$i]['utilies_id'];
                        $transaccion[$i]['status'] = 2;
                        $transaccion[$i]->update();
                        $utilidad = Utility::where('id', $utility_id)->get();
                        for ($j = 0; $j < count($utilidad); $j++) {
                            if (!empty($utilidad[$j])) {
                                $utilidad[$j]['amount_available'] =  $utilidad[$j]['amount_available'] + $utilidad[$j]['amount_retired'];
                                $utilidad[$j]['amount_retired'] = 0;
                                $utilidad[$j]['status'] = 0;
                                $utilidad[$j]->update();
                            }
                        }
                    }
                }
            }
            $data = 'liquidacion_regresada';
            Liquidation::where('id', $liquidacion_id)->update(['status' => 2]);
            return response()->json(['value' =>  $data]);
        }

        /*  } catch (\Throwable $th) {
            Log::error('Liquidaction - saveLiquidation -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        } */
    }
    public function cambiarStatus(Request $request)
    {

        if ($request->status == 1) {

            $liquidacion = Liquidation::where('id', $request->id)->first();
            try {
                $idliquidation = $liquidacion->id;
                $liquidation = Liquidation::find($idliquidation);

                $Inversion = Investment::where('id', $liquidation->inversion_id)->first();
                $Inversion->capital -= $liquidation->monto_bruto;
                if ($Inversion->capital <= 0) {
                    $Inversion->capital = 0;
                    $Inversion->status = 2;
                }
                $Inversion->save();

                Liquidation::where('id', $idliquidation)->update([
                    'status' => 1,
                ]);

                $accion = 'Aprobada';

                $arrayLog = [
                    'idliquidation' => $idliquidation,
                    'accion' => $accion
                ];
                DB::table('log_liquidations')->insert($arrayLog);

                $user = $liquidation->getUserLiquidation;
                $user->notify(new RetiroAprobado($user));

                return back()->with('success', 'La liquidación fue aprobada con éxito');
            } catch (\Throwable $th) {
                Log::error('Liquidaction - saveLiquidation -> Error: ' . $th);
                abort(403, "Ocurrio un error, contacte con el administrador");
            }
        } else {
            try {
                DB::beginTransaction();
                $liquidacion = Liquidation::findOrFail($request->id);
                $liquidacion->status = $request->status;
                $liquidacion->save();


                DB::commit();

                return back()->with('success', 'Status cambiado exitosamente');
            } catch (\Throwable $th) {

                DB::rollback();

                Log::error('Retiro - cambiarStatus -> Error: ' . $th);
                abort(403, "Ocurrio un error, contacte con el administrador");
            }
        }
    }

    /**
     * Permite aprobar las liquidaciones
     *
     * @param integer $idliquidation
     * @param string $hash
     * @return void
     */
    public function aprobarLiquidacion($idliquidation, $billetera)
    {
        Liquidation::where('id', $idliquidation)->update([
            'status' => 1,
        ]);

        Wallet::where('liquidation_id', $idliquidation)->update(['liquidado' => 1]);
    }

    public function reversarLiquidacion($idliquidation, $comentario)
    {
        $liquidacion = Liquidation::find($idliquidation);

        Wallet::where('liquidation_id', $idliquidation)->update([
            'status' => 2,
            'liquidation_id' => null,
            'liquidado' => 0
        ]);

        // $concepto = 'Liquidacion Reservada - Motivo: '.$comentario;
        // $arrayWallet =[
        //     'user_id' => $liquidacion->iduser,
        //     'orden_purchases_id' => null,
        //     'referred_id' => $liquidacion->iduser,
        //     'monto' => $liquidacion->monto_bruto,
        //     'descripcion' => $concepto,
        //     'status' => 3,
        //     'tipo_transaction' => 0,
        // ];

        // $this->walletController->saveWallet($arrayWallet);

        $liquidacion->status = 0;
        $liquidacion->save();
    }


    public function saveLiquidation(array $data): int
    {
        $liquidacion = Liquidation::create($data);
        return $liquidacion->id;
    }

    public function sendCodeEmail()
    {
        try {
            $this->reversarRetiro30Min();

            $user = Auth::user();

            $comisiones = Wallet::where([
                ['user_id', '=', $user->id],
                ['liquidado', '=', 0],
                ['tipo_transaction', '=', 0],
                ['type', '!=', 5]
            ])->whereIn('status', [0, 2])->get();

            $bruto = $comisiones->sum('amount_fondo');
            if ($bruto < 60) {
                return response()->json(['message' => 'el monto minimo es 60']);
            }

            $feed = ($bruto * 0.05);
            $total = ($bruto - $feed);


            $arrayLiquidation = [
                'iduser' => $user->id,
                'total' => $total,
                'monto_bruto' => $bruto,
                'feed' => $feed,
                'hash',
                // 'wallet_used' => $user->wallet,
                'status' => 0,
                'code_correo' => Str::random(10),
                'fecha_code' => Carbon::now()
            ];
            $idLiquidation = $this->saveLiquidation($arrayLiquidation);

            $dataEmail = [
                'total' => $total,
                'user' => $user->fullname(),
                'code' => $arrayLiquidation['code_correo']
            ];

            Mail::send('mail.SendCodeRetiro', $dataEmail,  function ($msj) use ($user) {
                $msj->subject('Codigo Retiro');
                $msj->to($user->email);
            });

            return $idLiquidation;
        } catch (\Throwable $th) {
            Log::error('Liquidaction - sendCodeEmail -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function retiroAprobado()
    {
        $user = Auth::user();
        $wallets = Liquidation::where([
            ['iduser', '=', $user->id],
            ['status', '=', 1]
        ])->get();

        foreach ($wallets as $wallet) {
            $datos = [
                'total' => $wallet->total,
                'wallet_used' => $wallet->wallet_used,
                'user' => $user->fullname()
            ];
        }

        Mail::send('mail.retiroExitoso', $datos,  function ($msj) use ($user) {
            $msj->subject('Codigo Retiro');
            $msj->to($user->email);
        });
    }

    public function reversarRetiro30Min(): bool
    {
        $liquidation = Liquidation::where([
            ['iduser', '=', Auth::id()],
            ['status', '=', 0],
            ['type', '=', 0]
        ])->first();
        $result = false;
        if ($liquidation != null) {
            $fechaActual = Carbon::now();
            $fechaCodeCorreo = new Carbon($liquidation->fecha_code);
            if ($fechaCodeCorreo->diffInMinutes($fechaActual) >= 30) {
                $this->reversarLiquidacion($liquidation->id, 'Tiempo limite de codigo sobrepasado');
                $result = true;
            }
        }
        return $result;
    }

    public function aprobarRetiro(Request $request)
    {
        $idLiquidation = $this->sendCodeEmail();
        return response()->json($idLiquidation);
        //return view('business.componentes.modalAprobar', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = auth()->user();

            //vista licencias
            $licencias  = WalletComission::where([['user_id', $user->id], ['type', 1]])->get();
            $licenciasTotal = $licencias->sum('amount_available');
            $licenciasAvailable = $licencias->where('status', 0)->sum('amount_available');

            //vista general
            $general =  WalletComission::where('user_id', $user->id)->get();
            $generalTotal = $general->sum('amount_available');
            $generalAvailable =  $general->where('status', 0)->sum('amount_available');

            $balancEdition = Liquidation::where('user_id', $user->id)->get();



            //vista mlm

            $mlm =  WalletComission::where([['user_id', $user->id], ['type', 0]])->get();
            $mlmTotal = $mlm->sum('amount_available');
            $mlmAvailable =  $mlm->where('status', 0)->sum('amount_available');

            $daysRemaining = 0;
            if ($user->investment) {
                $date1 = Carbon::parse($user->investment->expiration_date);
                $daysRemaining = $date1->diffInDays(today()->format('Y-m-d'));
            }

            return view('wallet.index', compact(
                'balancEdition',
                'licencias',
                'licenciasTotal',
                'licenciasAvailable',
                'general',
                'generalTotal',
                'generalAvailable',
                'mlm',
                'mlmTotal',
                'mlmAvailable',
                'daysRemaining'
            ));
        } catch (\Throwable $th) {
            Log::error('Wallet - Index -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function montoBono(Request $request)
    {
        $wallets = Wallet::where('type', $request->bono)->where('user_id', $request->user_id)->orderBy('id', 'desc')->sum('amount_fondo');
        return response()->json($wallets);
    }

    public function indexAdmin()
    {
        try {
            $user = auth()->user();
            $wallets = Wallet::where('type', '!=', '5')->orderBy('id', 'desc')->get();

            /* $comisiones = Wallet::where([
                ['user_id', '=', $user->id],
                ['status', '=', 0],
                ['liquidado', '=', 0],
                ['tipo_transaction', '=', 0],
                ['type', '!=', 5]
            ])->get();*/

            $saldoDisponible = $wallets->sum('amount_fondo');

            return view('wallet.ComponentsAdmin.wallet', compact('wallets', 'saldoDisponible'));
        } catch (\Throwable $th) {
            Log::error('Wallet - Index -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function getCode()
    {
        $code = Str::random(10);
        $user = Auth::user();
        $code_encrypted = Crypt::encryptString($code);
        $user->update(['code_security' => $code_encrypted]);

        CodeSeccurity::updateOrCreate(
            ['user_id' =>  $user->id],
            ['encrypted' => Crypt::encryptString("{$user->id}-{$code}")]
        );

        Mail::to(Auth::user()->email)->send(new CodeRetiro($code));

        $response = ['status' => 'success'];

        return response()->json($response, 200);
    }

    public function verificarRetiro(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $code = $request->code;

        // Validamos si el código de seguridad ingresado coincide con el guardado en la tabla del usuario
        if ($request->code !== $user->decryptSeccurityCode()) {
            $response = ['status' => 'error', 'message' => 'El código de seguridad ingresado no coincide'];
            return response()->json($response, 200);
        }

        // Validamos si id del usuario y el código ingresado coincide con el guardado en la tabla de respaldo
        if ($this->validateSeccurityCode($user, $code)) {
            $response = ['status' => 'error', 'message' => 'El código de seguridad ingresado no coincide'];
            return response()->json($response, 200);
        }

        if ($this->validateUserWallet($user)) {
            $response = ['status' => 'error', 'message' => 'Existe una inconsistencia con su wallet, por favor cambiela para poder realizar retiros'];
            return response()->json($response, 200);
        }

        $Monto_a_retirar = $request->Monto_a_retirar;

        $saldo = WalletComission::where([['user_id', $user->id], ['status', '0']])->get();
        $tipo = 0;

        $saldo_total = $saldo->sum('amount_available');
        $wallet = $user->wallet->address;
        $fee = WithdrawalSetting::value('percentage');

        // Se verifica si el monto a retirar es mayor al saldo disponible
        if ($Monto_a_retirar > $saldo_total) {
            $response = ['status' => 'error', 'message' => 'El monto a retirar supera su saldo disponible'];
            return response()->json($response, 200);
        }

        $feed = ($Monto_a_retirar * $fee) / 100;
        $data_liquidation = [
            'user_id' => $user->id,
            'amount_gross' => $Monto_a_retirar,
            'amount_net' => $Monto_a_retirar - $feed,
            'amount_fee' => $feed,
            'wallet_used' => $wallet,
            'type' => $tipo
        ];

        $liquidacion = Liquidation::create($data_liquidation);

        // Código para los retiros parciales
        for ($i = 0; $i < $saldo->count(); $i++) {
            if ($saldo[$i]['amount_available'] <= $Monto_a_retirar) {

                $Monto_a_retirar =  $Monto_a_retirar - $saldo[$i]['amount_available'];
                $saldo[$i]['status'] = 1;
                $saldo[$i]['amount_retired'] = $saldo[$i]['amount'];
                //creando la transaccion
                $data_transaction = [
                    'liquidation_id' => $liquidacion['id'],
                    'wallets_user_id' => $saldo[$i]['user_id'],
                    'wallets_commissions_id' => $saldo[$i]['id'],
                    'amount' => $saldo[$i]['amount'],
                    'amount_retired' => $saldo[$i]['amount_available'],
                    'amount_available' => 0,
                ];

                $saldo[$i]['amount_available'] = 0;
                $saldo[$i]->update();
                Transactions::create($data_transaction);
            } else {
                if ($Monto_a_retirar > 0) {
                    $saldo[$i]['amount_available'] =  $saldo[$i]['amount_available'] - $Monto_a_retirar;
                    $saldo[$i]['amount_retired'] = $Monto_a_retirar;
                    $saldo[$i]->update();


                    $data_transaction = [
                        'liquidation_id' => $liquidacion['id'],
                        'wallets_user_id' => $saldo[$i]['user_id'],
                        'wallets_commissions_id' => $saldo[$i]['id'],
                        'amount' => $saldo[$i]['amount'],
                        'amount_retired' => $saldo[$i]['amount_retired'],
                        'amount_available' => $saldo[$i]['amount_available'],
                    ];
                    Transactions::create($data_transaction);
                    $i = $saldo->count();
                }
            }
        }

        $user->update(['code_security' => null]);
        $admin = User::findOrFail(1);
        Mail::to($user->email)->send(new withdrawRequest($user, $Monto_a_retirar));
        Mail::to($admin->email)->send(new WithdrawAdmin($user, $Monto_a_retirar));

        $response = ['status' => 'success', 'message' => 'Su retiro se ha procesado exitosamente!'];
        return response()->json($response, 200);
    }
    /**
     * Se compara si el id del usuario en sesión es igual al que se guardo al crear la wallet
     * Y si el código ingresado es igual al registrado en la tabla de seguridad.
     */
    private function validateSeccurityCode(User $user, $code)
    {
        try {
            $code_array = explode('-', Crypt::decryptString($user->codeSeccurity->encrypted));
            if (intval($code_array[0]) != $user->id || $code_array[1] != $code) {
                return true;
            }

            return false;
        } catch (\Throwable $th) {
            Log::alert("Error al desencriptar el codigo de seguridad del usaurio: {$user->email} ");
            return true;
        }
    }
    /**
     *   Compara si la wallet del usuario coincide con la de la tabla de seguridad.
     */
    private function validateUserWallet(User $user)
    {
        try {
            $wallet_array = explode('-', Crypt::decryptString($user->walletSeccurity->encrypted));

            if (intval($wallet_array[0]) != $user->id || $wallet_array[1] != $user->decryptWallet()) {
                return true;
            }

            return false;
        } catch (\Throwable $th) {
            Log::alert("Error al desencriptar la wallet del usuario: {$user->email} ");
            return true;
        }
    }

    public function configurar_retiro()
    {
        $WithdrawalSetting = WithdrawalSetting::first();
        $weekMap = Carbon::getDays();
        //return $weekMap[7];
        $dayOfTheWeek = Carbon::now()->dayOfWeek;
        $transferencias_entre_users = $WithdrawalSetting['transferencias_entre_users'];

        return view('business.Config.configurar_retiro', compact('WithdrawalSetting', 'transferencias_entre_users'));
    }

    public function guardar_configuracion(Request $request)
    {
        $day_start = $request->desde;
        $day_end = $request->hasta;
        $time_start = ($request->hora_inicial);
        $time_end = ($request->hora_final);
        $percentage = intval($request->fee_valor);
        // $transferencias_entre_users = $request->transferencias_entre_users;
        $WithdrawalSetting = WithdrawalSetting::first();

        //return $request;

        $WithdrawalSetting['day_start'] = $day_start;
        $WithdrawalSetting['day_end'] = $day_end;
        $WithdrawalSetting['time_start'] = $time_start;
        $WithdrawalSetting['time_end'] = $time_end;
        $WithdrawalSetting['percentage'] = $percentage;
        // $WithdrawalSetting['transferencias_entre_users'] = $transferencias_entre_users;
        if ($day_start == 'sinvalor' || $day_end == 'sinvalor') {
            $data_config = 2;
            return response()->json(['value' =>   $data_config]);
        } else {
            $WithdrawalSetting->update();
            $data_config = 1;
            return response()->json(['value' =>   $data_config]);
        }
    }

    public function transferencia()
    {
        $retiros = Liquidation::where('status', 10)->get();
        return view('business.Trasferencia.transferencia', compact('retiros'));
    }
    public function userTransfer()
    {
        $config = WithdrawalSetting::first();
        $transferencia_entre_user = $config['transferencias_entre_users'];

        $date = now('America/Caracas');
        $date->subHour(1);

        $time_start = Carbon::createFromFormat('H:i:s', $config->time_start)->toTimeString();
        $time_end = Carbon::createFromFormat('H:i:s', $config->time_end)->toTimeString();


        $user = auth()->user();
        $wallets = WalletComission::where([
            ['user_id', $user->id],
            ['status', 0],
            ['type', 0]
        ])->get();
        $availableBalanceWallet = $wallets->sum('amount_available');
        $avaibleBalanceTotal = $availableBalanceWallet;
        //$fee = ($config->percentage * $availableBalance)/100;
        $fee = $config->percentage;
        return view(
            'business.Trasferencia.Transferir',
            compact('availableBalanceWallet', 'avaibleBalanceTotal', 'fee', 'transferencia_entre_user')
        );
    }

    public function email_trasnfer(Request $request)
    {
        $email = $request->email;
        $transferi_a = User::where('email', $email)->first('email');
        $data = 'sin_resultados';
        if (!empty($transferi_a) && isset($transferi_a)) {
            $transferi_a = $transferi_a['email'];
            $data = $transferi_a;
            return response()->json(['value' => $data]);
        } else {

            return response()->json(['value' =>   $data]);
        }
    }

    function Transferencia_verificada(Request $request)
    {
        $id = Auth::id();

        $data = 0;
        $code = $request->code;
        $Monto_a_retirar = $request->Monto_a_retirar;

        $saldo = WalletComission::where([
            ['user_id', $id],
            ['status', '0'],
            ['type', 0]
        ])->get();

        $saldo_total = $saldo->sum('amount_available');
        $code_security = $user = Auth::user()->code_security;

        $email = $request->email;
        $usuario_a_transferir = User::where('email', $email)->first('id');
        $usuario_a_transferir = $usuario_a_transferir['id'];

        $fee = WithdrawalSetting::get('percentage');
        $fee = $fee[0]['percentage'];

        if ($code == $code_security) {
            if ($Monto_a_retirar > $saldo_total) {
                $data = 2;
                return response()->json(['value' =>  $data]);
            } else {
                $data = 1;
                $feed = ($Monto_a_retirar *  $fee) / 100;
                $data_transaction = [
                    'user_id' => $usuario_a_transferir,
                    'amount' => $Monto_a_retirar - $feed,
                    'amount_available' => $Monto_a_retirar - $feed,
                    'level' => 1,
                    'description' => 'transferencia del usuario ' . $id . ' al usuario ' . $usuario_a_transferir
                ];
                $transferencia = WalletComission::create($data_transaction);
                $data_liquidaction = [
                    'user_id' => $id,
                    'amount_gross' => $Monto_a_retirar,
                    'amount_net' => $Monto_a_retirar - $feed,
                    'amount_fee' => $feed,
                    'wallet_used' => 'tranferencia del usuario ' . $id,
                    'status' => 10 //estatus de transferencias entre usuarios
                ];
                $liquidacion = Liquidation::create($data_liquidaction);
                for ($i = 0; $i < $saldo->count(); $i++) {
                    if ($saldo[$i]['amount_available'] <= $Monto_a_retirar) {
                        $Monto_a_retirar =  $Monto_a_retirar - $saldo[$i]['amount_available'];
                        $saldo[$i]['status'] = 1;
                        $saldo[$i]['amount_retired'] = $saldo[$i]['amount'];
                        //creando la transaccion
                        $data_transaction = [
                            'liquidation_id' => $liquidacion['id'],
                            'wallets_user_id' => $saldo[$i]['user_id'],
                            'wallets_commissions_id' => $saldo[$i]['id'],
                            'amount' => $saldo[$i]['amount'],
                            'amount_retired' => $saldo[$i]['amount_available'],
                            'amount_available' => 0,
                        ];

                        $saldo[$i]['amount_available'] = 0;
                        $saldo[$i]->update();
                        Transactions::create($data_transaction);
                    } else {
                        if ($Monto_a_retirar > 0) {
                            $saldo[$i]['amount_available'] =  $saldo[$i]['amount_available'] - $Monto_a_retirar;
                            $saldo[$i]['amount_retired'] = $Monto_a_retirar;
                            $saldo[$i]->update();


                            $data_transaction = [
                                'liquidation_id' => $liquidacion['id'],
                                'wallets_user_id' => $saldo[$i]['user_id'],
                                'wallets_commissions_id' => $saldo[$i]['id'],
                                'amount' => $saldo[$i]['amount'],
                                'amount_retired' => $saldo[$i]['amount_retired'],
                                'amount_available' => $saldo[$i]['amount_available'],
                            ];
                            Transactions::create($data_transaction);
                            $i = $saldo->count();
                        }
                    }
                }
            }
        }
        return response()->json(['value' =>  $data]);
    }

    public function verificarRetiroUtilidad(Request $request)
    {
        $id = Auth::id();
        $Monto_a_retirar = $request->Monto_a_retirar;
        $code = $request->code;
        $wallet = $request->walllet;
        $code_security = $user = Auth::user()->code_security;
        $fee = WithdrawalSetting::get('percentage');
        $fee = $fee[0]['percentage'];
        $feed = ($Monto_a_retirar *  $fee) / 100;

        //$total = $utilidad->sum('amount_available');


        $utilidades = Utility::where('status', '0')->where('user_id', $id)->get();

        $utilidad = [];
        $total = 0;
        $year_now = Carbon::now();

        foreach ($utilidades as $key => $utili) {
            if (!empty($utili)) {
                if ($utili->investment->type == '1' || $utili->investment->type == '2') {
                    array_push($utilidad, $utili);
                    $total = $total + $utili->amount_available;
                }
                if ($year_now->gt(Carbon::parse($utili->investment->created_at)->addYears(1)->format('d-m-Y'))) {
                    if ($utili->investment->type == '3') {
                        array_push($utilidad, $utili);
                        $total = $total + $utili->amount_available;
                    }
                }

                //validacion para paquetes platino se valida si el paquete esta en su 7timo mes
                // o 14ceavo mes
                $mes7 = intval(Carbon::parse($utili->investment->created_at)->addMonth(7)->format('m'));
                $Validar_mes = intval($year_now->format('m'));

                $mes14 = intval(Carbon::parse($utili->investment->created_at)->addMonth(14)->format('m'));
                if ($Validar_mes == $mes7 || $Validar_mes == $mes14) {

                    if ($utili->investment->type == '4') {
                        array_push($utilidad, $utili);
                        $total =  $total + $utili->amount_available;
                    }
                }
            }
        }

        $memberType = $utilidad[0]->investment->type;
        if ($memberType == 1 || $memberType == 2 || $memberType == 3 || $memberType == 4) {
            if ($code == $code_security) {
                if ($Monto_a_retirar <=  $total) {
                    if ($Monto_a_retirar > 50) {
                        $data_liquidaction = [
                            'user_id' => $id,
                            'amount_gross' => $Monto_a_retirar,
                            'amount_net' => $Monto_a_retirar - $feed,
                            'amount_fee' => $feed,
                            'wallet_used' => $wallet,
                            'type' => 1
                        ];
                        $liquidacion = Liquidation::create($data_liquidaction);

                        for ($i = 0; $i < count($utilidad); $i++) {
                            $data_transaction = [
                                'liquidation_id' => $liquidacion['id'],
                                'utilies_id' => $utilidad[$i]['id'],
                                'amount' => $utilidad[$i]['amount_available'],
                                'amount_retired' => $utilidad[$i]['amount_available'],
                                'amount_available' => 0,
                            ];
                            Transactions::create($data_transaction);
                            $utilidad[$i]['amount_retired'] = $utilidad[$i]['amount_retired'] + $utilidad[$i]['amount_available'];
                            $utilidad[$i]['amount_available'] = 0;
                            $utilidad[$i]->update();
                        }
                        return response()->json(['value' =>  1]);
                    }
                } else {
                    return response()->json(['value' =>  2]);
                }
            } else {
                return response()->json(['value' =>  0]);
            }
        } else {
            return response()->json(['value' =>  'no_es_paquete_oro_o_plata']);
        }

        return response()->json(['value' =>  $request]);
    }
    /*
    * Exporta a formato CSV la lista de liquidaciones (solicitudes de retiro) pendientes
    * @return CSV
    */
    public function ExportCSV()
    {
        return Excel::download(new LiquidationsExport, 'LiquidationsPending.csv');
    }
}
