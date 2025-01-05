<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TempatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tempatData = [
            ['name' => 'DKIS Bypass', 'alamat' => 'Jalan Brigjend Dharsono No. 1, Kel. Sunyararagi, Kec. Kesambi, Kota Cirebon, 45135'],
            ['name' => 'DKIS Sudarsono', 'alamat' => 'Jalan Dr. Sudarsono No. 40, Kel. Kesambi, Kec. Kesambi, Kota Cirebon, 45134'], 
            ['name' => 'Stadion Bima', 'alamat' => 'Jalan Brigjend Dharsono No. 1, Kel. Sunyararagi, Kec. Kesambi, Kota Cirebon, 45135'],
            ['name' => 'Hotel Aston', 'alamat' => null], // Alamat kosong (nullable)
            ['name' => 'Grage City Mall', 'alamat' => 'Jalan Jendral A. Yani No. 1, Kel. Pegambiran, Kec. Lemahwungkuk, Kota Cirebon, 45141'],
            ['name' => 'CSB Mall', 'alamat' => 'Jalan Dr. Cipto Mangunkusumo No. 26, Kel. Pekiringan, Kec. Kesambi, Kota Cirebon, 45131'],
            ['name' => 'Masjid Raya At-Taqwa', 'alamat' => 'Jalan Kartini No. 2, Kel. Kejaksan, Kec. Kejaksan, Kota Cirebon, 45123'],
        ];

        DB::table('tempat')->insert($tempatData);
    }
}
