<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'version', 'description'];

    public function computers()
    {
        return $this->belongsToMany(Computer::class, 'computer_software')->withPivot('installed_at', 'removed_at');
    }
}
