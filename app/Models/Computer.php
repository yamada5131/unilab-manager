<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'room_id', 'hardware_specifications', 'mac_address', 'operating_system', 'installed_software'];

    protected $casts = [
        'hardware_specifications' => 'json',
        'installed_software' => 'json',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function software()
    {
        return $this->belongsToMany(Software::class, 'computer_software')->withPivot('installed_at', 'removed_at');
    }

    public function status()
    {
        return $this->hasOne(ComputerStatus::class);
    }
}
