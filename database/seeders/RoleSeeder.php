<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private $ROLE_ADMIN = 1;
    private $ROLE_PETANI = 2;
    private $ROLE_PEMBELI = 3;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role' => 'Admin'
        ]);
        Role::create([
            'role' => 'Petani'
        ]);
        Role::create([
            'role' => 'Pembeli'
        ]);
    }
}
