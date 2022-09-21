<?php

namespace App\Http\Controllers;

use App\Models\Utility;
use App\Models\UtilityLog;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $percentage = UtilityLog::all();

       return view('utility.index', compact('percentage'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Utility  $utility
     * @return \Illuminate\Http\Response
     */
    public function show(utility $utility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Utility  $utility
     * @return \Illuminate\Http\Response
     */
    public function edit(utility $utility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Utility  $utility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);
        $percentage_type=utilityLog::where('id',$request->type_id)->first();

        $percentage_type->update(['percentage' =>$request->type_percent]);

        /*$pack=MembershipPackage::where('membership_types_id',$request->type_id)->get();

        foreach($pack as $p){
            MembershipPackage::where(['id' => $p->id])
            ->update([
                'percentage' =>$request->type_percent,
                ]);
        }*/

        return redirect()->back()->with('success', 'El porcentaje ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Utility  $utility
     * @return \Illuminate\Http\Response
     */
    public function destroy(utility $utility)
    {
        //
    }
}
