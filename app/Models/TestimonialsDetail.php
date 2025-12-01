<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialsDetail extends Model
{
    use HasFactory;

    protected $table = 'testimonials_details';

    protected $fillable = [
        'main_heading',
        'testimonials', // JSON column
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    protected $casts = [
        'testimonials' => 'array', // Automatically converts to/from JSON
    ];
}
