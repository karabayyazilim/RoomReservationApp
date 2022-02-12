<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAccessRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'role_id',
    ];
}
