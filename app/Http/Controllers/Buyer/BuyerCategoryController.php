<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerCategoryController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('can:view,buyer')->only('index');
    }

   
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()
        ->with('product.categories')
        ->get()
        ->pluck('product.categories')
        ->collapse()
        ->unique()
        ->values();
        return $this->showAll($categories);
    }
    
}