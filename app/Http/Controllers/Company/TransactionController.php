<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
       $transactions = Transaction::where('t_user_id',Auth::user()->id)->orderBy('id', 'desc')->get();
       return view('admin.transaction.company', compact('transactions'));
    }
}
