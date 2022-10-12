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
        ];
    }
}