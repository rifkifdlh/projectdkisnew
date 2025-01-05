<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'nip', 'password', 'photo', 'group_id'];

    protected $hidden = ['password', 'remember_token'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    // Di Model User
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_groups', 'user_id', 'group_id')
                    ->withPivot('created_by', 'updated_by'); // Menyertakan pivot table columns
    }


    // Di model User
    public function pelatihans()
    {
        return $this->belongsToMany(PelatihanDanBimbingan::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }



    public function getIsOnlineAttribute()
    {
        $sessionKey = 'user-is-online-' . $this->id;
    
        // Periksa apakah status "online" tersedia di cache
        return Cache::has($sessionKey);
    }
    
    
    
       // Relasi ke UserGroup
    public function userGroups()
    {
        return $this->hasMany(UserGroup::class);
    }

   
}
