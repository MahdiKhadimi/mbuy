<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends ApiController
{
   
    public function index(Seller $seller )
    {
        $products = $seller->products; 

        return $this->show_all($products);
    }

    public function store(ProductRequest $request, Seller $seller)
    {
        
        return $this->show_all($request->handle_product_store($seller));       
        
    }

    public function destroy(Seller $seller,Product $product)
    {
        if(Storage::exists($product->image)){
            Storage::delete($product->image);
        }
        
        $product->delete();
        
        return $this->show_one($product);
        
    }
}