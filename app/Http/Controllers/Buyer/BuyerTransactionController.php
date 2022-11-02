<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerTransactionController extends ApiController
{
  
    public function index(Buyer $buyer)
    {
        
        $transactions = $buyer->transactions;

        return $this->show_all($transactions);
        
    }

  
}