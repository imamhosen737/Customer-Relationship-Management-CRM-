<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateItems;
use App\Models\EstimateUser;
use App\Models\Item;
use App\Models\Tax;
use App\Models\User;
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
        $data = Estimate::get();
        return view('admin.estimates.estimate_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::get();
        $itemm = Item::get();
        $data = Estimate::get();
        $customer = Customer::get();
        return view('admin.estimates.add_estimate', compact('customer', 'data', 'itemm', 'user'));
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
            'customer_id' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'due_date' => 'required',
            'user_id' => 'required'
        ]);
        // Estimate::create($request->all());

        $estimate['customer_id'] = $request->customer_id;
        $estimate['subject'] = $request->subject;
        $estimate['date'] = $request->date;
        $estimate['due_date'] = $request->due_date;
        $estimate['status'] = 'sent';
        $eid = Estimate::create($estimate);

        $estimate_item = new EstimateItems;

        foreach ($request->item_id as $k => $id) {
            $item['estimate_id'] = $eid->id;
            $item['item_id'] = $id;
            $item['price'] = $request->price[$k];
            $item['qty'] = $request->qty[$k];
            // echo "<pre>";
            // print_r($item);
            EstimateItems::create($item);
        }

        foreach ($request->user_id as $k => $id) {
            $item_user['estimate_id'] = $eid->id;
            $item_user['user_id'] = $id;
            EstimateUser::create($item_user);
        }


        return redirect()->route('estimate.index');
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
        $itemm = Item::find($id);
        $user = User::get();
        $data = Estimate::find($id);
        $customer = Customer::get();
        return view('admin.estimates.edit_estimate', compact('data', 'customer', 'user', 'itemm'));
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
            'customer_id' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'due_date' => 'required'
        ]);

        Estimate::find($id)->update($request->all());
        return redirect()->route('estimate.index');

        // $estimate['customer_id'] = $request->customer_id;
        // $estimate['subject'] = $request->subject;
        // $estimate['date'] = $request->date;
        // $estimate['due_date'] = $request->due_date;
        // $estimate['status'] = 'sent';
        // $eid = Estimate::create($estimate);

        // foreach ($request->item_id as $k => $id) {
        //     $item['estimate_id'] = $eid->id;
        //     $item['item_id'] = $id;
        //     $item['price'] = $request->price[$k];
        //     $item['qty'] = $request->qty[$k];
        //     EstimateItems::create($item);
        // }

        // foreach ($request->user_id as $k => $id) {
        //     $item_user['estimate_id'] = $eid->id;
        //     $item_user['user_id'] = $id;
        //     EstimateUser::create($item_user);
        // }
        // return redirect()->route('estimate.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Estimate::find($id);
        $data->delete();
        return redirect()->route('estimate.index');
    }
    public function getItem($id)
    {
        $data = Item::find($id);
        $product['id'] = $data->id;
        $product['name'] = $data->name;
        $product['rate'] = $data->rate;
        $product['rate'] = $data->rate;
        $product['tax'] = $data->tax->rules;
        return response()->json($product);
    }
}
