<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()->with('product.seller')
        ->get()
        ->pluck('product.seller');
        return $this->show_all($sellers);
    }

}