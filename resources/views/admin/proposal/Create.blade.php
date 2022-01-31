@extends('layouts.app')
@section('page_title')
<span>Add proposal</span>
@endsection
@section('content')
<form action="{{ url('admin/proposal') }}" method="post">
                   {!! csrf_field() !!}
   <div class="form-row">
         
      
        <div class="form-group col-md-4">
            <label for="customer name">Company Name</label>
               <select  class="form-control" id="item" name='customer_id'>
                     <option value="">Select Customer</option>
                     @foreach ($contacts as $contact)
                     @if (old('customer_id')==$contact->id)
                          <option value="{{$contact->id}}" {{'selected'}}>{{$contact->company_name}}</option>
                     @else
                      <option value="{{$contact->id}}">{{$contact->company_name}}</option>
                      @endif
                      @endforeach
                     
               </select>
                 @error('customer_id')
                   <span style="color: red">{{ $message }}</span>
                @enderror
              
            </div>
           
            <div class="form-group col-md-4">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" id="" value="{{old('date')}}">
               @error('date')
                   <span style="color: red">{{ $message }}</span>
               @enderror
            </div>
            
            <div class="form-group col-md-4">           
            <label for="due_date">Due Date</label>
            <input type="date" class="form-control" name="due_date" id="" value="{{old('due_date')}}">
             @error('due_date')
                   <span style="color: red">{{ $message }}</span>
               @enderror
             </div>
            <div class="form-group col-md-6">
        
            <label for="subject">Subject</label>
            <textarea type="text"  rows="5" cols="45" class="form-control" name="subject" id=""  placeholder="Enter your subject ">{{old('subject')}}</textarea>
             @error('subject')
                   <span style="color: red">{{ $message }}</span>
               @enderror
            </div>


            <div class="form-group col-md-6"> 
             <label for="customer name">Assigned</label>
              <select  class="form-control" class='custom-select' id="item" name='user_id[]' multiple size=6>
                 <option value="">Select Item</option>
                      @foreach ($Item as $p)
                  <option value="{{$p->id}}">{{$p->name}}</option>
                     @endforeach
              </select> 
            </div>
            
           </div>

{{-- </div> --}}

  <section class="mt-3">
    <div class="container wrapper">
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
                 
                  <thead>
                     <tr>
                        
                        <th>Add Items</th> </tr>
                  </thead>
                  
                     <tr>
                       
                        <td style="width:60%">
                        {{-- {{dd($data)}} --}}
                           <select name="" onchange="get_product(this.value)"  class="form-control">
                              <option value="0">Select Item</option>
                             @foreach($data as $row )
                              <option value={{$row->id}} >
                                {{$row->name}}
                              </option>
                             @endforeach
                           </select>
                        </td>
                       
                     </tr>
                     <tr>
                     </tr>    
                  
                 
               </table>
               <div role="alert" id="errorMsg" class="mt-5" >
                 <!-- Error msg  -->
              </div>
            </div>
            <div class="" style="background-color:#f5f5f5;">
               <div class="row">
                     </span>
                     <table id="mytable" class="table">
                        <thead>
                         <th>Name</th>
                         <th></th>
                         <th>Rate</th>
                         <th>Qty</th>
                         <th>Tax</th>
                         <th>Total</th>
                         <th>Action</th>
                        </thead>
                        <tbody id="kk">
                           
                        </tbody>
                        <div class='col-md-offset-10'>
                        <tr>
                          
                           <td class="text-right ">Total:
                              <h5 class="sub_total"><strong>   </strong></h5>
                           </td>
                        
                           
                        </tr></div>
                     </table>
                  </div>
                    
                </section>
            <div class="form-row">
				<strong>&nbsp;</strong>
				<input type="submit" value="SUBMIT" class="form-control btn-primary btn-block">
			</div>
		</form>

<script>
   
   function get_product(id){
      var url="{{URL::to('admin/getPrice/')}}"
           $.ajax({
           type:'GET',
           url:url+'/'+id,
         // url:"/api/get_item/"+id,
           dataType:'json',
           success:function(data)
             {

                var rate= parseInt(data.rate);
                var total_rate= parseInt(rate*data.qty);
							var tax= parseInt(data.tax);
							var t_rate=parseInt((rate/100)*tax);
							var total= parseInt(rate+t_rate);

               

               var ht="<tr><td>"+data.name+"</td><td><input type='hidden' name='item_id[]'  type='text' value='" + data.id + "'></td><td><input  type='text' class='rate' name='price[]' value='"+data.rate+"'></td><td><input type='text' name='qty[]' class='qty' value='1'></td><td><input type='text' class='tax'  value='"+data.tax+"'></td><td class='text-center total'>"+total+"</td><td><span  id='DeleteButton'><i class='fas fa-trash-alt'></i></span></td></tr>";
               $('#kk').append(ht);
               calculate_sub();
             }
        });
   }
   $(".table tbody").on('keyup','.qty,.rate,.tax', function() {
                    var qty = $(this).closest('tr').find('.qty').val();
                    var rate = $(this).closest('tr').find('.rate').val();
                    var tax = $(this).closest('tr').find('.tax').val();
						var t_rate=(rate/100)*tax;
						var total= (rate*qty)+(t_rate*qty);
						$(this).closest('tr').find('.total').text(total)
						calculate_sub();
				})

            $("#mytable").on("click", "#DeleteButton", function() {
                       $(this).closest("tr").remove();
					   calculate_sub();
               });

				calculate_sub = function() {
                    var s = 0;
                    $(".qty").closest('tr').each(function(index, value) {
                         var ss = parseInt($(this).find('.total').text());
                         s += ss;
                         $(".sub_total").text(s);
                    });
               }
</script>
@endsection