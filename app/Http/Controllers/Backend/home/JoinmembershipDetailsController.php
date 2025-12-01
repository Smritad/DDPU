<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\JoinMembershipDetail;

class JoinmembershipDetailsController extends Controller
{
    public function index()
{
    $memberships = JoinMembershipDetail::whereNull('deleted_at')->get();
    return view('backend.home-page.joinmembership-details.index', compact('memberships'));
}


    public function create()
    {
        return view('backend.home-page.joinmembership-details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        JoinMembershipDetail::create([
            'heading' => $request->heading,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('joinmembership-details.index')->with('message', 'Join Membership added successfully!');
    }

    public function edit($id)
{
    $membership = JoinMembershipDetail::findOrFail($id);
    return view('backend.home-page.joinmembership-details.edit', compact('membership'));
}


    public function update(Request $request, $id)
    {
        $membership = JoinMembershipDetail::findOrFail($id);

        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $membership->update([
            'heading' => $request->heading,
            'description' => $request->description,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('joinmembership-details.index')->with('message', 'Join Membership updated successfully!');
    }

    public function destroy($id)
    {
        $membership = JoinMembershipDetail::findOrFail($id);
        $membership->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => Carbon::now(),
        ]);

        return redirect()->route('joinmembership-details.index')->with('message', 'Join Membership deleted successfully!');
    }
}
