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
        // Logic to display budgets
        $month = date('n');
        $budgets = Budget::where('user_id', auth()->id())->whereMonth('start_date',$month)->orderBy('created_at','ASC')->get();
        //dd($budgets);
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
        // Logic to show the form for adding a new budget
        $categories = Category::all();
        return view('budget.add', compact('categories'));
    }

    public function store(Request $request)
    {
        // Logic to store a new budget
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
            //dd($budgets);
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
}
