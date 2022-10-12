<?php

namespace App\Transformers;

use App\Models\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
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
    public function transform(Transaction $transaction)
    {
        return [
            'identifier'=>(int)$transaction->id,
            'stock'=>(string)$transaction->quantity,
            'product'=>(int)$transaction->product_id,
            'buyer'=>(int)$transaction->buyer_id,
           'creationDate'=>$transaction->created_at,
           'lastChange'=>$transaction->updated_at,
           'deleteDate'=> isset($transaction->deleted_at)?(string)$transaction->deleted_at:null,
           'links'=>[
               [
                   'rel'=>'self',
                   'href'=>route('transactions.show',$transaction->id)
               ],
               [
                'rel'=>'categories',
                'href'=>route('transactions.categories.index',$transaction->id)
               ],
               [
                'rel'=>'sellers',
                'href'=>route('transactions.sellers.index',$transaction->id)
               ],
               [
                'rel'=>'buyers',
                'href'=>route('buyers.show',$transaction->buyer_id)
               ],
           ]
            
        ];
    }
}