<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\User;



class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customerInfo = Customers::with('User')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('customer.customer_info.index', compact('customerInfo'));

    }

    public function show($id)
    {
        $customerInfo = Customers::with('User')
            ->where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();
        return view('customer.customer_info.show', compact('customerInfo'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customers::find($id);
        return view('customer.customer_info.edit', compact('customers'));
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
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'photo' => 'mimes:jpeg,jpg,png,gif|max:1024',
        ]);

        try {

            $customers = Customers::find($id);
            $customers->company_name = $request->company_name;
            $customers->phone = $request->phone;
            $customers->vat_number = $request->vat_number;
            $customers->address = $request->address;
            $customers->city = $request->city;
            $customers->zip = $request->zip;
            $customers->country = $request->country;


            if ($customers->save()) {
                // return $customers;
                $customers->user->name = $request->name;
                $customers->user->save();

                if ($request->hasFile('photo')) {
                    $image = $request->file('photo');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/customer'), $imageName);

                    if (file_exists(public_path('images/customer/' . $imageName))) {
                        if ($customers->photo && file_exists(public_path('images/customer/' . $customers->photo))) {
                            unlink(public_path('images/customer/' . $customers->photo));
                        }
                    }

                    $customers->photo = $imageName;
                    $customers->save();
                }

                return redirect()->route('customer.index')->with('success', 'Customer Updated Successfully');
            }
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
