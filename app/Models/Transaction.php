<?php

namespace App\Models;

use App\Models\Seller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
   
    protected $dates = ['created_at'];
  
    
    protected $fillable = [
        'quantity',
        'product_id',
        'buyer_id'
    ];

    public $transformer = TransactionTransformer::class;
   public function buyer()
   {
       return $this->belongsTo(buyer::class);
   }

   public function product()
   {
       return $this->belongsTo(Product::class);
   }

}