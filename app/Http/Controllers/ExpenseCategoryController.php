<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense_category;

class ExpenseCategoryController extends Controller
{
    
    public function index()
    {
        $expense = Expense_category::get();
        return view('admin.expense_category.index',compact('expense')); 
        
    }

    
    public function create()
    {
        return view('admin.expense_category.create');
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required'
        ]);
        Expense_category::create($request->all());
        return redirect()->route('expensecat.index');
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
         $expense_category =Expense_category::find($id);
          return view('admin.expense_category.edit')->with('expense_category', $expense_category);
    }

    
    public function update(Request $request, $id)
    {
           $request->validate([
            'name'=>'required'
        ]);
           
        $expense_category = Expense_category::find($id);
        $input = $request->all();
        $expense_category->update($input);
       return redirect()->route('expensecat.index');
    }

    
    public function destroy($id)
    {
        Expense_category::destroy($id);
         return redirect()->route('expensecat.index');
    }
}
