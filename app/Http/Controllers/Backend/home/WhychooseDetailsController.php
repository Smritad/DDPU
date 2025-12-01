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
use App\Models\WhyChooseDetail;

class WhychooseDetailsController extends Controller
{

public function index()
{
    // Fetch all WhyChoose details (not deleted)
    $whychooses = \App\Models\WhyChooseDetail::whereNull('deleted_at')->get();

    // Pass the data to the view
    return view('backend.home-page.whychoose-details.index', compact('whychooses'));
}

public function create()
{ 
    return view('backend.home-page.whychoose-details.create');
}



public function store(Request $request)
{
    // Validate
    $request->validate([
        'main_heading' => 'required|string|max:255',
        'title.*' => 'required|string|max:255',
        'icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
    ]);

    $details = [];
    $titles = $request->title;
    $icons = $request->file('icon');

    foreach ($titles as $index => $title) {
        $iconFileName = null;

        if (isset($icons[$index]) && $icons[$index] != null) {
            $iconFile = $icons[$index];
            $iconFileName = time().'_'.$index.'_'.$iconFile->getClientOriginalName();
            $iconFile->move(public_path('whychoose-icons'), $iconFileName);
        }

        $details[] = [
            'title' => $title,
            'icon'  => $iconFileName, // store file name only
        ];
    }

    // Save to DB with created_by
    \App\Models\WhyChooseDetail::create([
        'main_heading' => $request->main_heading,
        'details'      => $details,
        'created_by'   => auth()->id(), // currently logged in user
    ]);

    return redirect()->route('whychoose-details.index')->with('message', 'WhyChoose details added successfully!');
}



public function edit($id)
{
    $whychoose = \App\Models\WhyChooseDetail::findOrFail($id);
    return view('backend.home-page.whychoose-details.edit', compact('whychoose'));
}

public function update(Request $request, $id)
{
    $whychoose = \App\Models\WhyChooseDetail::findOrFail($id);

    $request->validate([
        'main_heading' => 'required|string|max:255',
        'title.*' => 'required|string|max:255',
        'icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
    ]);

    $titles = $request->title;
    $icons = $request->file('icon');
    $details = [];

    foreach ($titles as $index => $title) {
        $iconFileName = null;

        if (isset($icons[$index]) && $icons[$index] != null) {
            $iconFile = $icons[$index];
            $iconFileName = time().'_'.$index.'_'.$iconFile->getClientOriginalName();
            $iconFile->move(public_path('whychoose-icons'), $iconFileName);
        } else {
            // Keep existing icon if available
            $existing = $whychoose->details[$index] ?? null;
            $iconFileName = $existing['icon'] ?? null;
        }

        $details[] = [
            'title' => $title,
            'icon'  => $iconFileName,
        ];
    }

    $whychoose->update([
        'main_heading' => $request->main_heading,
        'details'      => $details,
        'updated_by'   => auth()->id(),
    ]);

    return redirect()->route('whychoose-details.index')->with('message', 'WhyChoose details updated successfully!');
}




public function destroy($id)
{
    $whychoose = \App\Models\WhyChooseDetail::findOrFail($id);

    $whychoose->update([
        'deleted_by' => auth()->id(),
        'deleted_at' => now(),
    ]);

    return redirect()->route('whychoose-details.index')->with('message', 'WhyChoose detail deleted successfully!');
}


}