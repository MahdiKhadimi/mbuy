<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
   
    public function __construct()
    {
        $this->middleware('can:view,buyer')->only('index');

    }
    public function index(Buyer $buyer)
    {
        $this->allowedAdminAction(); 
        $sellers = $buyer->transactions()->with('product.seller')
        ->get()
        ->pluck('product.seller');
        return $this->showAll($sellers);
    }

}