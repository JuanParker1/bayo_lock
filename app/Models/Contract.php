<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'status'
    ];

    public function deposits()
    {
        return $this->belongsToMany(Deposit::class);
    }

    public function trades()
    {
        return $this->belongsToMany(Trade::class);
    }
}
