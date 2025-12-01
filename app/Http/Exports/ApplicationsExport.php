<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection, WithHeadings
{
    protected $applications;

    public function __construct($applications)
    {
        $this->applications = $applications;
    }

    public function collection()
    {
        return $this->applications->map(function($app){
            return [
                $app->signup_date,
                $app->reference,
                $app->account_name,
                $app->bank,
                $app->account_no,
                $app->sort_code,
            ];
        });
    }

    public function headings(): array
    {
        return ['Sign Up Date','Reference','Account Name','Bank','Account No','Sort Code'];
    }
}
