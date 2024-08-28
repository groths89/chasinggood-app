<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'nominating_option',
        'nominee_organization_name',
        'nominee_first_name',
        'nominee_last_name',
        'nominee_email',
        'category',
        'county',
        'story',
        'uploaded_video',
        'disclaimer_agreed',
    ];

    protected $casts = [
        'disclaimer_agreed' => 'boolean',
    ];
}
