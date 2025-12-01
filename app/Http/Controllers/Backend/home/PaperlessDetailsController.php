<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaperlessDetailsController extends Controller
{
    // 1️⃣ Index Page
    public function index(Request $request)
    {
        $status = $request->get('status', 1); // default Unprocessed
        $query = Application::query();

        if ($status == 1) {
            $query->where('status', 'unprocessed');
        } elseif ($status == 2) {
            $query->where('status', 'processed');
        }

        $applications = $query->orderBy('signup_date', 'desc')->get();

        return view('backend.paperless.index', compact('applications', 'status'));
    }

    // 2️⃣ Show Create Form
    public function create()
    {
        return view('backend.paperless.create');
    }

   public function store(Request $request)
{
   
   
    
    $request->validate([
        'title' => 'required',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'mobile' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'account_name' => 'required|string|max:255',
        'account_number' => 'required|digits_between:6,10',
        'sort_code' => 'required|digits:6',
    ]);

    $app = new Application();
    $app->signup_date = now();
    $app->reference = 'DDPU'.str_pad(Application::max('id')+1, 6, '0', STR_PAD_LEFT);
    $app->title = $request->title;
    $app->first_name = $request->first_name;
    $app->last_name = $request->last_name;
    $app->mobile = $request->mobile;
    $app->email = $request->email;
    $app->is_company = $request->has('is_company') ? 1 : 0;
    $app->company_name = $request->company_name ?? null;
    $app->address1 = $request->address1;
    $app->address2 = $request->address2 ?? null;
    $app->town = $request->town;
    $app->postcode = $request->postcode;
    $app->account_name = $request->account_name;
    $app->account_no = $request->account_number;
    $app->sort_code = $request->sort_code;
    $app->bank = $request->bank ?? '';
    $app->status = 'unprocessed';
    $app->save();

    return redirect()->route('direct_debit.index')->with('success', 'Application added successfully');
}


public function edit($id)
{
    $application = Application::findOrFail($id);
    return view('backend.paperless.edit', compact('application'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'mobile' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'address1' => 'required|string|max:255',
        'town' => 'required|string|max:255',
        'postcode' => 'required|string|max:20',
        'account_name' => 'required|string|max:255',
        'account_number' => 'required|digits_between:6,10',
        'sort_code' => 'required|digits:6',
    ], [
        'account_number.digits_between' => 'Account number must be 6-10 digits',
        'sort_code.digits' => 'Sort code must be exactly 6 digits',
    ]);

    $app = Application::findOrFail($id);
    $app->title = $request->title;
    $app->first_name = $request->first_name;
    $app->last_name = $request->last_name;
    $app->mobile = $request->mobile;
    $app->email = $request->email;
    $app->is_company = $request->has('is_company') ? 1 : 0;
    $app->company_name = $request->company_name ?? null;
    $app->address1 = $request->address1;
    $app->address2 = $request->address2 ?? null;
    $app->town = $request->town;
    $app->postcode = $request->postcode;
    $app->account_name = $request->account_name;
    $app->account_no = $request->account_number;
    $app->sort_code = $request->sort_code;
    $app->bank = $request->bank ?? '';
    $app->save();

    return redirect()->route('direct_debit.index')->with('success', 'Application updated successfully');
}

   




public function download(Request $request)
{
    $ids = explode(',', $request->selected_ids);
    $applications = Application::whereIn('id', $ids)->get();

    return Excel::download(new class($applications) implements FromCollection, WithHeadings {
        protected $applications;

        public function __construct($applications)
        {
            $this->applications = $applications;
        }

        public function collection()
        {
            return $this->applications->map(function($app){
                return [
                    'Reference' => $app->reference,
                    'AccountSortCode' => $app->sort_code,
                    'AccountNumber' => $app->account_no,
                    'AccountName' => $app->account_name,
                    'Amount' => '', // fill if you have this field
                    'BacsCode' => '', // fill if you have this field
                    'DateSignedUp' => $app->signup_date ? $app->signup_date->format('d-m-Y') : '',
                    'Title' => $app->title,
                    'Salutation' => '', // you can add if stored
                    'FirstName' => $app->first_name,
                    'LastName' => $app->last_name,
                    'AddressLine1' => $app->address1,
                    'AddressLine2' => $app->address2,
                    'Town' => $app->town,
                    'County' => '', // add if stored
                    'PostCode' => $app->postcode,
                    'EmailAddress' => $app->email,
                    'MobilePhoneNumber' => $app->mobile,
                    'Bank' => $app->bank,
                    'Branch' => '', // add if stored
'IsCompany' => $app->is_company == 1 ? 'TRUE' : 'FALSE',
                    'CompanyName' => $app->company_name,
                ];
            });
        }

        public function headings(): array
        {
            return [
                'Reference', 'AccountSortCode', 'AccountNumber', 'AccountName', 'Amount', 'Bacs Code', 
                'Date Signed Up', 'Title', 'Salutation', 'FirstName', 'LastName', 'AddressLine1', 
                'AddressLine2', 'Town', 'County', 'PostCode', 'EmailAddress', 'MobilePhoneNumber', 
                'Bank', 'Branch', 'IsCompany', 'CompanyName'
            ];
        }

    }, 'applications.xlsx');
}

    // 5️⃣ Process Selected (Create 0N File)
    public function process(Request $request)
    {
        $ids = $request->ids;
        Application::whereIn('id', $ids)->update(['status' => 'processed']);

        // Optional: Here you can create the 0N File logic

        return response()->json(['success'=>true]);
    }

    // 6️⃣ Mark Selected as Processed (No File)
    public function markProcessed(Request $request)
    {
        $ids = $request->ids;
        Application::whereIn('id', $ids)->update(['status' => 'processed']);

        return response()->json(['success'=>true]);
    }
}
