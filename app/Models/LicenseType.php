<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    use HasFactory;

    protected $table = 'licenses_types';
    protected $fillable = ['name'];

    public function licensePackages()
    {
        return $this->hasMany(LicensePackage::class, 'license_type_id');
    }

}
