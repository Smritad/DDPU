<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['file_name','collection_date','uploaded_date','notes','total_amount'];

    public function details()
    {
        return $this->hasMany(FileDetail::class);
    }
}
