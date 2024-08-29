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
        'email_address',
        'phone_number',
        'nominating_category',
        'nominee_name',
        'nominee_email',
        'county',
        'story',
        'uploaded_video',
        'disclaimer_agreed',
    ];

    protected $casts = [
        'disclaimer_agreed' => 'boolean',
    ];
}
