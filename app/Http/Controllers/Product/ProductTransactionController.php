<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductTransactionController extends ApiController
{
   
    public function index(Product $product)
    {
        $transactions = $product->transactions;

        return $this->show_all($transactions);
        
    }
  
}