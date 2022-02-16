<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\Item;
use App\Models\User;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateUser;
use Illuminate\Http\Request;
use App\Models\EstimateItems;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\EstimateMail;

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
        $user = User::where('role', 'customer')->get();
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
            EstimateItems::create($item);
        }

        foreach ($request->user_id as $k => $id) {
            $item_user['estimate_id'] = $eid->id;
            $item_user['user_id'] = $id;
            EstimateUser::create($item_user);
        }


        $details = [
            'title' => 'Mail from CRM project',
            'body' => 'This is for testing mail using sendinblue'
        ];

        // Mail::to('imamhosen737@gmail.com')->send($details);
        // \Mail::raw('plain text message', function ($message) {
        //     $message->from('john@johndoe.com', 'John Doe');
        //     $message->sender('john@johndoe.com', 'John Doe');
        //     $message->to('john@johndoe.com', 'John Doe');
        // });

        // $mail = Customer::find($request->customer_id)->user->email;
        // Mail::to($mail)->send(new EstimateMail($details));
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
        $data = Estimate::find($id);
        $est_item = EstimateItems::where('estimate_id', $id)->get();
        return view('admin.estimates.estimate_details', compact('data', 'est_item'));
    }


    public function printToPdf($id)
    {

        // return "ok";
        // $contact = proposal::find($id);
        // $ProposalItem = ProposalItem::where('proposal_id',$id)->get();
        // $pdf = \PDF::loadView('admin.proposals.download',compact('contact','ProposalItem'));
        //  return $pdf->download();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemm = Item::get();
        $user = User::where('role', 'customer')->get();
        $customer = Customer::get();
        $data = Estimate::find($id);
        $edit_item = EstimateItems::where('estimate_id', $id)->get();
        $edit_user = EstimateUser::where('estimate_id', $id)->get();
        return view('admin.estimates.edit_estimate', compact('data', 'user', 'itemm', 'edit_item', 'customer', 'edit_user'));
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


        EstimateItems::where('estimate_id', $id)->delete();
        EstimateUser::where('estimate_id', $id)->delete();

        $estimate['customer_id'] = $request->customer_id;
        $estimate['subject'] = $request->subject;
        $estimate['date'] = $request->date;
        $estimate['due_date'] = $request->due_date;
        $estimate['status'] = 'sent';
        Estimate::find($id)->update($estimate);

        foreach ($request->item_id as $k => $est_item_id) {
            $item['estimate_id'] = $id;
            $item['item_id'] = $est_item_id;
            $item['price'] = $request->price[$k];
            $item['qty'] = $request->qty[$k];
            EstimateItems::create($item);
        }

        foreach ($request->user_id as $k => $est_user_id) {
            $item_user['estimate_id'] = $id;
            $item_user['user_id'] = $est_user_id;
            EstimateUser::create($item_user);
        }

        return redirect()->route('estimate.index');
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
