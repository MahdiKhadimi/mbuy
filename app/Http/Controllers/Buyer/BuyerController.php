<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerController extends ApiController
{
    public function index()
    {       
        $buyers = Buyer::has('transactions')->get();    
         
        return $this->show_all($buyers);
    }

    public function show(Buyer $buyer)
    {
      
        return $this->show_one($buyer);
    }

}