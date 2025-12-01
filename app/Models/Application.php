<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    // Table name (if not following Laravel plural convention)
    protected $table = 'applications';

    // Mass assignable fields
    protected $fillable = [
        'signup_date',
        'reference',
        'title',
        'first_name',
        'last_name',
        'mobile',
        'email',
        'is_company',
        'company_name',
        'address1',
        'address2',
        'town',
        'postcode',
        'account_name',
        'account_no',
        'sort_code',
        'bank',
        'status',
    ];

    // Casts for proper data types
    protected $casts = [
        'signup_date' => 'datetime',
        'is_company' => 'boolean',
    ];

    // Default attribute values
    protected $attributes = [
        'status' => 'unprocessed',
        'is_company' => false,
    ];

    /**
     * Accessor for full name
     */
    public function getFullNameAttribute()
    {
        return "{$this->title} {$this->first_name} {$this->last_name}";
    }
}
