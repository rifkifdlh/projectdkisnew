<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $primaryKey = 'id_event'; // Define the custom primary key column


    protected $fillable = [
        'no_event',
        'nama_event',
        'photo',
        'deskripsi_singkat',
        'tempat_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'status',
        'created_id',
        'updated_id',
    ];

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
