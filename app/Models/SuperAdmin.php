<?php

namespace App\Models;

use Spatie\Permission\Models\Role;

class SuperAdmin extends Role
{
    protected $fillable = ['name', 'description', 'level'];

    public function getLevelAttribute($value)
    {
        return 'Level ' . $value;
    }
}
