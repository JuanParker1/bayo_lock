<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $table = 'bayo.trades';
    protected $fillable = [
        'cryptocurrency_id',
        'currency-single-price',
        'total-currency',
        'order-day',
        'location_id'
    ];

    public function cryptocurrency()
    {
        return $this->belongsTo(Cryptocurrency::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
