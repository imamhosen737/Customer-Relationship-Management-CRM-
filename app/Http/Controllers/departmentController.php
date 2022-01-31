<?php
 
namespace App\Http\Controllers;
use App\Models\Departments;
use Illuminate\Http\Request;
 
class departmentController extends Controller
{
  
    public function index()
    {
        $contacts = Departments::all();
      return view ('admin.departments.index')->with('contacts', $contacts);
    }
 
    
    public function create()
    {
        return view('admin.departments.create');
    }
 
  
    public function store(Request $request)
    {
        $request->validate([
       'name' => 'required',]);
        $input = $request->all();
        Departments::create($input);
        return redirect('admin/department')->with('success', 'Departments created successfully');  
    }
 
    
    public function show($id)
    {
        
    }
 
    
    public function edit($id)
    {
         
        $contact = Departments::find($id);
        return view('admin.departments.edit')->with('contacts', $contact);
    }
 
  
    public function update(Request $request, $id)
    {
        $request->validate([
       'name' => 'required']);

        $contact = Departments::find($id);
        $input = $request->all();
        $contact->update($input);
        return redirect('admin/department')->with('success', 'Departments updated successfully');  
    }
 
  
    public function destroy($id)
    {
        Departments::destroy($id);
        return redirect('admin/department')->with('success', ' Departments deleted successfully');  
    }
   
}
