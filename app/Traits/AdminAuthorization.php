<?php

use App\Models\User;

trait AdminAuthorization {
    public function before(User $user,$ability)
    {
        if($user->is_admin()){
            return true;
        }
    }
}