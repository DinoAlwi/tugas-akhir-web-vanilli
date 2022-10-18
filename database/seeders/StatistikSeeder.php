<?php

namespace Database\Seeders;

use App\Models\Statistik;
use Illuminate\Database\Seeder;

class StatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            Statistik::create([
                'ip_address' => '127.0.0.1',
                'tanggal_kunjungan' => 1661109318
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            Statistik::create([
                'ip_address' => '127.0.0.1',
                'tanggal_kunjungan' => 1661256918
            ]);
        }
    }
}
