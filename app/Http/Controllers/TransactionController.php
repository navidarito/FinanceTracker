<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = new Transaction();
        $transactions = Transaction::where('user_id', auth()->id())->get();

        $totalIncome = $transactions->where('type', 1)->sum('amount');
        $totalExpenses = $transactions->where('type', 0)->sum('amount');
        


        return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpenses'));


        //return view('transactions.index');
    }

    public function showAddTransactionForm()
    {
        return view('transactions.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'happened_on' => 'required|date',
            'type' => 'required|String|in:Income,Expenses',
        ]);

        $validated['user_id'] = auth()->id();

        if($validated['type'] === 'Income') {
            $validated['type'] = 1;
        } else if($validated['type'] === 'Expenses') {
            $validated['type'] = 0;
        }

        //dd($validated);
        //die('here');

        Transaction::create($validated);

        return redirect('/transactions')->with('success', 'Transaction added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::find($id);

        return view('transactions.edit',compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        $transaction->description = $request->description;
        $transaction->amount = $request->amount;
        $transaction->happened_on = $request->happened_on;

        if($request['type'] === 'Income') {
            $transaction['type'] = 1;
        } else if($request['type'] === 'Expenses') {
            $transaction['type'] = 0;
        }
        $transaction->save();

        return redirect('/transactions');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect('/transactions')->with('success', 'Transaction delete successfully!');
    }
}
