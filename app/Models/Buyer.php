<?php

namespace App\Models;

use App\Models\Transaction;
use App\Models\Scopes\BuyerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buyer extends User
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
    public static function booted()
    {
        static::addGlobalScope(new BuyerScope);
    }

}