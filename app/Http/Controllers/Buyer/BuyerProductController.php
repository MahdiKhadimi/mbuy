<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerProductController extends Controller
{
    public function index(Buyer $buyer)
    {
        $products = $buyer->transactions()->with('product')
        ->get()
        ->pluck('product');

        return response()->json(['data'=>$products],200);
    }

  
}