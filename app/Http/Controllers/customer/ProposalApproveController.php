<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\ProposalItem;

class ProposalApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $proposals = Proposal::loadRelation()
            ->where('customer_id', auth()->user()->customer->id)
            ->get();
        // return $proposalItems[0]->proposal->customer->user->name;
        return view('customer.proposal.proposal_approve', compact('proposals'));
    }


    public function view()
    {
        // echo "ok";
        // dd(auth()->user()->customers->id);

        $pending = Proposal::loadRelation()
            ->where('customer_id', auth()->user()->customers->id)
            ->where('status', 'sent')
            ->get();

        // dd($pending);
        return view('customer.proposal.pending_proposal', compact('pending'));
    }


    public function approved()
    {
        $data = Proposal::loadRelation()
            ->where('customer_id', auth()->user()->customers->id)
            ->where('status', 'sent')
            ->get();
        return view('customer.proposal.accepted_proposal', compact('data'));
    }

    public function declined()
    {
        $data = Proposal::loadRelation()
            ->where('customer_id', auth()->user()->customers->id)
            ->where('status', 'sent')
            ->get();
        return view('customer.proposal.declined_proposal', compact('data'));
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
        try {
            if ($request->length <= 1858) {
                throw new \Exception('Please enter your signature');
            }
            $proposal = Proposal::find($request->id);
            if ($proposal) {
                $proposal->update([
                    'status' => 'accepted',
                    'sign' => $request->sign_text,
                ]);
                return response()->json(['status' => 'success', 'message' => 'Accepted Successfully !']);
            }
            return response()->json(['status' => 'error', 'message' =>  'Accept Failed !']);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['status' => 'error', 'message' =>  'Accept Failed !']);
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
        $proposalItem = Proposal::loadRelation()
            ->where('id', $id)
            ->first();
        // dd($proposalItem);
        return view('customer.proposal.proposal_approve_single', compact('proposalItem'));
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
            $proposal = Proposal::find($id);
            if ($proposal) {
                $proposal->update([
                    'status' => 'declined',
                ]);
                return response()->json(['status' => 'success', 'message' => 'Rejected Successfully !']);
            }
            return response()->json(['status' => 'error', 'message' =>  'Reject Failed !']);
        } catch (\Exception $e) {

            return $e;
            return response()->json(['status' => 'error', 'message' =>  'Reject Failed !']);
        }
    }

    public function printToPdf($id)
    {

        $proposalItem = Proposal::loadRelation()
            ->where('id', $id)
            ->first();

        $pdf = \PDF::loadView('customer.proposal.proposal_pdf', compact('proposalItem'));
        return $pdf->download();
    }
}
