<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {

        $month = date('n');
        $budgets = Budget::where('user_id', auth()->id())->whereMonth('start_date',$month)->orderBy('created_at','ASC')->get();
        $budgets->each(function ($budget) {
            $budget->category_name = Category::find($budget->category_id)->name ?? 'Uncategorized';
        });
        $totalBudget = $budgets->sum('amount');
        $totalExpenses = Transaction::where('user_id', auth()->id())
            ->whereMonth('happened_on', date('n'))
            ->where('type', 0)
            ->sum('amount');

        $totalExpenses = number_format($totalExpenses);
        return view('budget.index', compact('budgets', 'totalBudget', 'totalExpenses'));
    }

    public function showAddBudgetForm()
    {

        $categories = Category::all();
        return view('budget.add', compact('categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'description' => 'string|max:1000',
            'amount' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'start_date' => 'required',
            'end_date' => 'required',
            'category_id' => 'required',
        ]);

        $validated['user_id'] = auth()->id();
        Budget::create($validated);
    

        return redirect()->route('budget.index')->with('success', 'Budget created successfully.');
    }

    public function filter(Request $request){
        

        if($request->start_date == null || $request->end_date == null){
           return redirect()->route('budget.index')->with('error', 'Please select a valid date range.');
        }else {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $transactions = Transaction::where('user_id', auth()->id())
                ->whereBetween('happened_on', [$start_date, $end_date])
                ->get();

        
            $budgets = Budget::where('user_id', auth()->id())
                ->where('start_date', '>=', $start_date)
                ->where('end_date', '<=', $end_date)
                ->orderBy('created_at','ASC')
                ->get();
        
        }
        $totalIncome = $transactions->where('type', 1)->sum('amount');
        $totalExpenses = $transactions->where('type', 0)->sum('amount');
        $totalExpenses = number_format($totalExpenses);
        $budgets->each(function ($budget) {
            $budget->category_name = Category::find($budget->category_id)->name ?? 'Uncategorized';

        });
        $totalBudget = $budgets->sum('amount');

        return view('budget.index', compact('budgets', 'totalBudget', 'totalExpenses'));
    }

    public function showReport(){

        $categories = Category::all();
        $report = 0;

        return view('budget.report', compact('categories','report'));

    }

    public function report(Request $request){
        if($request->start_date == null || $request->end_date == null){
         
            
            return redirect()->route('budget.showReport')->with('error', 'Please select a valid date range.');
        }else {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $transaction = Transaction::where('user_id', auth()->id())
                ->whereBetween('happened_on', [$start_date, $end_date])
                ->where('category_id', $request->category_id)
                ->orderBy('happened_on','ASC')
                ->get();

            $budgets = Budget::where('user_id', auth()->id())
                ->where('start_date', '>=', $start_date)
                ->where('end_date', '<=', $end_date)
                ->where('category_id', $request->category_id)
                ->orderBy('created_at','ASC')
                ->get();

            $totalBudget = $budgets->sum('amount');
            

            $totalIncome = $transaction->where('type', 1)->sum('amount');
            $totalExpenses = $transaction->where('type', 0)->sum('amount');
            $transaction->each(function ($transaction){
                $transaction->category_name = Category::find($transaction->category_id)->name ?? 'Uncategorized';
            });
            $category_name = Category::find($request->category_id)->name;

            $report = 1;

            
            $categories = Category::all();
          

            return view('budget.report', compact('report', 'totalIncome', 'totalExpenses', 'categories','transaction', 'totalBudget','budgets','category_name'));
        }



    }
}
