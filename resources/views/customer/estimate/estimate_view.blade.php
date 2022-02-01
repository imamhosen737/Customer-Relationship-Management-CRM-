@extends('layouts.app')
@section('page_title')
<span>Estimate list</span>
@endsection
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="card"
        style="box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">
        <div class="card-header">
          Estimate Details
        </div>
        <div class="card-body">
          <p><span style="font-weight: bold">Subject: </span>{{$estimate->subject}}</p>
          <p><span style="font-weight: bold">Received: </span>{{$estimate->date}}</p>
          <p><span style="font-weight: bold">Due-Date: </span>{{$estimate->due_date}}</p>
          <p><span style="font-weight: bold">Status: </span>{{ucfirst(trans($estimate->status))}}</p>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card"
        style="box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">
        <div class="card-header">
          {{$estimate_user_count}} User Assigned
        </div>
        <div class="card-body">

          <table class="table table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Department</th>
              </tr>
            </thead>

            <tbody>
              @php
              $k=1;
              @endphp
              @foreach ($estimate_user as $e_user)
              <tr>
                <td>{{$k++}}</td>
                <td>{{$e_user->user->name}}</td>
                <td>{{$e_user->user->email}}</td>
                <td>{{$e_user->user->departments->name}}</td>
              </tr>
              @endforeach


            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

  <h2 class="text-center">Items List</h2>
  <div class="row">
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>QTY</th>
          <th>Tax</th>
          <th>Total</th>
        </tr>
      </thead>

      <tbody>

        @php
        $g_total=0;
        @endphp
        @foreach ($estimate_items as $k=>$e)
        <tr>

          <td>{{++$k}}</td>
          <td>{{$e->item->name}}</td>
          <td>{{$e->item->description}}</td>
          <td>{{$e->price}}</td>
          <td>{{$e->qty}}</td>
          <td>{{$e->item->tax->rules}}</td>
          @php
          $tax_amount=($e->price/100)*$e->item->tax->rules;
          $total= ($e->price*$e->qty)+$tax_amount;
          $g_total+=$total;
          @endphp

          <td>{{$total}}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="6" class="text-right font-weight-bold">Grand Total=</td>
          <td class="font-weight-bold">{{$g_total}}</td>
        </tr>


      </tbody>
    </table>
  </div>
  @if ($estimate->status=='sent')
  <div class="row mt-5 text-center">
    <div class="row justify-content-md-center" id="cnv">
      <div class="col-md-6">
        <p>Sign in the canvas below to accept the estimate</p>
        <canvas id="sig-canvas" width="620" height="160" class="border border-warning d-block">
          Get a better browser, bro.
        </canvas>
        <div class="d-flex justify-content-center d-block mt-3">
          <button class="btn btn-primary mr-2 ml-5" id="sig-submitBtn">Submit Signature</button>
          <button class="btn btn-warning" id="sig-clearBtn">Clear Signature</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form action="" method="POST" id="sign_txt_form">
          @csrf
          <textarea id="sig-dataUrl" class="form-control d-none" name="sign" rows="5" style="display: block"></textarea>
      </div>
    </div>

  </div>
  <div class="row" id="sign_img">
    <img id="sig-image" src="" class="img-fluid border border-warning" style="max-width: 10%"
      alt="Your signature will go here!" />
    <p class="text-center">Signature</p>
  </div>
  @endif


  <div class="row  justify-content-md-center" id="accept_btn">
    <div class="col-md-6 d-flex justify-content-center">
      @if ($estimate->status=='sent')
      <button title="{{route('cm_estimate_accept', $estimate->id)}}" id="accept"
        class="btn btn-success mx-1">Accept</button>
      <button title="{{route('cm_estimate_reject', $estimate->id)}}" id="reject"
        class="btn btn-danger mx-1">Reject</button>
      @endif
      <a href="{{route('cm_estimate', $estimate->id)}}" class="btn btn-primary mx-1">Back</a>
    </div>
  </div>
  </form>
</div>

