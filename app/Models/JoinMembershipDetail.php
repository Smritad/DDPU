<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinMembershipDetail extends Model
{
    use HasFactory;

    protected $table = 'joinmembership_details';

    protected $fillable = [
        'heading',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
