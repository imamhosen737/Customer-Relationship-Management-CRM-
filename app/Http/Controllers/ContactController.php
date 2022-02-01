<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\customers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contact::get();
        return view('admin.contact.contacts_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = customers::get();
        return view('admin.contact.add_contact', compact('data'));
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
            'name' => 'required',
            'email' => 'required|Unique:users',
            'phone' => 'required',
            'address' => 'required'
        ]);
        Contact::create($request->all());
        return redirect()->route('contacts.index');
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
        $data = customers::get();
        $con = Contact::find($id);
        return view('admin.contact.contact_edit', compact('data', 'con'));
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
        // dd($request->all());            
        $request->validate([
            'customer_id' => 'required',
            'name' => 'required',
            'email' => 'required|Unique:users',
            'phone' => 'required',
            'address' => 'required'
        ]);
        // Contact::find($id)->update($request->all());
        $c = Contact::find($id);
        $c->name = $request->name;
        $c->email = $request->email;
        $c->phone = $request->phone;
        $c->address = $request->address;
        $c->update();
        return redirect()->route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect()->route('contacts.index');
    }
}
