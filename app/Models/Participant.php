<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Participant extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'id_participant', 'id');
    }
}
