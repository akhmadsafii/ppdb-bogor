<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $guarded = [];

    public function participants()
    {
        return $this->belongsTo(Participant::class, 'id_participant', 'id');
    }

    public function responses()
    {
        return $this->hasMany(ResponseMessage::class, 'id_message', 'id');
    }
}
