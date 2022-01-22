@extends('layouts.app')
@section('page_title')
<span>View Proposal Details</span>
@endsection
@section('content')
<style>
    #sig-canvas {
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
        }
</style>
<div class="container wrapper">

    <div class="row">
        <div class="col-md-3">
            <div class="jumbotron">
                <i class="fas fa-user fa-3x"></i>
                 <hr class="my-4">
                 <span>Customer Name</span>
                <h3>{{ $proposalItem->customer->user->name }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron">
                <i class="fas fa-sticky-note fa-3x"></i>
                 <hr class="my-4">
                 <span>Proposal Subject</span>
                <h3>{{ $proposalItem->subject }}</h3>

            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron">
                <i class="fas fa-calendar-alt fa-3x"></i>
                 <hr class="my-4">
                 <span>Due Date</span>
                <h3>{{ $proposalItem->due_date }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="jumbotron">
                <i class="fas fa-battery-empty  fa-3x"></i>
                 <hr class="my-4">
                 <span>Status</span>
                <h3> {{$proposalItem->status}}
                </h3>

            </div>
        </div>
    </div>


    <!-- item info -->
    <div class="row">
        <div class="col-md-7">
            <div class="jumbotron item-info">
                <h3 class="bg-blue text-white font-weight-bolder pl-3 pt-2 pb-2">Items Info</h3>
                <hr class="my-3">
                <table class="table table-bordered  table-active table-dark-gray table-hover " style="width: 100%; padding:10px">
                    <thead >
                        <tr>
                            <th class="font-weight-bold text-dark text-uppercase">#</th>
                            <th class="font-weight-bold text-dark text-uppercase">Item Name</th>
                            <th class="font-weight-bold text-dark text-uppercase">Unit</th>
                            <th class="font-weight-bold text-dark text-uppercase">Tax</th>
                            <th class="font-weight-bold text-dark text-uppercase">Quantity</th>
                            <th class="font-weight-bold text-dark text-uppercase">Price</th>
                            <th class="font-weight-bold text-dark text-uppercase">Total Amount</th>
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


                            <tr>
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
            </div>
        </div>

        <div class="col-md-5">
            <div class="card summery">
                <div class="card-header d-flex">
                    <i style="margin-right: 5px" class="fas fa-book fa-2x "></i>
                    <h4>Summery</h4>
                </div>
                <div class="card-body proposalInfo">
                    <h5 class="card-title">Proposal Information</h5>
                    <h5 class="font-weight-bold">Company Name: {{$proposalItem->customer->company_name}}</h5><br>
                    <p>Address: {{$proposalItem->customer->address}}</p>
                    <p>Phone: {{$proposalItem->customer->phone}}</p>
                    <p>City: {{$proposalItem->customer->city ? $proposalItem->customer->city : 'NA'}}</p>
                    <p>Country: {{$proposalItem->customer->country ? $proposalItem->customer->country: 'NA'}}</p>
                    <p>Zip: {{$proposalItem->customer->zip ? $proposalItem->customer->zip : 'NA'}}</p>
                    <p>Vat Number: {{$proposalItem->customer->vat_number ?$proposalItem->customer->vat_number : 'Not Applicable'}}</p>
                    @if ($proposalItem->sign)
                    <p>
                        Sign
                        <img src="{{ $proposalItem->sign }}" alt="sign" width="150" height="75">
                    </p>
                    @endif


                </div>
            </div>

            <div class="col-12 sig-form-show" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <h3>Authorization form</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="form-accept">
                            @csrf
                            <div class="form-group">
                                <label for="">Signeture</label>
                                <canvas id="sig-canvas" width="350" height="160">
                                    Get a better browser, bro.
                                </canvas>
                            </div>
                            <hr />
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-id="{{$proposalItem->id}}" id="sig-submitBtn">Sign</button>
                                <button type="button" class="btn btn-primary" id="sig-clearBtn">Clear</button>
                                <button type="button" class="btn btn-danger btn-accept-cancel">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="btn button-list">
                <a href="{{route('proposals.index')}}" class="btn btn-primary btn-floating btn-lg"><i class="fas fa-arrow-left" aria-hidden="true"></i>  Back</a>
                @if ($proposalItem->status != 'accepted' && $proposalItem->status != 'declined')
                    <a class="btn btn-lg btn-success btn-accept">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        Accept
                    </a>
                    <a type="button" data-id="{{$proposalItem->id}}" class="btn btn-lg btn-danger reject-proposal"><i class="fas fa-ban" aria-hidden="true"></i> Reject</a>
                @elseif($proposalItem->status == 'accepted')
                  <a class="btn btn-lg btn-success">
                    <i class="fas fa-check" aria-hidden="true"></i>
                    Accepted
                 </a>
                 @elseif($proposalItem->status == 'declined')
                  <a class="btn btn-lg btn-danger">
                    <i class="fas fa-ban" aria-hidden="true"></i>
                    Rejected
                 </a>
                @endif

                <a href="{{url('proposalDownload/')}}/{{$proposalItem->id}}"   class="btn btn-blue btn-lg  "><i class="fas fa-download" aria-hidden="true"></i>Generate PDF</a>

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready( function() {

        $(".btn-accept").on('click', function() {
            $(".summery").hide(500);
            $(".sig-form-show").show();
        });

        $(".btn-accept-cancel").on('click', function() {
            $(".sig-form-show").hide();
            $(".summery").show();
        });
    });

    window.requestAnimFrame = (function(callback) {
        return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimaitonFrame ||
        function(callback) {
            window.setTimeout(callback, 1000 / 60);
        };
    })();

  var canvas = document.getElementById("sig-canvas");
  var ctx = canvas.getContext("2d");
  ctx.strokeStyle = "#222222";
  ctx.lineWidth = 4;

  var drawing = false;
  var mousePos = {
    x: 0,
    y: 0
  };
  var lastPos = mousePos;

  canvas.addEventListener("mousedown", function(e) {
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);

  canvas.addEventListener("mouseup", function(e) {
    drawing = false;
  }, false);

  canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
  }, false);

  // Add touch event support for mobile
  canvas.addEventListener("touchstart", function(e) {

  }, false);

  canvas.addEventListener("touchmove", function(e) {
    var touch = e.touches[0];
    var me = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    var touch = e.touches[0];
    var me = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchend", function(e) {
    var me = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(me);
  }, false);

  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    }
  }

  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: touchEvent.touches[0].clientX - rect.left,
      y: touchEvent.touches[0].clientY - rect.top
    }
  }

  function renderCanvas() {
    if (drawing) {
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();
      lastPos = mousePos;
    }
  }

  // Prevent scrolling when touching the canvas
  document.body.addEventListener("touchstart", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchend", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchmove", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);

  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  function clearCanvas() {
    canvas.width = canvas.width;
  }

  // Set up the UI
  var sigText = document.getElementById("sig-dataUrl");
  var sigImage = document.getElementById("sig-image");
  var clearBtn = document.getElementById("sig-clearBtn");
  var submitBtn = document.getElementById("sig-submitBtn");
  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
    // sigText.innerHTML = "Data URL for your signature will go here!";
    // sigImage.setAttribute("src", "");
  }, false);

submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    // while width is 350px, height is 160px
    // console.log(dataUrl.length)
    if (dataUrl.length <= 1858) {
        toastr.warning('Please make a signature !', 'Warning !')
        return false;
    }
    // ajax
    var id = $("#sig-submitBtn").data('id');
    var url = '{{ route("proposals.store") }}';
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'id': id,
            'sign_text': dataUrl,
            'length': parseInt(dataUrl.length)
        },
        success: function(response) {
            if (response.status == 'success') {
                toastr.success(response.message, 'Success !');
                setTimeout(() => {
                    location.reload()
                }, 3000);
            } else {
                toastr.warning(response.message, 'Error !');
            }
        },
        error: function(error) {
            console.log(error)
            if (error.responseJSON && error.responseJSON.errors) {
                $.each(error.responseJSON.errors, function(key, value) {
                    toastr.warning(value[0], 'Error !');
                });
            } else if (error.responseText) {
                toastr.warning(error.responseText, 'Error !');
            } else {
                toastr.warning('Something went wrong. Please try again.', 'Error !');
            }
        }
    })

  }, false);

  $(".reject-proposal").on('click', function() {
        if (!confirm("Do you want to reject ?")) {
            return false
        }
        var id = $(this).data('id');
        var url = '{{ route("proposals.destroy", ":id") }}';
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_method': 'DELETE'
            },
            success: function(response) {
                console.log(response)
                if (response.status == 'success') {
                    toastr.success(response.message, 'Success !');
                    setTimeout(() => {
                        location.reload()
                    }, 3000);
                } else {
                    toastr.error(response.message, 'Error !');
                }
            },
            error: function(error) {
                console.log(error)
                toastr.error('Something went wrong !', 'Error !');
            }
        })
  })

</script>
@endsection
