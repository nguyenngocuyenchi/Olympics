<?php

namespace App\Models;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spectateur extends Model
{

        protected $fillable = ['prenom','nom','telephone','email'];
    
        public function competition() {
            return $this->hasMany(Competition::class); 
        }

        public function reservations() {
            return $this->hasMany(Reservation::class);
        }
}
