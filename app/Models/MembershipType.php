<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function MembershipPackage()
    {
        return $this->hasMany(MembershipPackage::class, 'membership_types_id');
    }

}
