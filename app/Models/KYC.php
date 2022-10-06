<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KYC extends Model
{
    protected $table = 'kycs';

    protected $fillable = [
        'user_id',
        'type_kyc',
        'photo_Forward',
        'photo_rear',
        'status'
    ];


    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
