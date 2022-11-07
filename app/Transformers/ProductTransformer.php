<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
           
            'identifier'=>(int)$product->id,
            'title'=>(string)$product->name,
            'detail'=>(string)$product->description,
            'stock'=>(string)$product->quantity,
            'seller'=>(int)$product->seller_id,
            'situation'=>(string)$product->status,
            'picture'=>(string)$product->image,
            'creationDate'=>$product->created_at,
            'lastChange'=>$product->updated_at,
            'deleteDate'=> isset($product->deleted_at)?(string)$product->deleted_at:null,
            'links'=>[
                [
                    'rel'=>'self',
                    'href'=>route('products.show',$product->id)
                ],
                [
                    'rel'=>'buyers',
                    'href'=>route('products.buyers.index',$product->id)
                ],
                [
                    'rel'=>'transactions',
                    'href'=>route('products.transactions.index',$product->id)
                ],
                [
                    'rel'=>'categories',
                    'href'=>route('products.categories.index',$product->id)
                ],
                [
                    'rel'=>'sellers',
                    'href'=>route('sellers.show',$product->seller_id)
                ]

            ]
        ];
    }

   
    public static function originalAttribute($index)
    {
        $attributes = [
            'id'=>'identifier',
            'title'=>' name',
            'description'=>'detail',
            'quantity'=>'stock',
            'seller_id'=>'product',
            'image'=>'picture',
            'created_at'=>'creationtDate',
            'updated_at'=>'lastChange',
             'deleted_at'=>'DeleteDate'
        ];

        return isset($attributes[$index])? $attributes[$index]:null;
    }
}