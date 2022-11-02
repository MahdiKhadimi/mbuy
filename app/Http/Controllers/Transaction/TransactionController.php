<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class TransactionController extends ApiController
{
   
    public function index()
    {
        $transactions = Transaction::all();
        
        return $this->show_all($transactions);
    }

    public function show(Transaction $transaction)
    {
        return $this->show_one($transaction);
    }
}