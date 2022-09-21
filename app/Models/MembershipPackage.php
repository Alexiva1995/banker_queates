<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPackage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'amount',
        'rentability',
        'membership_types_id',
        'image',
        'dark_image'
    ];

    public function membershipType()
    {
        return $this->belongsTo(MembershipType::class, 'membership_types_id');
    }

    public function investments()
    {
        return $this->hasMany(Investment::class, 'package_id');
    }
    public function order()
    {
        return $this->hasMany(Investment::class, 'package_id');
    }
    public function upgrade()
    {
        return $this->hasOne(Upgrade::class, 'package_id');
    }

}
