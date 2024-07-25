<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    public function sport(){
        return $this->belongsTo(Sport::class,'sport_id','id');
    }

    public function lieu(){
        return $this->belongsTo(Lieu::class,'lieu_id','id');
    }

    protected $fillable = ['jour','heure_de_debut','heure_de_fin','prix','type','sport_id','lieu_id'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

