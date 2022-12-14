<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualBonusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'author_id',
        'amount',
        'action'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

}
