<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseMessage extends Model
{
    use HasFactory;

    protected $table = 'response_messages';

    protected $guarded = [];

    public function participants()
    {
        return $this->belongsTo(Participant::class, 'social', 'social');
    }

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'social', 'social');
    }


}
