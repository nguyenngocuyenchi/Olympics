<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lieu extends Model
{
    public function competition(){
        return $this->hasMany(Competition::class);
    }

    protected $fillable = ['nom', 'capacite'];
}
