<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Pastikan grup 'SuperAdmin' ada
        $superAdminGroup = Group::firstOrCreate(['name' => 'SuperAdmin']);

        // Membuat pengguna SuperAdmin
        $superAdminUser = User::create([
            'name' => 'Rifki Fadilah',  // Nama SuperAdmin
            'nip' => '12345678',        // NIP contoh
            'password' => Hash::make('12345678'),  // Kata sandi, pastikan update sesuai
            'group_id' => $superAdminGroup->id,  // Assign ke grup SuperAdmin
            'photo' => null,  // Foto bisa diisi jika ada
        ]);

        // Menambahkan data ke tabel user_groups
        UserGroup::create([
            'user_id' => $superAdminUser->id,      // ID pengguna yang baru dibuat
            'group_id' => $superAdminGroup->id,    // ID grup yang baru dibuat atau sudah ada
            'created_id' => $superAdminUser->id,   // ID pengguna yang membuat data ini, bisa menggunakan ID user yang baru dibuat
            'updated_id' => $superAdminUser->id,   // ID pengguna yang mengupdate, bisa menggunakan ID user yang baru dibuat
        ]);
    }
}

