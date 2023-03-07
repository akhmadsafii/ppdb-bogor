<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentParticipant extends Model
{
    use HasFactory;

    protected $table = 'payment_participants';

    protected $guarded = [];

    public function participants()
    {
        return $this->belongsTo(Participant::class, 'id_participant', 'id');
    }
}