<script>
  (function() {
    var submitBtn = document.getElementById("sig-submitBtn");
    submitBtn.disabled = true;
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
    submitBtn.disabled = false;
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
    submitBtn.disabled = false;
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
  var sign_img = document.getElementById("sign_img");
  var accept_btn = document.getElementById("accept_btn");
  var cnv = document.getElementById("cnv");
  sign_img.style.display = "none";
  accept_btn.style.display = "none";
  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
    sigText.innerHTML = "Data URL for your signature will go here!";
    sigImage.setAttribute("src", "");
    submitBtn.disabled = true;
  }, false);
  let blank="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAmwAAACgCAYAAACxIDDDAAAAAXNSR0IArs4c6QAACENJREFUeF7t1jERAAAMArHi33Rt/JAq4EIHdo4AAQIECBAgQCAtsHQ64QgQIECAAAECBM5g8wQECBAgQIAAgbiAwRYvSDwCBAgQIECAgMHmBwgQIECAAAECcQGDLV6QeAQIECBAgAABg80PECBAgAABAgTiAgZbvCDxCBAgQIAAAQIGmx8gQIAAAQIECMQFDLZ4QeIRIECAAAECBAw2P0CAAAECBAgQiAsYbPGCxCNAgAABAgQIGGx+gAABAgQIECAQFzDY4gWJR4AAAQIECBAw2PwAAQIECBAgQCAuYLDFCxKPAAECBAgQIGCw+QECBAgQIECAQFzAYIsXJB4BAgQIECBAwGDzAwQIECBAgACBuIDBFi9IPAIECBAgQICAweYHCBAgQIAAAQJxAYMtXpB4BAgQIECAAAGDzQ8QIECAAAECBOICBlu8IPEIECBAgAABAgabHyBAgAABAgQIxAUMtnhB4hEgQIAAAQIEDDY/QIAAAQIECBCICxhs8YLEI0CAAAECBAgYbH6AAAECBAgQIBAXMNjiBYlHgAABAgQIEDDY/AABAgQIECBAIC5gsMULEo8AAQIECBAgYLD5AQIECBAgQIBAXMBgixckHgECBAgQIEDAYPMDBAgQIECAAIG4gMEWL0g8AgQIECBAgIDB5gcIECBAgAABAnEBgy1ekHgECBAgQIAAAYPNDxAgQIAAAQIE4gIGW7wg8QgQIECAAAECBpsfIECAAAECBAjEBQy2eEHiESBAgAABAgQMNj9AgAABAgQIEIgLGGzxgsQjQIAAAQIECBhsfoAAAQIECBAgEBcw2OIFiUeAAAECBAgQMNj8AAECBAgQIEAgLmCwxQsSjwABAgQIECBgsPkBAgQIECBAgEBcwGCLFyQeAQIECBAgQMBg8wMECBAgQIAAgbiAwRYvSDwCBAgQIECAgMHmBwgQIECAAAECcQGDLV6QeAQIECBAgAABg80PECBAgAABAgTiAgZbvCDxCBAgQIAAAQIGmx8gQIAAAQIECMQFDLZ4QeIRIECAAAECBAw2P0CAAAECBAgQiAsYbPGCxCNAgAABAgQIGGx+gAABAgQIECAQFzDY4gWJR4AAAQIECBAw2PwAAQIECBAgQCAuYLDFCxKPAAECBAgQIGCw+QECBAgQIECAQFzAYIsXJB4BAgQIECBAwGDzAwQIECBAgACBuIDBFi9IPAIECBAgQICAweYHCBAgQIAAAQJxAYMtXpB4BAgQIECAAAGDzQ8QIECAAAECBOICBlu8IPEIECBAgAABAgabHyBAgAABAgQIxAUMtnhB4hEgQIAAAQIEDDY/QIAAAQIECBCICxhs8YLEI0CAAAECBAgYbH6AAAECBAgQIBAXMNjiBYlHgAABAgQIEDDY/AABAgQIECBAIC5gsMULEo8AAQIECBAgYLD5AQIECBAgQIBAXMBgixckHgECBAgQIEDAYPMDBAgQIECAAIG4gMEWL0g8AgQIECBAgIDB5gcIECBAgAABAnEBgy1ekHgECBAgQIAAAYPNDxAgQIAAAQIE4gIGW7wg8QgQIECAAAECBpsfIECAAAECBAjEBQy2eEHiESBAgAABAgQMNj9AgAABAgQIEIgLGGzxgsQjQIAAAQIECBhsfoAAAQIECBAgEBcw2OIFiUeAAAECBAgQMNj8AAECBAgQIEAgLmCwxQsSjwABAgQIECBgsPkBAgQIECBAgEBcwGCLFyQeAQIECBAgQMBg8wMECBAgQIAAgbiAwRYvSDwCBAgQIECAgMHmBwgQIECAAAECcQGDLV6QeAQIECBAgAABg80PECBAgAABAgTiAgZbvCDxCBAgQIAAAQIGmx8gQIAAAQIECMQFDLZ4QeIRIECAAAECBAw2P0CAAAECBAgQiAsYbPGCxCNAgAABAgQIGGx+gAABAgQIECAQFzDY4gWJR4AAAQIECBAw2PwAAQIECBAgQCAuYLDFCxKPAAECBAgQIGCw+QECBAgQIECAQFzAYIsXJB4BAgQIECBAwGDzAwQIECBAgACBuIDBFi9IPAIECBAgQICAweYHCBAgQIAAAQJxAYMtXpB4BAgQIECAAAGDzQ8QIECAAAECBOICBlu8IPEIECBAgAABAgabHyBAgAABAgQIxAUMtnhB4hEgQIAAAQIEDDY/QIAAAQIECBCICxhs8YLEI0CAAAECBAgYbH6AAAECBAgQIBAXMNjiBYlHgAABAgQIEDDY/AABAgQIECBAIC5gsMULEo8AAQIECBAgYLD5AQIECBAgQIBAXMBgixckHgECBAgQIEDAYPMDBAgQIECAAIG4gMEWL0g8AgQIECBAgIDB5gcIECBAgAABAnEBgy1ekHgECBAgQIAAAYPNDxAgQIAAAQIE4gIGW7wg8QgQIECAAAECBpsfIECAAAECBAjEBQy2eEHiESBAgAABAgQMNj9AgAABAgQIEIgLGGzxgsQjQIAAAQIECBhsfoAAAQIECBAgEBcw2OIFiUeAAAECBAgQMNj8AAECBAgQIEAgLmCwxQsSjwABAgQIECBgsPkBAgQIECBAgEBcwGCLFyQeAQIECBAgQMBg8wMECBAgQIAAgbiAwRYvSDwCBAgQIECAgMHmBwgQIECAAAECcQGDLV6QeAQIECBAgAABg80PECBAgAABAgTiAgZbvCDxCBAgQIAAAQIGmx8gQIAAAQIECMQFDLZ4QeIRIECAAAECBAw2P0CAAAECBAgQiAsYbPGCxCNAgAABAgQIGGx+gAABAgQIECAQFzDY4gWJR4AAAQIECBAw2PwAAQIECBAgQCAuYLDFCxKPAAECBAgQIPDE0wChP1k9CQAAAABJRU5ErkJggg=="
  submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    sigText.innerHTML = dataUrl;
    if(dataUrl!==blank){
    sigImage.setAttribute("src", dataUrl);
    sign_img.style.display = "block";
    accept_btn.style.display = "block";
    cnv.style.display = "none";
    sign_img.classList.add("d-flex");
    accept_btn.classList.add("d-flex");
    sign_img.classList.add("justify-content-center");

    }
  }, false);


})();
</script>

<script>
  $( "#accept" ).click(function(e) {
  e.preventDefault();
  var met= $( "#accept" ).attr( "title" );
  $( "#sign_txt_form" ).attr( "action", met );
  $("#sign_txt_form").submit();
});
$( "#reject" ).click(function(e) {
  e.preventDefault();
  var met= $( "#reject" ).attr( "title" );
  $( "#sign_txt_form" ).attr( "action", met );
  $("#sign_txt_form").submit();
});
</script>
@endsection