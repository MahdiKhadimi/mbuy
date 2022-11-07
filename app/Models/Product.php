<?php

namespace App\Models;

use App\Models\Seller;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const AVAILABLE_PRODUCT = 'available';

    const UNAVAILABLE_PRODUCT = 'unavailable';
    
    protected  $fillable =  [
        'name',
        'description',
        'status',
        'price',
        'currency',
        'image',
        'seller_id',
        'quantity'
    ];

    protected $hidden = [
        'pivot'
    ];
    
    public $transformer = ProductTransformer::class;
    public function is_available()
    {
        return $this->status == Product::AVAILABLE_PRODUCT;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
}