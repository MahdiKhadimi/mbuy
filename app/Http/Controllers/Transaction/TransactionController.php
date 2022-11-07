<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class TransactionController extends ApiController
{
   
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this-> middleware('can,view,transanction')->only('show');
    }
    public function index()
    {
        $this->allowedAdminAction(); 
        $transactions = Transaction::all();
        
        return $this->show_all($transactions);
    }

    public function show(Transaction $transaction)
    {
        return $this->show_one($transaction);
    }
}