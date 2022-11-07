<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\AuthenticationException;

class ApiController extends Controller
{
    use ApiResponser;
    public function __construct()
    {
        $this->middleware('auth:api');
    }
   
    protected function allowedAdminAction()
    {
        if(Gate::denies('admin-actions')){
            throw new AuthorizationException('This action is unauthorized');
        }
    }
}