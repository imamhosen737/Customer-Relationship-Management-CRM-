<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\User;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Payment::all();
        return view('admin.payments.payment_receive', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = Invoice::all();
        $users = User::whereIn('role',['admin'])->get();
        $payment_methods = PaymentMethod::all();
        return view('admin.payments.create', compact('invoices', 'users', 'payment_methods')); 
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
            'invoice_id'=>'required|',
            'user_id'=>'required|',
            'paymentMethod_id'=>'required|',
            'amount'=>'required|numeric|'
        ]);


    try{
            $Payments = new Payment(); 
            $Payments->invoice_id = $request->invoice_id;
            $Payments->user_id  = $request->user_id ;
            $Payments->paymentMethod_id = $request->paymentMethod_id  ;
            $Payments->amount   = $request->amount  ;
            $Payments->save();
            return redirect('admin/payments')->with('Payment Successfully!');
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
        $invoices = Invoice::all();
        $users = User::whereIn('role',['admin'])->get();
        $payment_methods = PaymentMethod::all();
        $datas = Payment::find($id);
        return view('admin.payments.edit',compact('datas', 'invoices', 'users', 'payment_methods'));
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
            'invoice_id'=>'required|',
            'user_id'=>'required|',
            'paymentMethod_id'=>'required|',
            'amount'=>'required|numeric|'
        ]);

        $datas = Payment::find($id);
        $input = $request->all();
        $datas->update($input);
        return redirect('admin/payments')->with('Flash_message','Payment Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Payment::find($id);
        $data->delete();
        return redirect('admin/payments')->with('Flash_message','Payment Deleted!');
    }
}
