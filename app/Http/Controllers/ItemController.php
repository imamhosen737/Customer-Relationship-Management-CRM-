<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Tax;
use App\Models\Unit;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Item::get();
        return view('admin.items.list_item', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = Unit::get();
        $tax = Tax::get();
        return view('admin.items.add_item', compact('unit', 'tax'));
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
            'name' => 'required|max:255',
            'description' => 'required',
            'rate' => 'required|max:6',
            'tax_id' => 'required',
            'unit_id' => 'required',
        ]);
        Item::create($request->all());
        return redirect()->route('item.index');
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
        $unit = Unit::get();
        $tax = Tax::get();
        $data = Item::find($id);
        // dd($data);
        return view('admin.items.edit_item', compact('data', 'unit', 'tax'));
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
            'name' => 'required|max:255',
            'description' => 'required',
            'rate' => 'required|max:6',
            // 'tax_id' => 'required',
            // 'unit_id' => 'required',
        ]);
        Item::find($id)->update($request->all());
        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $data = Item::find($id);
        $data->delete();
        return redirect()->route('item.index');
    }
}
