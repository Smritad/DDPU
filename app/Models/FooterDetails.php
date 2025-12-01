<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FooterDetails extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'logo', 'description', 'address', 'email','mapurl', 'phone',
        'social_titles', 'social_links',
        'created_by', 'updated_by', 'deleted_by',
    ];
}
