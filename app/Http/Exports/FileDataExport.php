<?php
namespace App\Exports;

use App\Models\FileDetail;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class FileDataExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithCustomCsvSettings
{
    protected $fileId;

    public function __construct($fileId)
    {
        $this->fileId = $fileId;
        Log::info("🚀 Starting Export for File ID: {$fileId}");
    }

    public function collection()
{
    $data = FileDetail::where('file_id', $this->fileId)->get([
        'dd_reference','sort_code','account_no','account_name','amount',
        'bacs_code','invoice_no','title','initial','forename','surname',
        'salutation_1','salutation_2','address_1','address_2','area','town',
        'postcode','phone','mobile','email','notes'
    ]);

    Log::info("📦 Exporting " . $data->count() . " records for File ID: {$this->fileId}");
    Log::info("🧩 Sample rows", $data->take(3)->toArray());

    return $data;
}


    public function headings(): array
    {
        Log::info("🧾 Adding Headings to Export File");

        return [
            'DD REFERENCE',
            'Sort Code',
            'Account No',
            'Account Name',
            'Amount',
            'BACS Code',
            'Invoice No (Optional)',
            'Title',
            'Initial',
            'Forename',
            'Surname',
            'Salutation 1',
            'Salutation 2',
            'Address 1',
            'Address 2',
            'Area',
            'Town',
            'Postcode',
            'Phone',
            'Mobile',
            'Email',
            'Notes (Optional)',
        ];
    }

    public function map($row): array
    {
        return [
            trim($row->dd_reference),
            trim($row->sort_code),
            trim($row->account_no),
            trim($row->account_name),
            number_format((float) $row->amount, 2, '.', ''),
            trim($row->bacs_code),
            trim($row->invoice_no),
            trim($row->title),
            trim($row->initial),
            trim($row->forename),
            trim($row->surname),
            trim($row->salutation_1),
            trim($row->salutation_2),
            trim($row->address_1),
            trim($row->address_2),
            trim($row->area),
            trim($row->town),
            trim($row->postcode),
            trim($row->phone),
            trim($row->mobile),
            trim($row->email),
            trim($row->notes),
        ];
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'enclosure' => '"', // 👈 Add enclosure so Excel reads columns properly
            'line_ending' => "\n",
            'use_bom' => true,  // 👈 Enable BOM to fix Excel header display issue
        ];
    }
}
