<?php

namespace App\Http\Controllers;
use App\Models\Tasks;
use App\Models\Timesheets;
use Illuminate\Http\Request;
use App\Http\Requests\TimesheetsRequest;

class TimesheetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $datas = Timesheets::get();
        
        
        return view('admin.Timesheets.index',compact('datas')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $Timesheetdata = Tasks::get();
        return view('admin.Timesheets.create',compact('Timesheetdata'));
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
       'note' => 'required',
       'start_time' => 'required',
       'end_time' => 'required',   
   ]);
         
         try{
            $input = $request->all();
            Timesheets::create($input);
        return redirect('admin/timesheets')->with('success', 'Timesheets created successfully');  
         }
         catch(\Exception $e){
            return $e;
         }
        
        
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
         $contacts = Timesheets::find($id);
         $Timesheetdata = Tasks::get();
        return view('admin.timesheets.edit', compact('contacts', 'Timesheetdata'));
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
         try {
            $request->validate([
                'note' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

             $datas = Timesheets::find($id);
            $input = $request->all();
            $datas->update($input);
            // return $project;
            return redirect('admin/timesheets')->with('success', 'timesheets updated successfully');
        } catch (\exception $e) {
            return $e->getMessage();
    }
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Timesheets::destroy($id);
        return redirect('admin/timesheets')->with('success', ' Timesheets deleted successfully');
    }
}
