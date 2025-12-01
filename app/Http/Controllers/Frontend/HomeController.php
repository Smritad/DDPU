<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BannerDetails;
use App\Models\AimDetail;
use App\Models\WhyChooseDetail;
use App\Models\TestimonialsDetail;
use App\Models\JoinMembershipDetail;


class HomeController extends Controller
{

  public function home()
{
    $banners = BannerDetails::whereNull('deleted_at')->get();
    $aim = AimDetail::whereNull('deleted_at')->first();

    $whychoose = WhyChooseDetail::whereNull('deleted_at')->first();
    $testimonials = TestimonialsDetail::whereNull('deleted_at')->first();
    $joinmembership = JoinMembershipDetail::whereNull('deleted_at')->first();

    return view('frontend.home', compact('banners', 'aim', 'whychoose', 'testimonials', 'joinmembership'));
}


}