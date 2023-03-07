<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $guarded = [];

    public function participants()
    {
        return $this->belongsTo(Participant::class, 'id_participant', 'id');
    }
}
