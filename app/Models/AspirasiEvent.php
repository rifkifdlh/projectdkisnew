<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspirasiEvent extends Model
{
    use HasFactory;

    protected $table = 'aspirasievent';
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = [
        'no_aspirasi',
        'tujuan',
        'manfaat',
        'lampiransurat',
        'disposisi_id',
        'status',
        'alasan_ditolak',
        'created_id',
        'updated_id',
    ];

    // Relasi dengan model Group (Disposisi)
    public function disposisi()
    {
        return $this->belongsTo(Group::class, 'disposisi_id');
    }

    // untuk mengisi created_id
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    // untuk mengisi updated_id
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }

    // Event untuk menambahkan created_id dan updated_id
    protected static function booted()
    {
        static::creating(function ($event) {
               // Menetapkan created_id dan updated_id saat data pertama kali dibuat
            $event->created_id = auth()->id();
            $event->updated_id = auth()->id();
        });
   
        static::updating(function ($event) {
               // Hanya update updated_id saat data diupdate
            $event->updated_id = auth()->id();
        });
    }
}
