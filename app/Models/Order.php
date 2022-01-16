<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function cryptos(){
        return $this->belongsToMany(Crypto::class);
    }

    public function depositWithdraw(){
        return $this->belongsToMany(DepositWithdraw::class);
    }
}
