<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    use HasFactory;

    public function wayOfHistories(){
        return $this->belongsToMany(WayOfHistorie::class);
    }
}
