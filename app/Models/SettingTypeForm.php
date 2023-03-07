<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTypeForm extends Model
{
    use HasFactory;

    protected $table = 'setting_type_forms';

    protected $guarded = [];

    public function forms()
    {
        return $this->hasMany(SettingForm::class, 'id_type', 'id');
    }
}
