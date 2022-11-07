<?php

namespace App\Http\Controllers\Product;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\ApiController;
use App\Transformers\ProductTransformer;


class ProductController extends ApiController
{
   
     public function __construct()
     {
         
         parent::__construct();

         $this->middleware('transform.input:'.ProductTransformer::class)->only('store');
     }
  
    public function index()
    {
        $products = Product::all();

        return $this->showAll($products);
    }

 
    public function store(ProductRequest $request,User $seller)
    {
     
        $product = $this-> handleProductStore($seller);

        return $this->showOne($product,201);
    }
   
    public function show(Product $product)
    {
        return $this->showOne($product);
    }

  
}