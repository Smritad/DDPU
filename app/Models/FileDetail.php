<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileDetail extends Model
{
    protected $fillable = [
        'file_id','dd_reference','sort_code','account_no','account_name','amount',
        'bacs_code','invoice_no','title','initial','forename','surname',
        'salutation_1','salutation_2','address_1','address_2','area','town',
        'postcode','phone','mobile','email','notes'
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
