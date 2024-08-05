<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    use HasFactory;

    protected $fillable = [
        'basic_details',
        'nomination_details',
        'story_details',
        'references_details',
        'license_and_consent',
        'review',
    ];
}
