<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerBuyerController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('can,view,seller')->only('index');
    }
    public function index(Seller $seller)
    {
        $this->allowedAdminAction(); 
        $buyers = $seller->products()
        ->whereHas('transactions')
        ->with('transactions.buyer')
        ->get()
        ->pluck('transactions')
        ->collapse()
        ->pluck('buyer');
        
        return $this->show_all($buyers);
        
    }

}