<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingPayment extends Model
{
    use HasFactory;

    protected $table = 'setting_payments';

    protected $guarded = [];
}
