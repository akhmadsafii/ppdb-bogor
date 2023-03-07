<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTemplate extends Model
{
    use HasFactory;
    protected $table = 'setting_templates';

    protected $guarded = [];
}
