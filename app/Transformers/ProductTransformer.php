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
        ];
    }
}