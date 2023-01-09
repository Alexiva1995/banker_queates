<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whizfx extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id', 'customer_id','balance', 'kyc_percentage'
    ];
    protected $table = 'whizfx';

    public function user()
    {
        return $this->hasOne(User::class, 'whizfx_id');
    }
}
