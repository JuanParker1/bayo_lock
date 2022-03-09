<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'pay_accounts',
        'mail',
        'telefon',
    ];

    public function contracts(){
        return $this->belongsToMany(Contract::class);
    }
}
