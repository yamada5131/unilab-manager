<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerStatus extends Model
{
    use HasFactory;

    protected $table = 'computer_status';

    protected $fillable = ['computer_id', 'status', 'last_checked', 'current_user'];

    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}
