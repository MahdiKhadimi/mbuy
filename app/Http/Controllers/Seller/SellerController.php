<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\Scopes\SellerScope;
use App\Http\Controllers\ApiController;

class SellerController extends ApiController
{
   
   
    public function __construct()
    {
        $this->middleware('can,view,seller')->only('show');

    }
    public function index()
    {
        $this->allowedAdminAction(); 
        $sellers = Seller::has('products')->get();

        return $this->show_all($sellers);

    }
  
    public function show(Seller $seller)
    {
    
        return $this->show_one($seller);
    }

    public static function booted()
    {
        static::addGlobalScope(new SellerScope);
    }
       
}