<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use App\Models\Memberships;
use App\Models\MembershipBankDetails;
use App\Models\MembershipPersonalDetails;
use App\Models\MembershipTypes;
use App\Models\MembershipWorkplaceDetails;
use App\Models\MembershipProfessionalDetails;

class MembershipDetailsController extends Controller
{
    public function index()
{
    $memberships = DB::table('memberships')
        ->leftJoin('membership_types', 'membership_types.membership_id', '=', 'memberships.id')
        ->leftJoin('membership_personal_details', 'membership_personal_details.membership_id', '=', 'memberships.id')
        ->leftJoin('membership_professional_details', 'membership_professional_details.membership_id', '=', 'memberships.id')
        ->leftJoin('membership_workplace_details', 'membership_workplace_details.membership_id', '=', 'memberships.id')
        ->leftJoin('membership_bank_details', 'membership_bank_details.membership_id', '=', 'memberships.id')
        ->select(
            'memberships.id',
            'memberships.unique_code',
            'memberships.status',
            'membership_types.grade',
            'membership_types.payment_type',
            'membership_personal_details.first_name',
            'membership_personal_details.last_name',
            'membership_personal_details.primary_email',
            'membership_personal_details.phone_number',
            'membership_professional_details.employer_name',
            'membership_bank_details.annual_amount'
        )
        ->orderByDesc('memberships.id')
        ->get();

    return view('backend.Membership.membership-details', compact('memberships'));
}
public function show($id)
{
    $member = DB::table('memberships as m')
        ->leftJoin('membership_types as t', 't.membership_id', '=', 'm.id')
        ->leftJoin('membership_personal_details as p', 'p.membership_id', '=', 'm.id')
        ->leftJoin('membership_professional_details as pr', 'pr.membership_id', '=', 'm.id')
        ->leftJoin('membership_workplace_details as w', 'w.membership_id', '=', 'm.id')
        ->leftJoin('membership_bank_details as b', 'b.membership_id', '=', 'm.id')
        ->select(
            'm.*',
            't.grade', 't.payment_type',
            'p.title', 'p.first_name', 'p.middle_name', 'p.last_name', 'p.gender', 'p.birth_date',
            'p.primary_email', 'p.backup_email', 'p.phone_number', 'p.alt_phone_number',
            'p.street_address', 'p.street_address2', 'p.street_address3', 'p.city', 'p.postal_code',
            'p.receive_benefit_emails', 'p.join_reason',
            'pr.gmc_gdc_number', 'pr.specialty', 'pr.qualifications',
            'pr.lnc_member', 'pr.lnc_chair', 'pr.employer_name', 'pr.employer_other',
            'w.hospital_name', 'w.workplace_other',
            'b.is_account_holder', 'b.is_sole_authoriser', 'b.bank_name',
            'b.account_holder_name', 'b.sort_code', 'b.account_number', 'b.annual_amount'
        )
        ->where('m.id', $id)
        ->first();

    if (!$member) {
        abort(404);
    }

    return view('backend.Membership.membership-view', compact('member'));
}

}
