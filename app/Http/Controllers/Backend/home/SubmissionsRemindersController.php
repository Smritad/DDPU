<?php
namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log; // 👈 Add this at the top

use App\Models\File;
use App\Models\FileDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FileDataImport;
use App\Exports\FileDataExport;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SubmissionsRemindersController extends Controller
{
    public function index()
    {
       
        return view('backend.submissionsreminders.index');
    }
}