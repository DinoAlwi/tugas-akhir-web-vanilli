<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
        $admin = User::create([
            'username' => 'admin',
            'nama' => 'Admin',
            'password' => Hash::make('admin')
        ]);

        $admin->roles()->attach($this->ROLE_ADMIN);

        $petani = User::create([
            'username' => 'petani',
            'nama' => 'Petani',
            'password' => Hash::make('petani')
        ]);

        $petani->roles()->attach($this->ROLE_PETANI);
    }
}
