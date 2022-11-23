<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicensePackage extends Model
{
    use HasFactory;

    protected $table = 'licenses_packages';
    protected $fillable = [
        'name',
        'amount',
        'description',
        'commissions',
        'leadership_points',
        'binary_points',
        'level',
        'deposit_min',
        'deposit_max',
        'image',
        'dark_image',
        'emblem'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'package_id');
    }
    public function investments()
    {
        return $this->hasMany(Investment::class, 'package_id');
    }
    public function upgrade()
    {
        return $this->hasOne(Upgrade::class, 'package_id');
    }

}
