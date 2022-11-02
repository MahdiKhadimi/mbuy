<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerCategoryController extends ApiController
{
   
    public function index(Seller $seller)
    {
        $categories = $seller->products()
        ->whereHas('categories')
        ->with('categories')
        ->get()
        ->pluck('categories')
        ->collapse();
        
        return $this->show_all($categories);
    }


   
}