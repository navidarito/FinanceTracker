<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        // Logic to display categories
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function showAddCategoryForm()
    {
        // Logic to show the form for adding a new category
        return view('categories.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
           
        ]);


        Category::create($validated);

        return redirect('/categories')->with('success', 'Category added successfully!');
    }

}
