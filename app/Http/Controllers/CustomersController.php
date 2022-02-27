<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Contact;
use App\Models\Project;
use App\Models\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Unique;


class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = customers::get();
        return view('admin.customer.customers_list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.add_customer');
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
            'name' => 'required',
            'company_name' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png|max:2048',
            'phone' => 'required',
            'address' => 'required',
            'vat_number' => 'required',
            'email' => 'required|Unique:users',
            'password' => 'required|min:8',
            'status' => 'required',
        ]);

        $userData['name'] = $request->name;
        $userData['email'] = $request->email;
        $userData['password'] = bcrypt($request->password);
        $userData['role'] = 'customer';
        $userData['status'] = $request->status;
        $userData['department_id'] = '1';

        $c = User::create($userData);

        $photoName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('assets/images/customers'), $photoName);
        $customerData['user_id'] = $c->id;
        $customerData['company_name'] = $request->company_name;
        $customerData['photo'] = $photoName;
        $customerData['phone'] = $request->phone;
        $customerData['address'] = $request->address;
        $customerData['vat_number'] = $request->vat_number;

        customers::create($customerData);

        return redirect()->route('customers.index');
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
        $data = customers::find($id);
        return view('admin.customer.customer_edit', compact('data'));
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
            'name' => 'required',
            'company_name' => 'required',
            'photo' => 'mimes:jpg,jpeg,png|max:2048',
            'phone' => 'required',
            'address' => 'required',
            'vat_number' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'status' => 'required',
        ]);

        $userData['name'] = $request->name;
        $userData['email'] = $request->email;
        $userData['password'] = bcrypt($request->password);
        $userData['status'] = $request->status;

        $userId = customers::find($id)->user_id;
        User::find($userId)->update($userData);

        $customerData['company_name'] = $request->company_name;
        $customerData['phone'] = $request->phone;
        $customerData['address'] = $request->address;
        $customerData['vat_number'] = $request->vat_number;

        if (isset($request->photo)) {
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('assets/images/customers'), $photoName);
            $customerData['photo'] = $photoName;
            $del = 'assets/images/customers/' . customers::find($id)->photo;
            File::delete(public_path($del));
        }

        customers::find($id)->update($customerData);

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = 'assets/images/customers/' . user::find($id)->customers->photo;
        File::delete(public_path($del));
        User::find($id)->delete();
        return redirect()->route('customers.index');
    }

    public function details($id)
    {
        $data = customers::find($id);
        $dataCon = Contact::where('customer_id', $id)->get();
        return view('admin.customer.customer_details', compact('data', 'dataCon'));
    }

    public function gantt($id)
    {
        // dd($id);
        $project = Project::where('id', $id)->first();
        $p_id = $project->id;

        $start_date = $project->start_date;
        // dd($start_date);
        $date1 = new DateTime($project->start_date);
        $date2 = new DateTime($project->end_date);
        $interval = $date1->diff($date2);
        $days=$interval->days;
        return view('admin.gantt', compact('p_id','start_date','days'));
    }
}
