<?php

namespace App\Transformers;

use App\Models\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
    public function transform(Seller $seller)
    {
        return [
            'identifier'=>(int)$seller ->id,
            'name'=>(string)$seller ->name,
            'email'=>(string)$seller ->email,
            'isAdmin'=>($seller ->admin==='true'),
            'creationDate'=>$seller ->created_at,
            'lastChange'=>$seller ->updated_at,
            'deleteDate'=> isset($seller ->deleted_at)?(string)$seller ->deleted_at:null,
            'links'=>[
                [
                    'rel'=>'self',
                    'href'=>route('sellers.show',$seller->id),
                ],
                [
                    'rel'=>'buyers',
                    'href'=>route('sellers.buyers.index',$seller->id),
                ],
                [
                    'rel'=>'transactions',
                    'href'=>route('sellers.transactions.index',$seller->id),
                ],
                [
                    'rel'=>'products',
                    'href'=>route('sellers.products.index',$seller->id),
                ],
                [
                    'rel'=>'categories',
                    'href'=>route('sellers.categories.index',$seller->id),
                ],
               
            ]
        ];
    }

    public static function original_attribute($index)
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