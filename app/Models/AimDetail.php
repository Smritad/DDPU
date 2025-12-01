<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AimDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aim_details';

    protected $fillable = [
        'aim_image',
        'details',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'details' => 'array',
        'deleted_at' => 'datetime',
    ];

    // Optional: auto-fill created_by / updated_by on saving
    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->id();
                $model->updated_by = auth()->id();
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });
    }
}
