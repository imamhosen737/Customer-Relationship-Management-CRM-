
@extends('layouts.app')
@section('page_title')
View Customer Info
@endsection

@section('content')

<div class="container wrapper">
   <div class="row">
      <div class="col-md-12">
         <div class="card mb-3" >
            <div class="row g-0">
                    <div class="col-md-4">
                      <img src="/images/customer/{{$customerInfo->photo}}" style="width:100%;height:auto" class=" rounded-start" >
                    </div>
                    <div class="col-md-8">
                    <div class="card-body customer-view">
                        <h5 class="card-title mb-0 d-block" >{{$customerInfo->user->name}}</h5>

                        <span class="card-text mb-0 d-flex">
                          Company Name:  {{ $customerInfo->company_name }}  </span>
                        <span class="card-text mb-0 d-flex">
                          Phone:  {{ $customerInfo->phone }}  </span>
                        <span class="card-text mb-0 d-flex">
                          Address:  {!! $customerInfo->address !!}  </span>

                          <span class="card-text mb-0 d-flex">
                          City:  {{ $customerInfo->city }}  </span>
                          <span class="card-text mb-0 d-flex">
                          Zip:  {{ $customerInfo->zip }}  </span>
                          <span class="card-text mb-0 d-flex">
                          Country:  {{ $customerInfo->country }}  </span>

                          <span class="card-text mb-0 d-flex">
                          Vat Number:
                               {{$customerInfo->vat_number ?? 'Not Applicable'}}
                          </span>
                    </div>
                </div>
            </div>
            </div>
      </div>


      <div class="backPrevious">
          <a href="{{route('customer.index')}}" class="btn btn-primary" >Back To Previous</a>
      </div>
   </div>
</div>
@endsection
