<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultSoftware extends Model
{
    use HasFactory;

    protected $table = 'default_software';

    protected $fillable = ['software_id'];

    public function software()
    {
        return $this->belongsTo(Software::class);
    }
}
