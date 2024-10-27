<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_id',
        'hardware_specifications',
        'network_status',
        'mac_address',
        'operating_system',
        'installed_software',
    ];

    protected $casts = [
        'hardware_specifications' => 'json',
        'installed_software' => 'json',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
