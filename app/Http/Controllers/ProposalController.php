<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Redirect, Response;
use App\Models\proposal;
use Barryvdh\DomPDF\PDF;
use App\Models\Customers;
use App\Models\ProposalItem;
use App\Models\ProposalUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = customers::get();
        $contacts = proposal::all();
        //  dd($contacts->proposals);
        return view('admin.proposal.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contacts = customers::get();
        $data = Item::get();
        $Item = User::where('role', 'customer')->get();
        $dat = proposal::get();
        return view('admin.proposal.create', compact('contacts', 'data', 'Item', 'dat'));
    }


    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'customer_id' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'due_date' => 'required',
            'user_id' => 'required'
        ]);

        $proposal['customer_id'] = $request->customer_id;
        $proposal['subject'] = $request->subject;
        $proposal['date'] = $request->date;
        $proposal['due_date'] = $request->due_date;
        $proposal['status'] = 'sent';
        $pro = proposal::create($proposal);

        $proposal_item = new ProposalItem;

        foreach ($request->item_id as $k => $id) {
            $item['proposal_id'] = $pro->id;
            $item['item_id'] = $id;
            $item['price'] = $request->price[$k];
            $item['qty'] = $request->qty[$k];
            ProposalItem::create($item);
        }

        foreach ($request->user_id as $k => $id) {
            $item_user['proposal_id'] = $pro->id;
            $item_user['user_id'] = $id;
            ProposalUser::create($item_user);
        }


        // $input = $request->all();
        // proposal::create($input);
        // dd($input);
        return redirect('admin/proposal')->with('success', 'proposals created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $contacts = proposal::find($id);
        // $ProposalItem = ProposalItem::where('proposal_id', $id)->get();
        return view('admin.proposal.show', compact('contacts'));
    }
    public function printToPdf($id)
    {

        // return "ok";
        $contact = proposal::find($id);
        $ProposalItem = ProposalItem::where('proposal_id', $id)->get();
        $pdf = \PDF::loadView('admin.proposal.download', compact('contact', 'ProposalItem'));
        return $pdf->download();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $contacts = proposal::find($id);
        $user = User::where('role', 'user')->get();
        $item = Item::get();
        $customers = Customers::get();
        $ProposalItem = ProposalItem::where('proposal_id', $id)->get();
        $edit_user = ProposalUser::where('proposal_id', $id)->get();

        // dd($ProposalItem);
        // exit;
        return view('admin.proposal.edit', compact('contacts', 'customers', 'item', 'user', 'ProposalItem', 'edit_user'));
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
        // dd($request);
        // exit;
        ProposalItem::where('proposal_id', $id)->delete();
        ProposalUser::where('proposal_id', $id)->delete();


        $proposal['customer_id'] = $request->customer_id;
        $proposal['subject'] = $request->subject;
        $proposal['date'] = $request->date;
        $proposal['due_date'] = $request->due_date;
        $proposal['status'] = 'sent';
        Proposal::find($id)->update($proposal);

        foreach ($request->item_id as $k => $est_item_id) {
            $item['proposal_id'] = $id;
            $item['item_id'] = $est_item_id;
            $item['price'] = $request->price[$k];
            $item['qty'] = $request->qty[$k];
            ProposalItem::create($item);
        }

        foreach ($request->user_id as $k => $est_user_id) {
            $item_user['proposal_id'] = $id;
            $item_user['user_id'] = $est_user_id;
            ProposalUser::create($item_user);
        }

        return redirect('admin/proposal')->with('success', 'proposals updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = proposal::find($id);
        $data->delete();
        return redirect('admin/proposal')->with('success', ' proposals deleted successfully');
    }

    public function getPrice($id)
    {
        $item = Item::find($id);
        //   $getPrice = Item::get();
        //   dd(json_encode($getPrice));
        //   exit;
        //   $price  = DB::table('items')->where('id', $getPrice)->get();
        $data['id'] = $item->id;
        $data['name'] = $item->name;
        $data['rate'] = $item->rate;
        $data['description'] = $item->description;
        $data['tax'] = $item->tax->rules;
        $data['qty'] = 1;
        return json_encode($data);
    }
}
