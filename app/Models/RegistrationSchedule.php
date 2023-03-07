<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationSchedule extends Model
{
    use HasFactory;

    protected $table = 'registration_schedules';

    protected $guarded = [];
}
