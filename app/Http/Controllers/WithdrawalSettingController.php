<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WithdrawalSetting;

class WithdrawalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = WithdrawalSetting::first();
        $days = [
            [ 'day_number' => 1, 'day_text' => 'Lunes' ],
            [ 'day_number' => 2, 'day_text' => 'Martes' ],
            [ 'day_number' => 3, 'day_text' => 'Miércoles' ],
            [ 'day_number' => 4, 'day_text' => 'Jueves' ],
            [ 'day_number' => 5, 'day_text' => 'Viernes' ],
            [ 'day_number' => 6, 'day_text' => 'Sábado' ],
            [ 'day_number' => 7, 'day_text' => 'Domingo' ],
        ];
        return view('configurations.WithdrawalSetting', compact('config', 'days'));
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
    public function update(Request $request, $id)
    {
        if ($request->type == 'days') {
            $request->validate([
                'day_start' => 'required',
                'day_end' => 'required',
                'time_start' => 'required',
                'time_end' => 'required',
            ],[
                'day_start.required' => 'El día de inicio es requerido.',
                'day_end.required' => 'El día de cierre es requerida.',
                'time_start.required' => 'La hora de inicio es requerida.',
                'time_end.required' => 'La hora de cierre es requerida.',
            ]);
            WithdrawalSetting::where('id', $id)->update([
                'day_start' => $request->day_start,
                'day_end' => $request->day_end,
                'time_start' => $request->time_start,
                'time_end' => $request->time_end
            ]);
            return redirect()->back()->with('success', 'The configuration of days and hours of withdrawal have been updated.');
        } else if ($request->type == 'percentaje'){
            $request->validate([
                'percentage' => 'required',
            ],[
                'percentage.required' => 'El porcentaje es requerido.'
            ]);
            WithdrawalSetting::where('id', $id)->update([
                'percentage' => $request->percentage,
            ]);
            return redirect()->back()->with('success', 'Withdrawal percentage settings have been updated.');
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
