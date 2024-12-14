<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'is_available',
    ];

    public function computers(): HasMany
    {
        return $this->hasMany(Computer::class);
    }

    /**
    * Liên kết với model User thông qua quyền truy cập phòng máy.
    */
    // public function users()
    // {
    //     return $this->belongsToMany(User::class, 'user_room_permissions', 'room_id', 'user_id')
    //         ->withTimestamps();
    // }
}
