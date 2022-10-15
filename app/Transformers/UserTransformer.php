<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
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
    public function transform(User $user)
    {
        return [
            'identifier'=>(int)$user->id,
            'name'=>(string)$user->name,
            'email'=>(string)$user->email,
            'isAdmin'=>$user->admin,
            'creationDate'=>$user->created_at,
            'lastChange'=>$user->updated_at,
            'deleteDate'=> isset($user->deleted_at)?(string)$user->deleted_at:null,
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