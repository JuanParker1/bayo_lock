<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;

    public function cryptoHistorie(){
        return $this->hasOne(CryptoHistorie::class);
    }

    public function ways(){
        return $this->hasMany(WayOfHistorie::class);
    }
}
