<?php

namespace App\Http\Controllers\Product;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ProductBuyerTransactionRequest;

class ProductBuyerTransactionController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('scope:purchase-product')->only('store');
        $this->middleware('can:purchase,buyer')->only('store');

    }
   
   
    public function store(ProductBuyerTransactionRequest $request,Product $product,User $buyer)
    {
     
        if($buyer->id==$product->seller->id){
            return $this->error_respone('Sorry You don\'t allow to continue purchase',409 );
        }

        if(!$buyer->is_verified()){
            return $this->errorResponse("The buyer must be verified!",409);
        }

        if(!$product->seller->is_verified()){
            return $this->errorResponse("The seller must be verified!",409);
        }

        if(!$product->is_available()){
            return $this->errorResponse("The product is not available!",409);
        }
        
        if($product->quantity < $request->quantity){
            return $this->errorResponse("There is n't to much product you want to buy!",409);            
        }

        return DB::transaction(function () use($request,$product,$buyer) {
            $product->quantity -= $request->quantity;
            $product->save();
            
            $transaction = Transaction::create([
                'quantity'=>$request->quantity,
                'product_id'=>$product->id,
                'buyer_id'=>$buyer->id
            ]);

            return $this->showOne($transaction,201);
        });

    }
}