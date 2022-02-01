<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Estimate;
use App\Models\customers;
use App\Models\EstimateItems;
use App\Models\EstimateUser;
use Illuminate\Http\Request;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $C_id=auth()->user()->customers->id;
        // dd($a);
        // exit;
        $estimate= Estimate::where('customer_id', $C_id)->get();
        
        return view('customer.estimate.estimate_list', compact('estimate'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estimate= Estimate::find($id);
        $estimate_user= EstimateUser::where('estimate_id',$id)->get();
        $estimate_items= EstimateItems::where('estimate_id',$id)->get();
        $estimate_user_count=count($estimate_user);
        return view('customers.estimate.estimate_view',compact('estimate', 'estimate_user','estimate_items','estimate_user_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function accept(Request $request, $id)
    {
        Estimate::find($id)->update(['status' => 'accepted']);
        Estimate::find($id)->update(['sign' => $request->sign]);
        return redirect()->route('cm_estimate', $id);
    }
    public function reject(Request $request, $id)
    {
        Estimate::find($id)->update(['status' => 'declined']);
        Estimate::find($id)->update(['sign' => $request->sign]);
        return redirect()->route('cm_estimate', $id);
    }
}
