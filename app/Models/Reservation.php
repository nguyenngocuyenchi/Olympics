<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['spectateur_id', 'competition_id'];

    public function spectateur()
    {
        return $this->belongsTo(Spectateur::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
