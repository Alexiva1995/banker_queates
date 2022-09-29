<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicensePackage extends Model
{
    use HasFactory;
    
    protected $table = 'licenses_packages';
    protected $fillable = [
        'amount',
        'rentability',
        'license_type_id',
        'image',
        'dark_image'
    ];

    public function licenseType()
    {
        return $this->belongsTo(LicenseType::class, 'license_type_id');
    }
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
