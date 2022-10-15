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
     /**
      * Class constructor.
      */
     public function __construct()
     {
         
         parent::__construct();

         $this->middleware('transform.input:'.ProductTransformer::class)->only('store');
     }
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();

        return $this->show_all($products);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\jsonResponse
     */
    public function store(ProductRequest $request,User $seller)
    {
     
        $product = $this-> handle_product_store($seller);

        return $this->show_one($product,201);
    }
    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $this->show_one($product);
    }

  
}