<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\MembershipPackage;
use App\Models\MembershipType;
use App\Models\Inversion;
use App\Models\OrdenPurchase;
use App\Http\Controllers\InversionController;

use Illuminate\Support\Facades\Auth;

class SubAdminController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];
        $user = Auth::user();
        $member = Member::where('user_id', '=', $user->id)->first();
        $data = MembershipType::with('MembershipPackage')->get();
       
        return view('/subadmin/paquetes', ['pageConfigs' => $pageConfigs], compact('user','data'));
    }

    // public function solicitudes(Request $request)
    // {
    //     $user = Auth::user();
    //     $title = $request->title;
    //     $membershipType = MembershipPackage::where(['membership_types_id' => $request->package])->get();
    //     $package = MembershipPackage::where('id', $request->package)->first();
    //     $ordenes = OrdenPurchase::where('membership_packages_id',  $request->package)->get();

    //     // return view('/subadmin/solicitudes',compact('membershipType','package','title', 'ordenes'));
    // }

    public function solicitudes(Request $request)
    {
        $user = Auth::user();
        $title = $request->title;
        $membershipType = MembershipPackage::where(['membership_types_id' => $request->package])->get();
        $package = MembershipPackage::where('id', $request->package)->first();
        $ordenes = OrdenPurchase::where('membership_packages_id',  $request->package)->get();   

        return view('/subadmin/solicitudes', compact('membershipType','package','title', 'ordenes'));
        // return redirect()->route('subadmin.solicitudes', compact('membershipType','package','title', 'ordenes'));
        // ->with('title', $title)->with('package', $package)->with('ordenes', $ordenes);
    }

    public function showSolicitud(Request $request)
    {
        $user = Auth::user();
        $orden=OrdenPurchase::find($request->id);
        $user_data=User::where('id', $orden->user_id);

        return view('/subadmin/show-solicitud', compact('orden','user_data'));
    }
}
