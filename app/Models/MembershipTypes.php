<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipTypes extends Model
{
    protected $fillable = ['unique_code', 'status'];

    public function type() {
        return $this->hasOne(MembershipTypes::class, 'membership_id');
    }

    public function personal() {
        return $this->hasOne(MembershipPersonalDetails::class, 'membership_id');
    }

    public function professional() {
        return $this->hasOne(MembershipProfessionalDetails::class, 'membership_id');
    }

    public function workplace() {
        return $this->hasOne(MembershipWorkplaceDetails::class, 'membership_id');
    }

    public function bank() {
        return $this->hasOne(MembershipBankDetails::class, 'membership_id');
    }
}
