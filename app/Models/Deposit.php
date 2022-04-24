<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'fees',
        'where',
        'currency'
    ];

    public function next(){
        return $this->join('parent_child','key','=','parent_id')->first('child_id');
    }
}
