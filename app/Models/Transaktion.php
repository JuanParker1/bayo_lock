<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaktion extends Model
{
    use HasFactory;

    public function network(){
        return $this->belongsTo(Network::class);
    }
    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }
}
