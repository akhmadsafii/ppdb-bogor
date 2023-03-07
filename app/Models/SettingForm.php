<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingForm extends Model
{
    use HasFactory;

    protected $table = 'setting_forms';

    protected $guarded = [];

    public function types()
    {
        return $this->belongsTo(SettingTypeForm::class, 'id_type', 'id');
    }
}
