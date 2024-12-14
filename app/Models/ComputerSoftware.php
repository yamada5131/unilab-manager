<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerSoftware extends Model
{
    use HasFactory;

    protected $table = 'computer_software';

    protected $fillable = ['computer_id', 'software_id', 'installed_at', 'removed_at'];
}
