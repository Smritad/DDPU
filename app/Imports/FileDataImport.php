<?php

namespace App\Imports;

use App\Models\FileDetail;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class FileDataImport implements 
    ToModel, 
    WithHeadingRow, 
    WithBatchInserts, 
    WithChunkReading, 
    WithCustomCsvSettings
{
    protected $fileId;
    protected $logged = false;

    public function __construct($fileId)
    {
        $this->fileId = $fileId;
    }

    /**
     * Force correct CSV reading settings
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',       // change to ';' if your CSV uses semicolons
            'enclosure' => '"',
            'input_encoding' => 'UTF-8',
        ];
    }

    /**
     * Map each row to FileDetail model
     */
    public function model(array $row)
    {
        // Log the first row to verify column mapping
        if (!$this->logged) {
            Log::info('🔍 Sample Excel Row Parsed:', $row);
            $this->logged = true;
        }

        // Skip empty or invalid rows
        if (empty($row['dd_reference']) && empty($row['account_no'])) {
            return null;
        }

        try {
            return new FileDetail([
                'file_id'       => $this->fileId,
                'dd_reference'  => $row['dd_reference'] ?? null,
                'sort_code'     => $row['sort_code'] ?? null,
                'account_no'    => $row['account_no'] ?? null,
                'account_name'  => $row['account_name'] ?? null,
                'amount'        => isset($row['amount']) ? (float) $row['amount'] : 0,
                'bacs_code'     => $row['bacs_code'] ?? null,
                'invoice_no'    => $row['invoice_no_optional'] ?? $row['invoice_no'] ?? null,
                'title'         => $row['title'] ?? null,
                'initial'       => $row['initial'] ?? null,
                'forename'      => $row['forename'] ?? null,
                'surname'       => $row['surname'] ?? null,
                'salutation_1'  => $row['salutation_1'] ?? null,
                'salutation_2'  => $row['salutation_2'] ?? null,
                'address_1'     => $row['address_1'] ?? null,
                'address_2'     => $row['address_2'] ?? null,
                'area'          => $row['area'] ?? null,
                'town'          => $row['town'] ?? null,
                'postcode'      => $row['postcode'] ?? null,
                'phone'         => $row['phone'] ?? null,
                'mobile'        => $row['mobile'] ?? null,
                'email'         => $row['email'] ?? null,
                'notes'         => $row['notes_optional'] ?? $row['notes'] ?? null,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Row import failed', [
                'file_id' => $this->fileId,
                'error' => $e->getMessage(),
                'row_data' => $row,
            ]);
            return null;
        }
    }

    /**
     * Optimize import performance
     */
    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
