<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
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
    public function transform(Category $category)
    {
        return [
            'identifier'=>(int)$category->id,
             'name'=>(string)$category->name,
             'description'=>(string)$category->description,
            'creationDate'=>$category->created_at,
            'lastChange'=>$category->updated_at,
            'deleteDate'=> isset($category->deleted_at)?(string)$category->deleted_at:null,
            'links'=>[
                [
                    'rel'=>'self',
                    'href'=>route('categories.show',$category->id),
                ],
                [
                    'rel'=>'products',
                    'href'=>route('categories.products.index',$category->id),
                ],
                [
                    'rel'=>'transactions',
                    'href'=>route('categories.transactions.index',$category->id),
                ],
                [
                    'rel'=>'sellers',
                    'href'=>route('categories.sellers.index',$category->id),
                ],
                [
                    'rel'=>'buyers',
                    'href'=>route('categories.buyers.index',$category->id),
                ],
            ]
        ];
    }
}