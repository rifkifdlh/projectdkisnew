<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'group_id', 'created_id', 'updated_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }

    protected static function booted()
    {
        static::creating(function ($userGroup) {
            if (!$userGroup->created_id) {
                $userGroup->created_id = auth()->id();
            }
            $userGroup->updated_id = auth()->id();
        });

        static::updating(function ($userGroup) {
            $userGroup->updated_id = auth()->id();
        });
    }
}
