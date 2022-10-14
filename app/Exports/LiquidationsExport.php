<?php

namespace App\Exports;

use App\Models\Liquidation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LiquidationsExport implements FromView
{
    public function view(): View
    {
        $liquidations = Liquidation::whereStatus(0)->with('user')->get();
        return view('exports.PendingLiquidations', compact('liquidations'));
    }
}
