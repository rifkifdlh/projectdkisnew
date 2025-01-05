<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    // Tentukan tabel (jika nama tabel tidak plural dari model)
    protected $table = 'groups';

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['name', 'tugas',];

    // Relasi ke model User (satu grup memiliki banyak pengguna)
    public function users()
    {
        return $this->hasMany(User::class);
    }




      // Relasi ke UserGroup
    public function userGroups()
    {
        return $this->hasMany(UserGroup::class);
    }

}

