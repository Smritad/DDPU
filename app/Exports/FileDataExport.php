<?php

namespace App\Exports;

use App\Models\FileDetail;
use Maatwebsite\Excel\Concerns\FromCollection;

class FileDataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FileDetail::all();
    }
}
