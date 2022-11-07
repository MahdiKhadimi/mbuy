<?php

namespace App\Transformers;

use App\Models\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
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
    public function transform(Buyer $buyer)
    {
        return [
            'identifier'=>(int)$buyer->id,
            'name'=>(string)$buyer->name,
            'email'=>(string)$buyer->email,
            'isAdmin'=>($buyer->admin==='true'),
            'creationDate'=>$buyer->created_at,
            'lastChange'=>$buyer->updated_at,
            'deleteDate'=> isset($buyer->deleted_at)?(string)$buyer->deleted_at:null,
            'links'=>[
                [
                    'rel'=>'self',
                    'href'=>route('buyers.show',$buyer->id),
                ],
                [
                    'rel'=>'categories',
                    'href'=>route('buyers.categories.index',$buyer->id),
                ],
                [
                    'rel'=>'products',
                    'href'=>route('buyers.products.index',$buyer->id),
                ],
                [
                    'rel'=>'transactions',
                    'href'=>route('buyers.transactions.index',$buyer->id),
                ],
            ]
        ];
    }
    public static function originalAttribute($index)
    {
        $attributes = [
            'id'=>'identifier',
            'name'=>' name',
            'email'=>'email',
            'admin'=>'isAdmin',
            'created_at'=>'creationtDate',
            'updated_at'=>'lastChange',
             'deleted_at'=>'DeleteDate'
        ];

        return isset($attributes[$index])? $attributes[$index]:null;
    }
}