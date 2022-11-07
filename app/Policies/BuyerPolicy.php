<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Buyer;
use AdminAuthorization;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyerPolicy
{
    use HandlesAuthorization, AdminAuthorization;
    
    public function viewAny(User $user)
    {
        //
    }

  
    public function view(User $user, Buyer $buyer)
    {
        return $user->id===$buyer->id;
    }

  
    public function create(User $user)
    {
        //
    }

  
    public function update(User $user, Buyer $buyer)
    {
        //
    }

  
    public function delete(User $user, Buyer $buyer)
    {
        //
    }

   
    public function restore(User $user, Buyer $buyer)
    {
        //
    }

  
    public function parchuse(User $user, Buyer $buyer)
    {
        return $user->id===$buyer->id;
    }
}