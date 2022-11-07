<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerTransactionController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('can,sale,seller')->only('index');

    }
    public function index(Seller $seller)
    {
        $transactions = $seller->products()
        ->with('transactions')
        ->get()
        ->pluck('transactions')
        ->collapse();

        return $this->showAll($transactions);
    }
   
}