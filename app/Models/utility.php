<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'status', 'utility_log','investment_id', 'accumulated_percentage','amount_available','amount_retired', 'last_utility'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function investment() {
        return $this->belongsTo(Investment::class);
    }
}
