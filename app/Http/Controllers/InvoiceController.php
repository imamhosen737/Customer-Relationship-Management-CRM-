<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Invoice;
use App\Models\customers;
use Illuminate\Http\Request;
use App\Models\EstimateItems;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('customer', 'items', 'customer.user', 'items.unit', 'items.tax')
            ->orderBy('invoice_number', 'desc')
            ->get(['invoice_number',  'customer_id', 'item_id',   'invoice_type', 'due_date', 'date', 'interval', 'price', 'qty', 'tax', 'total', 'discount', 'payable', 'status'])
            ->groupBy('invoice_number')
            ->map(function ($invoice) {
                $data = new \stdClass();
                $data->invoice_number = $invoice[0]->invoice_number;
                $data->customer = $invoice[0]->customer->user->name;
                $data->total = $invoice->sum('total');
                $data->status = $invoice[0]->status;
                $data->date = $invoice[0]->date;
                $data->due_date = $invoice[0]->due_date;
                return $data;
            });




        return view('admin.invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoiceNumber = Invoice::orderBy('invoice_number', 'desc')->first();
        if ($invoiceNumber) {
            $new = $invoiceNumber->invoice_number;
            $onlyId = $new + 1;
            $newId = str_repeat('0', (strlen($new) - strlen($onlyId))) . $onlyId;
        } else {
            $newId = '000001';
        }


        $Item = Item::with('unit', 'tax')
            ->get();
        $all_customers = customers::with('user')->get()->where('user.role', 'customer');


        $due_date = date('Y-m-d', strtotime('+3 day'));

        return view('admin.invoice.create', compact('all_customers', 'Item', 'newId', 'due_date'));
    }


    public function estimate_invoice($customer_id,$id)
    {
        $invoiceNumber = Invoice::orderBy('invoice_number', 'desc')->first();
        if ($invoiceNumber) {
            $new = $invoiceNumber->invoice_number;
            $onlyId = $new + 1;
            $newId = str_repeat('0', (strlen($new) - strlen($onlyId))) . $onlyId;
        } else {
            $newId = '000001';
        }
        $est_item = EstimateItems::where('estimate_id', $id)->get();
        // dd($est_item);
        $customer = customers::where('id', $customer_id)->first();
        $itemm = Item::get();
        $Item = Item::with('unit', 'tax')
            ->get();

        $due_date = date('Y-m-d', strtotime('+3 day'));
        return view('admin.estimates.invoice', compact('customer', 'itemm', 'Item','est_item', 'newId', 'due_date'));
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
            'invoice_type' => 'required'
        ]);
        try {
            $invoice['invoice_number'] = $request->invoice_no;
            $invoice['customer_id'] = $request->customer_id;
            $invoice['invoice_type'] = $request->invoice_type;
            $invoice['date'] = $request->invoice_date;
            $invoice['due_date'] = $request->due_date;
            $invoice['interval'] = $request->recurring;
            $invoice['payable'] = $request->grandTotal;

            foreach ($request->item_id as $k => $value) {
                $invoice['item_id'] = $value;
                $invoice['price'] = $request->rate[$k];
                $invoice['qty'] = $request->qty[$k];
                $invoice['tax'] = $request->tax[$k];
                $invoice['total'] = $request->amount[$k];
                $invoice['discount'] = $request->discount[$k];
                Invoice::create($invoice);
            }


            return redirect()->route('invoice.create')->with('success', 'Invoice Created Successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->route('invoice.index')->with('error', 'Something went wrong');
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

        $invoices = Invoice::with('customer', 'items', 'customer.user', 'items.unit', 'items.tax')
            ->where('invoice_number', $id)
            ->get();

        $payable = $invoices[0]->payable;


        return view('admin.invoice.show', compact('invoices', 'payable'));
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
        try {
            $invoices = Invoice::where('invoice_number', $id)
                ->get();
            if ($invoices) {
                $invoices->each(function ($item, $key) {
                    $item->delete();
                });
                return response()->json(['status' => 'success', 'message' => 'Invoice Deleted Successfully !']);
            }
            return response()->json(['status' => 'error', 'message' =>  'Deleted Failed !']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Delete failed']);
        }
    }

    public function mail_send($id)
    {

        $details = Invoice::with('customer', 'items', 'customer.user', 'items.unit', 'items.tax')
            ->where('invoice_number', $id)
            ->get();
        $user = $details[0]->customer->user->email;

        \Mail::to("$user")->send(new \App\Mail\InvoiceMail($details));
        return redirect()->back()->with('success', 'Mail Sent Successfully');
    }
}
