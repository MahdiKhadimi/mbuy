<?php

namespace App\Policies;

use App\Models\User;
use AdminAuthorization;
use App\Models\transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization, AdminAuthorization;

   

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\transaction  $transaction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, transaction $transaction)
    {
       return $user->id===$transaction->buyer->id||$user->id===$transaction->product->seller->id;
    }

    
}