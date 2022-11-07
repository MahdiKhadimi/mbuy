<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductBuyerController extends ApiController
{
    public function index(Product $product)
    {
        $this->allowedAdminAction(); 
        $buyers = $product->transactions()
        ->with('buyer')
        ->get()
        ->pluck('buyer');

        return $this->show_all($buyers);
    }
}