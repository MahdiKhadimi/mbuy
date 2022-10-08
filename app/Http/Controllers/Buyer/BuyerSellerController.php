<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()->with('product.seller')
        ->get()
        ->pluck('product.seller');
        return $this->show_all($sellers);
    }

}