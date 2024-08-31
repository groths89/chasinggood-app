<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin;
use App\Models\Administrator;
use App\Models\Volunteer;

class RolesSeeder extends Seeder
{
    public function run()
    {
        SuperAdmin::create([
            'name' => 'super_admin',
        ]);
        Administrator::create([
            'name' => 'administrator',
        ]);
        Volunteer::create([
            'name' => 'volunteer',
        ]);
    }
}
