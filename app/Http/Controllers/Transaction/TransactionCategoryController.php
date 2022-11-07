<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class TransactionCategoryController extends ApiController
{
    public function __construct()
    {
        $this->middleware('can,view,transactoin')->only('index');
    }
   
    public function index(Transaction $transaction)
    {
        
        $categories = $transaction->product->categories;

       return $this->show_all($categories);
    }

}