<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Supervisor extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
