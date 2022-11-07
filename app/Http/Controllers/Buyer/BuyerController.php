<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\ApiController;

class BuyerController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('can:view,buyer')->only('show');
        
    }
    public function index()
    {       
        $this->allowedAdminAction();  
        $buyers = Buyer::has('transactions')->get();    
         
        return $this->show_all($buyers);
    }

    public function show(Buyer $buyer)
    {
      
        return $this->show_one($buyer);
    }

}