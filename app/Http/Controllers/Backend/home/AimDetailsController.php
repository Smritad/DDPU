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
use App\Models\User;
use App\Models\Permission;
use App\Models\UsersPermission;
use App\Models\AimDetail;


class AimDetailsController extends Controller
{

    
public function index()
{
    $aims = AimDetail::all();
    return view('backend.home-page.aim-details.index', compact('aims'));
}

    public function create(Request $request)
    { 
        return view('backend.home-page.aim-details.create');
    }



public function store(Request $request)
{
    // Validate
    $request->validate([
        'aim_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'heading.*' => 'required|string',
        'description.*' => 'required|string',
        'icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
    ]);

    // Handle main aim image
    $aimImageName = null;
    if ($request->hasFile('aim_image')) {
        $file = $request->file('aim_image');
        $aimImageName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('aim-images'), $aimImageName);
        // Store only file name
        $aimImageName = $aimImageName;
    }

    // Handle table rows
    $details = [];
    $headings = $request->heading;
    $descriptions = $request->description;
    $icons = $request->file('icon');

    foreach ($headings as $index => $heading) {
        $iconFileName = null;

        if (isset($icons[$index]) && $icons[$index] != null) {
            $iconFile = $icons[$index];
            $iconFileName = time().'_'.$index.'_'.$iconFile->getClientOriginalName();
            $iconFile->move(public_path('aim-icons'), $iconFileName);

            // Store only file name, NOT path
            $iconFileName = $iconFileName;
        }

        $details[] = [
            'heading' => $heading,
            'description' => $descriptions[$index],
            'icon' => $iconFileName, // just file name
        ];
    }

    // Save to DB
    \App\Models\AimDetail::create([
        'aim_image' => $aimImageName,
        'details' => $details,
    ]);

    return redirect()->route('aim-details.index')->with('message', 'Aim added successfully!');
}




    public function edit($id)
{
    $aim = \App\Models\AimDetail::findOrFail($id);

    return view('backend.home-page.aim-details.edit', compact('aim'));
}

public function update(Request $request, $id)
{
    $aim = \App\Models\AimDetail::findOrFail($id);

    // Validate
    $request->validate([
        'aim_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'heading.*' => 'required|string',
        'description.*' => 'required|string',
        'icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
    ]);

    // Handle main aim image
    if ($request->hasFile('aim_image')) {
        $file = $request->file('aim_image');
        $aimImageName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('aim-images'), $aimImageName);
        $aim->aim_image = $aimImageName;
    }

    // Handle table rows
    $details = [];
    $headings = $request->heading;
    $descriptions = $request->description;
    $icons = $request->file('icon');

    foreach ($headings as $index => $heading) {
        $iconFileName = null;

        // Check if new icon uploaded
        if (isset($icons[$index]) && $icons[$index] != null) {
            $iconFile = $icons[$index];
            $iconFileName = time().'_'.$index.'_'.$iconFile->getClientOriginalName();
            $iconFile->move(public_path('aim-icons'), $iconFileName);
        } else {
            // Keep existing icon if available
            $existingDetails = $aim->details[$index] ?? null;
            $iconFileName = $existingDetails['icon'] ?? null;
        }

        $details[] = [
            'heading' => $heading,
            'description' => $descriptions[$index],
            'icon' => $iconFileName,
        ];
    }

    $aim->details = $details;
    $aim->save();

    return redirect()->route('aim-details.index')->with('message', 'Aim updated successfully!');
}



public function destroy($id)
{
    $aim = AimDetail::findOrFail($id);

    try {
        $aim->deleted_by = Auth::id();
        $aim->save();          // Save deleted_by
        $aim->delete();        // Soft delete (sets deleted_at)
        
        return redirect()->route('aim-details.index')->with('message', 'Aim details deleted successfully!');
    } catch (\Exception $ex) {
        return redirect()->back()->with('error', 'Something went wrong - ' . $ex->getMessage());
    }
}


}