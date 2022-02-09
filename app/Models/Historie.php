<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historie extends Model
{
    use HasFactory;

    // ######## Accessors ########
    public function getElementAttribute($value){
        return json_decode($value);
    }

    // ######## Relationships ########
    public function models($value){
        return $value . '2';
    }

    public function deposit()
    {
        return $this->hasOne(Deposit::class);
    }

//    public function purchase()
//    {
//        return $this->hasOne(Purchase::class);
//    }

    public function transaktion()
    {
        return $this->hasOne(Transaktion::class);
    }

    public function childern()
    {
        return $this->hasMany(Historie::class, 'parent_id');
    }

    public function details()
    {
        if ($this->purchase()->exists()) {
            $result = $this->hasOne(Purchase::class);
        } elseif ($this->deposit()->exists()) {
            $result = $this->hasOne(Deposit::class);
        } else {
            $result = $this->hasOne(Transaktion::class);
        }
        return $result;
    }
}
