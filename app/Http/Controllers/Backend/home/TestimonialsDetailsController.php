<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\TestimonialsDetail ;

class TestimonialsDetailsController extends Controller
{

public function index()
{
    $testimonials = TestimonialsDetail::whereNull('deleted_at')->get(); // fetch non-deleted
    return view('backend.home-page.testimonials-details.index', compact('testimonials'));
}

public function create()
{ 
    return view('backend.home-page.testimonials-details.create');
}



public function store(Request $request)
{
    $request->validate([
        'main_heading' => 'required|string|max:255',
        'description.*' => 'required|string',
        'name.*' => 'required|string|max:255',
        'designation.*' => 'required|string|max:255',
    ]);

    $testimonials = [];
    foreach ($request->description as $index => $desc) {
        $testimonials[] = [
            'description' => $desc,
            'name' => $request->name[$index],
            'designation' => $request->designation[$index],
        ];
    }

    \App\Models\TestimonialsDetail::create([
        'main_heading' => $request->main_heading,
        'testimonials' => $testimonials, // store as JSON
        'created_by' => auth()->id(),
    ]);

    return redirect()->route('testimonials-details.index')->with('message', 'Testimonials added successfully!');
}




public function edit($id)
{
    $testimonials = \App\Models\TestimonialsDetail::findOrFail($id);
    return view('backend.home-page.testimonials-details.edit', compact('testimonials'));
}

public function update(Request $request, $id)
{
    $testimonialsDetail = \App\Models\TestimonialsDetail::findOrFail($id);

    // Validate
    $request->validate([
        'main_heading' => 'required|string|max:255',
        'description.*' => 'required|string',
        'name.*' => 'required|string|max:255',
        'designation.*' => 'required|string|max:255',
    ]);

    $testimonialsData = [];
    foreach ($request->description as $index => $desc) {
        $testimonialsData[] = [
            'description' => $desc,
            'name' => $request->name[$index],
            'designation' => $request->designation[$index],
        ];
    }

    $testimonialsDetail->update([
        'main_heading' => $request->main_heading,
        'testimonials' => $testimonialsData,
        'updated_by' => auth()->id(),
    ]);

    return redirect()->route('testimonials-details.index')->with('message', 'Testimonials updated successfully!');
}





public function destroy($id)
{
    $testimonial = TestimonialsDetail::findOrFail($id);

    $testimonial->update([
        'deleted_by' => auth()->id(),
        'deleted_at' => now(),
    ]);

    return redirect()->route('testimonials-details.index')->with('message', 'Testimonials detail deleted successfully!');
}


}