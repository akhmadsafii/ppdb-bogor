<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $guarded = [];

    public function forms()
    {
        return $this->belongsTo(SettingForm::class, 'id_form', 'id');
    }
}
