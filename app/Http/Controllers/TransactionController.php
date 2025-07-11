<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $month = date('n');
        $transactions = new Transaction();
        $transactions = Transaction::where('user_id', auth()->id())->whereMonth('happened_on',$month)->orderBy('happened_on','ASC')->get();

        $totalIncome = $transactions->where('type', 1)->sum('amount');
        $totalExpenses = $transactions->where('type', 0)->sum('amount');
        $transactions->each(function ($transaction){
            $transaction->category_name = Category::find($transaction->category_id)->name ?? 'Uncategorized';
        });

        

        return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpenses'));


    }

    public function showAddTransactionForm()
    {
        $categories = Category::all();
        return view('transactions.add', compact('categories'));
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
            'category_id' => 'required'
        ]);

        $validated['user_id'] = auth()->id();

        if($validated['type'] === 'Income') {
            $validated['type'] = 1;
        } else if($validated['type'] === 'Expenses') {
            $validated['type'] = 0;
        }



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
        $categories = Category::all();

        return view('transactions.edit',compact('transaction', 'categories'));
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

    public function filter(Request $request){
        

        if($request->start_date == null || $request->end_date == null){
           return redirect()->route('transaction.index')->with('error', 'Please select a valid date range.');
        }else {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $transactions = Transaction::where('user_id', auth()->id())
            ->whereBetween('happened_on', [$start_date, $end_date])
            ->orderBy('happened_on','ASC')
            ->get();
        }

        $totalIncome = $transactions->where('type', 1)->sum('amount');
        $totalExpenses = $transactions->where('type', 0)->sum('amount');
        $transactions->each(function ($transaction){
            $transaction->category_name = Category::find($transaction->category_id)->name ?? 'Uncategorized';
        });

        return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpenses'));
        
    }
}
