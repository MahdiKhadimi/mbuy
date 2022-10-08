<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerTransactionController extends ApiController
{
    /**
     * Display a listing of the buyer transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        
        $transactions = $buyer->transactions;

        return $this->show_all($transactions);
        
    }

  
}