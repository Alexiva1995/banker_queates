<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLiquidation extends Model
{
    use HasFactory;
    protected $fillable = ['liquidation_id', 'email'];

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }
}
