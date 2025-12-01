<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseDetail extends Model
{
    use HasFactory;

    protected $table = 'whychoose_details';

    protected $fillable = [
        'main_heading',
        'details',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'details' => 'array',
    ];
}
