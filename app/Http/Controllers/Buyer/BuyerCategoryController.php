<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerCategoryController extends ApiController
{
   
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()
        ->with('product.categories')
        ->get()
        ->pluck('product.categories')
        ->collapse()
        ->unique()
        ->values();
        return $this->show_all($categories);
    }
    
}