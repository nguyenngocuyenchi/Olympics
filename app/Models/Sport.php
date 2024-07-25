<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    public function premier_tour()
    {
        return $this->hasMany(Competition::class);
    }

    public function demi_finale()
    {
        return $this->hasMany(Competition::class);
    }

    public function finale()
    {
        return $this->hasMany(Competition::class);
    }

    public function competition()
    {
        return $this->hasMany(Competition::class);
    }

    protected $fillable = ['nom'];
}
