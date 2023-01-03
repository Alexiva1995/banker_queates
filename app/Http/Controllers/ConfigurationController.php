<?php

namespace App\Http\Controllers;
use App\Models\WalletAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ConfigurationController extends Controller
{
    public function index()
    {
      
        $wallet = WalletAdmin::where('user_id', Auth::user()->id)->get();
        $data = count($wallet) > 0 ? $wallet[0] : [];
        return view('configurations.payment_methods', compact('data'));
    }

    public function store(Request $request)
    {
        $wallet = WalletAdmin::find(Auth::user()->id);
        $request->validate([
            'wallet' => 'required',
            'image' => 'required'
        ]);

        if ($wallet) {
            $wallet->wallet = Crypt::encryptString($request->wallet);
            $wallet->image = $request->image;
            $wallet->save();
        } else {
            $wallet = WalletAdmin::create([
                'user_id' => Auth::user()->id,
                'wallet' => Crypt::encryptString($request->wallet),
            ]);
        }
        //Guardamos foto
        $image = $request->file('image');
        $name = time() . "." . $image->extension();
        $image->move(public_path('storage') . '/wallet-admin/', $name);
        $wallet->image = '' . $name;

        $wallet->save();
        return redirect()->back()->with('success', 'The wallet was saved successfully');
    }


}
