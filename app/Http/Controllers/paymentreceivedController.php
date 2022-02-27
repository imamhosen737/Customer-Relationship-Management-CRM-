<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Customers;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Invoice;
use Illuminate\Http\Request;

class paymentreceivedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment = user::where('role', 'admin')->get();
        $payment = Payment::all();
        // $payment = Payment::with('invoice', 'user' ,'paymentMethod')
        //    ->where('user.role',  'admin')
        //    ->get();
        // dd($payment);
        // $Customers = Customers::all();
        // $user=User::where('role', 'admin')->get();
        // $paymentmethod=PaymentMethod::all();
        // $invoice=Invoice::all();
        return view('admin.payments.paymentreceived', compact('payment'));
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
}
