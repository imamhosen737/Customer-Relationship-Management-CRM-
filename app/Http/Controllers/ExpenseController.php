<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Expense_category;
use Session;

class ExpenseController extends Controller
{
  
  // resource
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Expense::get();
        return view('admin.expense.show_expense', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = Project::get();
        $expenseCategory = Expense_category::get();
        return view('admin.expense.add_expense', compact('project', 'expenseCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:10',
            'note'=>'required',
            'expense_date'=>'required',
            'amount'=>'required',
            'project_id' => 'required',
            'expenseCategory_id' => 'required',
        ]);
        Expense::create($request->all());
        return redirect()->route('expense.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Expense::find($id);
        $project = Project::get();
        $expenseCategory = Expense_category::get();
        
        return view('admin.expense.edit_expense', compact('data', 'project', 'expenseCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:10',
            'note'=>'required',
            'expense_date'=>'required',
            'amount'=>'required',
            // 'tax_id' => 'required',
            // 'unit_id' => 'required',
        ]);
        Expense::find($id)->update($request->all());
        return redirect()->route('expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $data = Expense::find($id);
        $data->delete();
        return redirect()->route('expense.index');
    }
}

