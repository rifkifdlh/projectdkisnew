<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    public function run()
    {
        // Data grup dengan tugas masing-masing
        $groups = [
            [
                'name' => 'SuperAdmin',
                'tugas' => 'Mengelola seluruh sistem dan memiliki akses penuh terhadap semua fitur.',
            ],
            [
                'name' => 'E-Government',
                'tugas' => 'Mengelola layanan elektronik pemerintahan dan infrastruktur digital.',
            ],
            [
                'name' => 'ITIK',
                'tugas' => 'Mengelola teknologi informasi dan komunikasi untuk organisasi.',
            ],
            [
                'name' => 'Persandian',
                'tugas' => 'Bertanggung jawab atas keamanan informasi dan sandi rahasia organisasi.',
            ],
            [
                'name' => 'PIKP',
                'tugas' => 'Mengelola informasi publik dan komunikasi pemerintah.',
            ],
            [
                'name' => 'Statistik',
                'tugas' => 'Mengelola data statistik dan menyediakan analisis untuk pengambilan keputusan.',
            ],
            [
                'name' => 'Sekretariat',
                'tugas' => 'Mengelola administrasi umum dan mendukung operasional organisasi.',
            ],
            [
                'name' => 'Umum',
                'tugas' => 'Pengguna umum yang berpartisipasi dalam pelatihan dan penyampaian aspirasi.',
            ],
        ];

        // Insert data ke tabel groups
        DB::table('groups')->insert($groups);
    }
}
