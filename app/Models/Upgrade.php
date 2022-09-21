<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{
    use HasFactory;
    protected $fillable = [
        'investment_id', 'package_id', 'status_utility'
    ];
    public function investment()
    {
        return $this->belongsTo(Investment::class, 'investment_id');
    }
    public function membershipPackage()
    {
        return $this->belongsTo(MembershipPackage::class, 'package_id');
    }
}
