<?php

namespace App\Http\Controllers;

use App\Models\KYC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudKYC = KYC::where([['user_id', Auth::id()],
                                    ['status','<=','1']])->get()->last();
        $solicitudKycRechazada = KYC::where([['user_id', Auth::id()],
                                    ['status','2']])->get()->last();
        return view('Kyc.KYCindex.index', compact('solicitudKYC','solicitudKycRechazada'));
    }

    public function indexAdmin()
    {
        $KYC = KYC::where('status','0')->get();
        return view('Kyc.KYCindex.admin.indexAdmin', compact('KYC'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if($request['TipoDocumento'] != null ){
            if ($request->hasFile('frontal') && $request->hasFile('trasera')) {

                //parte frontal del documento
                $frontal = $request->file('frontal');
                $nombre_frontal = Auth::id().'.'.time().'.frontal.'.$frontal->getClientOriginalExtension();
                $frontal->move(public_path('storage') . '/KYC/frontal/'.Auth::id().'/'.'.', $nombre_frontal);

                //parte trasera del documento
                $trasera = $request->file('trasera');
                $nombre_trasera = Auth::id().'.'.time().'trasera'.'.'.'.trasera.'.$trasera->getClientOriginalExtension();
                $trasera->move(public_path('storage') . '/KYC/trasera/'.Auth::id().'/'.'.', $nombre_trasera);

                $data =[
                    'user_id'=> Auth::id(),
                    'type_kyc'=> $request['TipoDocumento'],
                    'photo_Forward'=> $nombre_frontal,
                    'photo_rear'=> $nombre_trasera,
                ];
                $solicitudKycRechazada = KYC::where([['user_id', Auth::id()],
                                    ['status','2']])->get()->last();
                if(!empty($solicitudKycRechazada)){
                    $solicitudKycRechazada->delete();
                }
                KYC::create($data);
                return redirect()->back()->with('msj-info', 'Successful KYC Verification Request');
            }
            else{
                return redirect()->back()->with('msj-danger', 'Front and back of documents are required');
            }
        }else{
            return redirect()->back()->with('msj-danger', 'Please select the type of document');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(isset($request->cancelar)){
            $id = $request->cancelar;
            $solicitudKy = KYC::where([['user_id', $id],
                                       ['status','0']])->get()->last()->update(['status'=>'2']);

            return redirect()->back()->with('msj-info', 'KYC rechazado ');
        }
        if(isset($request->aprovar)){
            $id = $request->aprovar;
            $solicitudKy = KYC::where([['user_id', $id],
                                       ['status','0']])->get()->last()->update(['status'=>'1']);

            return redirect()->back()->with('msj-success', 'KYC aprovado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
