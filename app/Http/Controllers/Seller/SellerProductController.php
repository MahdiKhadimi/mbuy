<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ProductRequest;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the seller product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller )
    {
        $products = $seller->products; 

        return $this->show_all($products);
    }

    /**
     * Store a newly created seller product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Seller $seller)
    {
        
        return $this->show_all($request->handle_product_store($seller));       
        
    }



    /**
     * Remove the specified seller product from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller,Product $product)
    {
        if(Storage::exists($product->image)){
            Storage::delete($product->image);
        }
        
        $product->delete();
        
        return $this->show_one($product);
        
    }
}