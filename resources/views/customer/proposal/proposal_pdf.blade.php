<table border="1" align="left" width="100%">
   <tr>
       <td valign="top">

            Customer Name: {{ $proposalItem->customer->user->name }} <br>
            Proposal Topic: {{ $proposalItem->subject }} <br>
            Date: {{ $proposalItem->date }} <br>
            Due Date: {{ $proposalItem->due_date }} <br>
            Status: {{$proposalItem->status}}

        </td>
        <td valign="top">
            <strong>Proposal Information </strong><br>
            Company Name: {{$proposalItem->customer->company_name}}<br>
            Address: {{$proposalItem->customer->address}} <br>
            Phone: {{$proposalItem->customer->phone}} <br>
            City: {{$proposalItem->customer->city ? $proposalItem->customer->city : 'NA'}} <br>
            Country: {{$proposalItem->customer->country ? $proposalItem->customer->country: 'NA'}} <br>
            Zip: {{$proposalItem->customer->zip ? $proposalItem->customer->zip : 'NA'}} <br>
            Vat Number: {{$proposalItem->customer->vat_number ?$proposalItem->customer->vat_number : 'Not Applicable'}}
        </td>
   </tr>
</table>

<br>



<table border="1" width="100%" align="center" cellspacing="0" cellpadding="0">
   <thead style="background: blue">
        <tr>
            <th >#</th>
            <th >Item Name</th>
            <th >Unit</th>
            <th >Tax</th>
            <th >Quantity</th>
            <th >Price</th>
            <th >Total Amount</th>
        </tr>
    </thead>
   <tbody>
                        @php
                            $sum = 0;
                            $tax = 0;
                            $totalSum = 0;
                        @endphp
                        @forelse ($proposalItem->items as $item)

                            @php
                                $sum += $item->quantity * $item->price;
                            @endphp

                            @php $taxFix = $item->item->tax->rules ?? 0 ;  @endphp


                           @php
                           $totalSum += ($item->price*$item->quantity) + (($item->price*$item->quantity)*$taxFix/100);
                           $tax += ($item->price*$item->quantity)*$taxFix/100;
                           @endphp


                            <tr style="text-align: center">
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->item->name }}</td>
                                <td>{{ $item->item->unit->unit_name }}</td>
                                <td>
                                    {{ $item->item->tax->rules ?? '0'}}
                                </td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->price*$item->quantity}}</td>
                            </tr>
                        @empty
                        @endforelse

                        <tr>
                            <td colspan="6" style="text-align: right;"><strong>Sub Total</strong></td>
                            <td><strong>{{$sum}}</strong></td>
                        </tr>

                        <tr>
                            <td colspan="6" style="text-align: right;"><strong>Tax</strong></td>
                            <td><strong>{{ $tax}}</strong></td>
                        </tr>

                        <tr>
                            <td colspan="6" style="text-align: right;"><strong>Total</strong></td>
                            <td><strong>{{$totalSum}}</strong></td>
                        </tr>

                    </tbody>
</table>
<br>
<table>
    <tr>
        <th>
            <strong>Signeture</strong>
            <hr>
        </th>
    </tr>
    <tr>
        <td>
            <p>
                @if ($proposalItem->sign)
                    <img src="{{ $proposalItem->sign }}" alt="sign" width="200px" height="100px">
                @endif

                
            </p>
        </td>
    </tr>
</table>
