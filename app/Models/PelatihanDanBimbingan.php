<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanDanBimbingan extends Model
{
    use HasFactory;

    protected $table = 'pelatihandanbimbingan';

    protected $primaryKey = 'id_pelatihan';

    protected $fillable = [
        'no_pelatihan',
        'nama_pelatihan',
        'kuota',
        'peserta',
        'user_id',
        'group_id',
        'tempat_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'status', // Tambahkan kolom status di sini
        'created_id',
        'updated_id',
    ];

    // Relationship with users, groups, and tempat
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function tempat()
    {
        return $this->belongsTo(Tempat::class, 'tempat_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }

 
    // Di model PelatihanDanBimbingan
    public function peserta()
    {
        return $this->belongsToMany(User::class);
    }


    // Event untuk menambahkan created_id dan updated_id
    protected static function booted()
    {
        static::creating(function ($pelatihan) {
            // Menetapkan created_id dan updated_id saat data pertama kali dibuat
            $pelatihan->created_id = auth()->id();
            $pelatihan->updated_id = auth()->id();
        });

        static::updating(function ($pelatihan) {
            // Hanya update updated_id saat data diupdate
            $pelatihan->updated_id = auth()->id();
        });
    }
}
