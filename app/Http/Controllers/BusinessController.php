<?php

namespace App\Http\Controllers;

use App\Models\Formulary;
use App\Models\Inversion;
use App\Models\Log_rentabilidad;
use App\Models\Member;
use App\Models\MembershipType;
use App\Models\Rentabilidad;
use App\Models\WalletComission;
use App\Models\Whizfx;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Collection;
use stdClass;


class BusinessController extends Controller{
    // Inversiones
    public function inversiones(){   
        $user = auth()->user();
        // $indicesCreation = null;
        // $formularyIndices = null;
        // $indicesInves = null;
        $cryptoCreation = null; 
        $forexCreation = null;
        $formularyForex = null;
        $formularyCrypto = null;
        $forexInves = null;
        $cryptoInves = null;
        if($user->admin == 1){
            $inversiones = Inversion::orderBy('id', 'desc')->get();
        }else {
            $memberShips = Member::where([['referred_id', Auth::id()], ["status", "activo"]])->with("ordenes")->get();
            
            foreach ($memberShips as $memberShip) {
                switch ($memberShip->ordenes->type) {    
                    case ('irv_forex'):
                        $forexInves = $memberShip;
                        $forexCreation = $memberShip->created_at->format('Y-m-d');
                        $formularyForex = $memberShip->formulary->sortByDesc('id')->first();
                    break; 
                    case ("cryptos"):
                        $cryptoInves = $memberShip;   
                        $cryptoCreation = $memberShip->created_at->format('Y-m-d');
                        $formularyCrypto = $memberShip->formulary->sortByDesc('id')->first(); 
                    break;
                    // case ("irv_indices_sinteticos"):
                    //     $indicesInves = $memberShip;                      
                    //     $indicesCreation = $memberShip->created_at->format('Y-m-d');
                    //     $formularyIndices = $memberShip->formulary->sortByDesc('id')->first();    
                    // break;
                }
            }
        }
        return view('business.invest', compact('forexInves','cryptoInves', 'formularyForex','formularyCrypto', 'memberShips', 'forexCreation', 'cryptoCreation'));
    }

    function dataChartForex() {
        $memberShip= new Member();
        $forexInves = $memberShip->getMembershipByType("irv_forex");
        return $forexInves != null ? json_encode($memberShip->getDataChart($forexInves)) : json_encode($forexInves);
    }
    function dataChartIndice() {
        $memberShip= new Member();
        $indiceInves = $memberShip->getMembershipByType("irv_indices_sinteticos");
        return $indiceInves != null ? json_encode($memberShip->getDataChart($indiceInves)) : json_encode($indiceInves);
    }
    function dataChartCrypto() {
        $memberShip= new Member();
        $cryptoInves = $memberShip->getMembershipByType("cryptos");
        return $cryptoInves != null ? json_encode($memberShip->getDataChart($cryptoInves)) : json_encode($cryptoInves);
    }
    //Rentabilidad
    public function rentabilidad()
    {
        $user = auth()->user();
     
        if($user->admin == 1){
            $rentabilidades = Log_rentabilidad::orderBy('id', 'desc')->get();
        }else{
            $rentabilidades = Log_rentabilidad::orderBy('id', 'desc')->whereHas('inversion', function($inversion)use($user){
                $inversion->where('user_id', $user->id);
            })->get();
        }

        return view('business.rentabilidad', compact('rentabilidades'));
    }
    public function pamm() {
        $user = Auth::user();
        $data = new Collection();
        if ($user->whizfx_id) {
            $url = config('services.api_whizfx.base_url');
            $url = $url . 'accounts/history';
            $response = Http::withHeaders([
                'auth' => config('services.api_whizfx.x-token'),
                ])->get("{$url}");
            $response = $response->object();
            foreach ($response->orders->data as $account) {
                if($account->account->serveraccount->serveraccount == $user->whizfx->account_id) {
                    $object = new stdClass;
                    $object->transactTime = $account->transactTime;
                    $object->symbol = $account->symbol;
                    $object->type = $account->type;
                    $object->volumen = $account->quantity / 100000;
                    $object->order = $account->side;
                    $object->trader_profit = $account->trader_profit;
                    $object->requestedPrice = $account->requestedPrice;
                    $data->push($object);
                }
            }
        }
        return view('pamm.index', compact('data', 'user'));
    }
    public function pammAdmin() {
        $usersWhizfx = Whizfx::where('lpoa_file', '!=', null)->get();
        return view('pamm.admin', compact('usersWhizfx'));
    }
    public function downloadLPOA() {
        $file = public_path()."/files/LPOA_BANKER_QUOTES.pdf";
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, 'LPOA_BANKER_QUOTES.pdf',$headers);
    }
    public function downloadLpoaAdmin(Request $request) {
        $ruta = public_path("files/LPOA/".$request->name);
        $headers = array('Content-Type: application/pdf',);
        return response()->download($ruta, $request->name,$headers);
    }
    public function changePammStatus(Request $request) {
        $whizfx = Whizfx::where('id', $request->id)->first();
        $whizfx->status = $request->status;
        $whizfx->save();
        return back()->with('success', 'Status has been updated');
    }
    public function savePamm(Request $request) {
        $request->validate([
            'pdf' => "required|mimes:pdf|max:2000",
            'account_number' => "required"
        ]);
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $nombre = "LPOA_".Auth::user()->id.".".$file->guessExtension();
            $ruta = public_path("files/LPOA/".$nombre);
            copy($file, $ruta);
            $user = Auth::user();
            $user->whizfx->update([
                'lpoa_file' => $nombre,
                'account_id' => $request->account_number
            ]);
            return back()->with('success', 'Archivo subido exitosamente');   
        }
    }
} 
